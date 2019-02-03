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




    public function store($sample_no, $sugar_service){

        $sa_parameter = new SugarAnalysisParameter;
        $sa_parameter->sample_no = $sample_no;
        $sa_parameter->sugar_service_id = $sugar_service->sugar_service_id;
        $sa_parameter->sugar_service_name = $sugar_service->name;
        $sa_parameter->price = $sugar_service->price;
        $sa_parameter->save();

        return $sa_parameter;
        
    }





}