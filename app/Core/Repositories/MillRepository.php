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

        $entries = isset($request->e) ? (int)$request->e : 20;

        $mills = $this->cache->remember('mills:fetch:' . $key, 240, function() use ($request, $entries){

            $mill = $this->mill->newQuery();
            
            if(isset($request->q)){
                $this->search($mill, $request->q);
            }

            return $this->populate($mill, $entries);

        });

        return $mills;

    }






    public function store($request){

        $mill = new Mill;
        $mill->slug = $this->str->random(16);
        $mill->mill_id = $request->mill_id;
        $mill->name = $request->name;
        $mill->short_name = $request->short_name;
        $mill->address = $request->address;
        $mill->district = $request->district;
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
        $mill->short_name = $request->short_name;
        $mill->address = $request->address;
        $mill->district = $request->district;
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






    public function getAll(){

        $mills = $this->cache->remember('mills:getAll', 240, function(){
            return $this->mill->select('mill_id', 'name', 'short_name', 'district')
                              ->orderBy('short_name', 'asc')
                              ->get();
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






    public function findByMillId($mill_id){

        $mill = $this->cache->remember('mills:findByMillId:' . $mill_id, 240, function() use ($mill_id){
            return $this->mill->select('address', 'name')
                              ->where('mill_id', $mill_id)
                              ->first();
        }); 
        
        if(empty($mill)){
            abort(404);
        }

        return $mill;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%')
                      ->orwhere('mill_id', 'LIKE', '%'. $key .'%')
                      ->orwhere('short_name', 'LIKE', '%'. $key .'%')
                      ->orwhere('district', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('mill_id', 'name', 'address', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






}