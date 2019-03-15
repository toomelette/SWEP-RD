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




    public function update($sample_no, $sugar_service_id, $result){

        $sa_parameter = $this->findBySampleNoSugarServiceId($sample_no, $sugar_service_id);
        $sa_parameter->result = $result;
        $sa_parameter->save();

        return $sa_parameter;
        
    }






    private function findBySampleNoSugarServiceId($sample_no, $sugar_service_id){

        $ss = $this->cache->remember('sugar_analysis_parameter:findBySampleNoSugarServiceId:'.$sample_no.':'. $sugar_service_id, 240, function() use ($sample_no, $sugar_service_id){
            return $this->sa_parameter->where('sample_no', $sample_no)
                                      ->where('sugar_service_id', $sugar_service_id)
                                      ->first();
        }); 
        
        if(empty($ss)){
            abort(404);
        }

        return $ss;

    }





}