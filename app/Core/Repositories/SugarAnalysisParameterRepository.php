<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarAnalysisParameterInterface;

use App\Models\SugarAnalysisParameter;


class SugarAnalysisParameterRepository extends BaseRepository implements SugarAnalysisParameterInterface {
	


    protected $sa_parameter;



	public function __construct(SugarAnalysisParameter $sa_parameter){

        $this->sa_parameter = $sa_parameter;
        parent::__construct();

    }




    public function store($sample_no, $obj){

        $sa_parameter = new SugarAnalysisParameter;
        $sa_parameter->sample_no = $sample_no;
        $sa_parameter->sugar_service_id = $obj->sugar_service_id;
        $sa_parameter->sugar_service_name = $obj->name;
        $sa_parameter->price = $obj->price;
        $sa_parameter->standard = $obj->standard;
        $sa_parameter->save();

        return $sa_parameter;
        
    }





}