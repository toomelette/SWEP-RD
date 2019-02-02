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




    public function getAll(){

        $sugar_services = $this->cache->remember('sugar_services:getAll', 240, function(){
            return $this->sugar_service->select('sugar_service_id', 'name', 'price')->get();
        });
        
        return $sugar_services;

    }






    public function findBySugarServiceId($ss_id){

        $sugar_service = $this->cache->remember('sugar_services:findBySugarServiceId:' . $ss_id, 240, function() use ($ss_id){
            return $this->sugar_service->where('sugar_service_id', $ss_id)->first();
        });
        
        if(empty($sugar_service)){
            abort(404);
        }
        
        return $sugar_service;

    }






}