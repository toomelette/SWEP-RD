<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarServiceInterface;

use App\Models\SugarService;


class SugarServiceRepository extends BaseRepository implements SugarServiceInterface {
	



    protected $sugar_service;




	public function __construct(SugarService $sugar_service){

        $this->sugar_service = $sugar_service;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $sugar_services = $this->cache->remember('sugar_services:fetch:' . $key, 240, function() use ($request){

            $sugar_service = $this->sugar_service->newQuery();
            
            if(isset($request->q)){
                $this->search($sugar_service, $request->q);
            }

            return $this->populate($sugar_service);

        });

        return $sugar_services;

    }






    public function store($request){

        $sugar_service = new SugarService;
        $sugar_service->slug = $this->str->random(16);
        $sugar_service->sugar_service_id = $this->getSugarServiceIdInc();
        $sugar_service->name = $request->name;
        $sugar_service->price = $this->__dataType->string_to_num($request->price);
        $sugar_service->created_at = $this->carbon->now();
        $sugar_service->updated_at = $this->carbon->now();
        $sugar_service->ip_created = request()->ip();
        $sugar_service->ip_updated = request()->ip();
        $sugar_service->user_created = $this->auth->user()->user_id;
        $sugar_service->user_updated = $this->auth->user()->user_id;
        $sugar_service->save();
        
        return $sugar_service;

    }






    public function update($request, $slug){

        $sugar_service = $this->findBySlug($slug);
        $sugar_service->name = $request->name;
        $sugar_service->price = $this->__dataType->string_to_num($request->price);
        $sugar_service->updated_at = $this->carbon->now();
        $sugar_service->ip_updated = request()->ip();
        $sugar_service->user_updated = $this->auth->user()->user_id;
        $sugar_service->save();
        
        return $sugar_service;

    }






    public function destroy($slug){

        $sugar_service = $this->findBySlug($slug);
        $sugar_service->delete();
        
        return $sugar_service;

    }






    public function findBySlug($slug){

        $sugar_service = $this->cache->remember('sugar_services:findBySlug:'. $slug, 240, function() use ($slug){
            return $this->sugar_service->where('slug', $slug)->first();
        }); 
        
        if(empty($sugar_service)){
            abort(404);
        }

        return $sugar_service;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('name', 'price', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function getAll(){

        $sugar_services = $this->cache->remember('sugar_services:getAll', 240, function(){
            return $this->sugar_service->select('sugar_service_id', 'name', 'price')->get();
        });
        
        return $sugar_services;

    }






    public function findBySugarServiceId($sugar_service_id){

        $sugar_service = $this->cache->remember('sugar_services:findBySugarServiceId:' . $sugar_service_id, 240, function() use ($sugar_service_id){
            return $this->sugar_service->where('sugar_service_id', $sugar_service_id)->first();
        });
        
        if(empty($sugar_service)){
            abort(404);
        }
        
        return $sugar_service;

    }






    private function getSugarServiceIdInc(){

        $id = 'SS1001';

        $sugar_service = $this->sugar_service->select('sugar_service_id')->orderBy('sugar_service_id', 'desc')->first();

        if($sugar_service != null){
            if($sugar_service->sugar_service_id != null){
                $num = str_replace('SS', '', $sugar_service->sugar_service_id) + 1;
                $id = 'SS' . $num;
            }
        }
        
        return $id;
        
    }






}