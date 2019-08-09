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
        $sugar_analysis_parameter->sugar_analysis_parameter_id = $this->getSugarAnalysisParameterIdInc();
        $sugar_analysis_parameter->sugar_service_id = $sugar_service->sugar_service_id;
        $sugar_analysis_parameter->name = $sugar_service->name;
        $sugar_analysis_parameter->price = $sugar_service->price;
        $sugar_analysis_parameter->standard_str = $sugar_service->standard_str;
        $sugar_analysis_parameter->standard_dec_max = $sugar_service->standard_dec_max;
        $sugar_analysis_parameter->standard_dec_min = $sugar_service->standard_dec_min;
        $sugar_analysis_parameter->save();

        return $sugar_analysis_parameter;
        
    }





    public function update($sample_no, $sugar_service_id, $result, $assessment, $moisture_result_dec = null, $moisture_sf_dec = null){

        $sugar_analysis_parameter = $this->findBySampleNo_SugarServiceId($sample_no, $sugar_service_id);
        
        if ($sugar_service_id == "SS1017") {
            $sugar_analysis_parameter->moisture_result_dec = $moisture_result_dec;   
            $sugar_analysis_parameter->moisture_sf_dec = $moisture_sf_dec;   
        }

        $sugar_analysis_parameter->result_dec = $result;
        $sugar_analysis_parameter->assessment = $this->setAssessment($sugar_analysis_parameter, $result, $moisture_sf_dec);
        $sugar_analysis_parameter->save();

        return $sugar_analysis_parameter;
        
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






    public function getSugarAnalysisParameterIdInc(){

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






    private function setAssessment($sa_parameter, $result, $moisture_sf_dec = null){

        $rating = $sa_parameter->sugar_service_id == 'SS1017' ? $moisture_sf_dec : $result;

        $assessment = "";

        if (isset($sa_parameter->standard_dec_max) && is_null($sa_parameter->standard_dec_min)) {
            
            if ($rating <= $sa_parameter->standard_dec_max) {
                $assessment = "Within Std.";
            }elseif($rating > $sa_parameter->standard_dec_max) {
                $assessment = "Above Std.";
            }

        }

        if (isset($sa_parameter->standard_dec_max) && isset($sa_parameter->standard_dec_min)) {
            
            if ($rating <= $sa_parameter->standard_dec_max && $rating >= $sa_parameter->standard_dec_min) {
                $assessment = "Within Std.";
            }elseif($rating > $sa_parameter->standard_dec_max && $rating > $sa_parameter->standard_dec_min){
                $assessment = "Above Std.";
            }elseif($rating < $sa_parameter->standard_dec_max && $rating < $sa_parameter->standard_dec_min){
                $assessment = "Below Std.";
            }

        }

        return $assessment;

    }





}