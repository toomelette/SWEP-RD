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




    public function store($sample_no, $sugar_service){

        $sugar_analysis_parameter = new SugarAnalysisParameter;
        $sugar_analysis_parameter->sample_no = $sample_no;
        $sugar_analysis_parameter->sugar_analysis_parameter_id = $this->getSugarAnalysisParameterId();
        $sugar_analysis_parameter->sugar_service_id = $sugar_service->sugar_service_id;
        $sugar_analysis_parameter->name = $sugar_service->name;
        $sugar_analysis_parameter->price = $sugar_service->price;
        $sugar_analysis_parameter->standard = $sugar_service->standard;
        $sugar_analysis_parameter->save();

        return $sugar_analysis_parameter;
        
    }




    public function update($sample_no, $sugar_service_id, $result, $assessment, $moisture_result_dec = null, $moisture_sf_dec = null){

        $sugar_analysis_parameter = $this->findBySampleNo_SugarServiceId($sample_no, $sugar_service_id);
        
        if ($sugar_service_id == "SS1017") {
            $sugar_analysis_parameter->moisture_result_dec = is_numeric($moisture_result_dec) ? floatval($moisture_result_dec) : 0.00;   
            $sugar_analysis_parameter->moisture_sf_dec = is_numeric($moisture_sf_dec) ? floatval($moisture_sf_dec) : 0.00;   
        }

        $sugar_analysis_parameter->result_str = $result;
        $sugar_analysis_parameter->result_dec = is_numeric($result) ? floatval($result) : 0.00;
        $sugar_analysis_parameter->assessment = $assessment;
        $sugar_analysis_parameter->save();

        return $sugar_analysis_parameter;
        
    }






    public function getSugarAnalysisParameterId(){

        $id = 'SAP1000001';

        $sugar_analysis_parameter = $this->sugar_analysis_parameter->select('sugar_analysis_parameter_id')
                                                                   ->orderBy('sugar_analysis_parameter_id', 'desc')
                                                                   ->first();

        if($sugar_analysis_parameter != null){

            if($sugar_analysis_parameter->sugar_analysis_parameter_id != null){
                $num = str_replace('SAP', '', $sugar_analysis_parameter->sugar_analysis_parameter_id) + 1;
                $id = 'SAP' . $num;
            }
        
        }
        
        return $id;
        
    }






    private function findBySampleNo_SugarServiceId($sample_no, $sugar_service_id){

        $sugar_analysis_parameter = $this->cache->remember('sugar_analysis_parameter:findBySampleNo_SugarServiceId:'.$sample_no.':'. $sugar_service_id, 240, function() use ($sample_no, $sugar_service_id){
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