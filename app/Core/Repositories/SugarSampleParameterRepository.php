<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarSampleParameterInterface;

use App\Models\SugarSampleParameter;


class SugarSampleParameterRepository extends BaseRepository implements SugarSampleParameterInterface {
	


    protected $sugar_sample_parameter;



	public function __construct(SugarSampleParameter $sugar_sample_parameter){

        $this->sugar_sample_parameter = $sugar_sample_parameter;
        parent::__construct();

    }




    public function store($sugar_sample_id, $sugar_service){

        $sugar_sample_parameter = new SugarSampleParameter;
        $sugar_sample_parameter->seq_no = $sugar_service->seq_no;
        $sugar_sample_parameter->sugar_sample_id = $sugar_sample_id;
        $sugar_sample_parameter->sugar_service_id = $sugar_service->sugar_service_id;
        $sugar_sample_parameter->name = $sugar_service->name;
        $sugar_sample_parameter->price = $sugar_service->price;
        $sugar_sample_parameter->standard_str = $sugar_service->standard_str;
        $sugar_sample_parameter->save();

        return $sugar_sample_parameter;
        
    }





    public function updateSugarService($sugar_service){

        $sugar_service_id = $sugar_service->sugar_service_id;
        
        $this->sugar_sample_parameter->where('sugar_service_id', $sugar_service_id)->update([

            'name' => $sugar_service->name, 
            'price' => $sugar_service->price, 
            'standard_str' => $sugar_service->standard_str,

        ]);

    }





    public function getBySugarSampleId($sugar_sample_id){

        $sugar_sample_parameters = $this->cache->remember('sugar_sample_parameters:getBySugarSampleId:'. $sugar_sample_id, 240, function() use ($sugar_sample_id){
            return $this->sugar_sample_parameter->where('sugar_sample_id', $sugar_sample_id)->get();
        });

        return $sugar_sample_parameters;

    }





}