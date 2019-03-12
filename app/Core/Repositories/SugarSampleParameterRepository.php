<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarSampleParameterInterface;

use App\Models\SugarSampleParameter;


class SugarSampleParameterRepository extends BaseRepository implements SugarSampleParameterInterface {
	


    protected $ss_parameter;



	public function __construct(SugarSampleParameter $ss_parameter){

        $this->ss_parameter = $ss_parameter;
        parent::__construct();

    }




    public function store($sugar_sample_id, $sugar_service){

        $ss_parameter = new SugarSampleParameter;
        $ss_parameter->sugar_sample_id = $sugar_sample_id;
        $ss_parameter->sugar_service_id = $sugar_service->sugar_service_id;
        $ss_parameter->name = $sugar_service->name;
        $ss_parameter->price = $sugar_service->price;
        $ss_parameter->save();

        return $ss_parameter;
        
    }





}