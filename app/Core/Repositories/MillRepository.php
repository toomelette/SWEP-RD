<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MillInterface;

use App\Models\Mill;


class MillRepository extends BaseRepository implements MillInterface {
	


    protected $mill;



	public function __construct(Mill $mill){

        $this->mill = $mill;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $mills = $this->cache->remember('mills:fetch:' . $key, 240, function() use ($request){

            $mill = $this->mill->newQuery();
            
            if(isset($request->q)){
                $this->search($mill, $request->q);
            }

            return $this->populate($mill);

        });

        return $mills;

    }






    public function store($request){

        $mill = new Mill;
        $mill->slug = $this->str->random(16);
        $mill->mill_id = $request->mill_id;
        $mill->name = $request->name;
        $mill->address = $request->address;
        $mill->created_at = $this->carbon->now();
        $mill->updated_at = $this->carbon->now();
        $mill->ip_created = request()->ip();
        $mill->ip_updated = request()->ip();
        $mill->user_created = $this->auth->user()->user_id;
        $mill->user_updated = $this->auth->user()->user_id;
        $mill->save();
        
        return $mill;

    }






    public function update($request, $slug){

        $mill = $this->findBySlug($slug);
        $mill->mill_id = $request->mill_id;
        $mill->name = $request->name;
        $mill->address = $request->address;
        $mill->updated_at = $this->carbon->now();
        $mill->ip_updated = request()->ip();
        $mill->user_updated = $this->auth->user()->user_id;
        $mill->save();
        
        return $mill;

    }






    public function destroy($slug){

        $mill = $this->findBySlug($slug);
        $mill->delete();
        
        return $mill;

    }






    public function findBySlug($slug){

        $mill = $this->cache->remember('mills:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->mill->where('slug', $slug)->first();
        }); 
        
        if(empty($mill)){
            abort(404);
        }

        return $mill;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%')
                      ->orwhere('mill_id', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('mill_id', 'name', 'address', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function getAll(){

        $mills = $this->cache->remember('mills:getAll', 240, function(){
            return $this->mill->select('mill_id', 'name')->get();
        });
        
        return $mills;

    }






    public function getByMillId($mill_id){

        $mill = $this->cache->remember('mills:getByMillId:' . $mill_id, 240, function() use ($mill_id){
            return $this->mill->select('address', 'name')
                              ->where('mill_id', $mill_id)
                              ->get();
        }); 
        
        if(empty($mill)){
            abort(404);
        }

        return $mill;

    }






}