<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarAnalysisParameterInterface;

use App\Models\SugarAnalysisParameter;


class SugarAnalysisParameterRepository extends BaseRepository implements SugarAnalysisParameterInterface {
	


    protected $sugar_analysis_parameter;



	public function __construct(SugarAnalysisParameter $sugar_analysis_parameter){

        $this->sugar_analysis_parameter = $sugar_analysis_parameter;
        parent::__construct();

    }




    public function store($sample_no, $sugar_service_instance){

        $sugar_analysis_parameter = new SugarAnalysisParameter;
        $sugar_analysis_parameter->sample_no = $sample_no;
        $sugar_analysis_parameter->sugar_service_id = $sugar_service_instance->sugar_service_id;
        $sugar_analysis_parameter->name = $sugar_service_instance->name;
        $sugar_analysis_parameter->price = $sugar_service_instance->price;
        $sugar_analysis_parameter->standard = $sugar_service_instance->standard;
        $sugar_analysis_parameter->save();

        return $sugar_analysis_parameter;
        
    }




    public function update($sample_no, $sugar_service_id, $result, $assessment){

        $sugar_analysis_parameter = $this->findBySampleNoSugarServiceId($sample_no, $sugar_service_id);
        $sugar_analysis_parameter->result = $result;
        $sugar_analysis_parameter->assessment = $assessment;
        $sugar_analysis_parameter->save();

        return $sugar_analysis_parameter;
        
    }






    private function findBySampleNoSugarServiceId($sample_no, $sugar_service_id){

        $sugar_analysis_parameter = $this->cache->remember('sugar_analysis_parameter:findBySampleNoSugarServiceId:'.$sample_no.':'. $sugar_service_id, 240, function() use ($sample_no, $sugar_service_id){
            return $this->sugar_analysis_parameter->where('sample_no', $sample_no)
                                      ->where('sugar_service_id', $sugar_service_id)
                                      ->first();
        }); 
        
        if(empty($sugar_analysis_parameter)){
            abort(404);
        }

        return $sugar_analysis_parameter;

    }





}