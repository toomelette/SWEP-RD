<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarAnalysisParameterInterface;

use App\Models\SugarAnalysisParameter;


class SugarAnalysisParameterRepository extends BaseRepository implements SugarAnalysisParameterInterface {
	


    protected $sugar_analysis_param;



	public function __construct(SugarAnalysisParameter $sugar_analysis_param){

        $this->sugar_analysis_param = $sugar_analysis_param;
        parent::__construct();

    }





    public function store($sample_no, $sugar_service){

        $sugar_analysis_param = new SugarAnalysisParameter;
        $sugar_analysis_param->sample_no = $sample_no;
        $sugar_analysis_param->sugar_analysis_parameter_id = $this->getSugarAnalysisParameterIdInc();
        $sugar_analysis_param->sugar_service_id = $sugar_service->sugar_service_id;
        $sugar_analysis_param->name = $sugar_service->name;
        $sugar_analysis_param->price = $sugar_service->price;
        $sugar_analysis_param->standard_str = $sugar_service->standard_str;
        $sugar_analysis_param->standard_dec_max = $sugar_service->standard_dec_max;
        $sugar_analysis_param->standard_dec_min = $sugar_service->standard_dec_min;
        $sugar_analysis_param->save();

        return $sugar_analysis_param;
        
    }





    public function update($sample_no, $sugar_service_id, $result, $moisture_result_dec = null, $moisture_sf_dec = null){

        $sugar_analysis_param = $this->findBySampleNo_SugarServiceId($sample_no, $sugar_service_id);
        $sugar_services = $this->__static->sugar_services();
        
        if ($sugar_service_id == $sugar_services['mois']) {
            $sugar_analysis_param->moisture_result_dec = $moisture_result_dec;   
            $sugar_analysis_param->moisture_sf_dec = $moisture_sf_dec;   
        }

        $sugar_analysis_param->result_dec = $result;
        $sugar_analysis_param->assessment = $this->setAssessment($sugar_analysis_param, $result, $moisture_sf_dec);
        $sugar_analysis_param->save();

        return $sugar_analysis_param;
        
    }






    private function findBySampleNo_SugarServiceId($sample_no, $sugar_service_id){

        $cache_key = 'sugar_analysis_parameter:findBySampleNo_SugarServiceId:'.$sample_no.':'. $sugar_service_id;

        $sugar_analysis_param = $this->cache->remember($cache_key, 240, function() use ($sample_no, $sugar_service_id){
            return $this->sugar_analysis_param->where('sample_no', $sample_no)
                                              ->where('sugar_service_id', $sugar_service_id)
                                              ->first();
        }); 
        
        if(empty($sugar_analysis_param)){ abort(404); }

        return $sugar_analysis_param;

    }






    private function getSugarAnalysisParameterIdInc(){

        $id = 'SAP1000001';

        $sugar_analysis_param = $this->sugar_analysis_param->select('sugar_analysis_parameter_id')
                                                           ->orderBy('sugar_analysis_parameter_id', 'desc')
                                                           ->first();

        if($sugar_analysis_param != null){
            $num = str_replace('SAP', '', $sugar_analysis_param->sugar_analysis_parameter_id) + 1;
            $id = 'SAP' . $num;
        }
        
        return $id;
        
    }






    private function setAssessment($sugar_analysis_param, $result, $moisture_sf_dec = null){

        $sugar_services = $this->__static->sugar_services();
        $rating = $sugar_analysis_param->sugar_service_id == $sugar_services['mois'] ? $moisture_sf_dec : $result;
        $assessment = "";


        if (isset($sugar_analysis_param->standard_dec_max) && is_null($sugar_analysis_param->standard_dec_min)) {
            
            if ($rating <= $sugar_analysis_param->standard_dec_max) {
                $assessment = "Within Std.";
            }elseif($rating > $sugar_analysis_param->standard_dec_max) {
                $assessment = "Above Std.";
            }

        }


        if (isset($sugar_analysis_param->standard_dec_max) && isset($sugar_analysis_param->standard_dec_min)) {
            
            if ($rating <= $sugar_analysis_param->standard_dec_max && $rating >= $sugar_analysis_param->standard_dec_min) {
                $assessment = "Within Std.";
            }elseif($rating > $sugar_analysis_param->standard_dec_max && $rating > $sugar_analysis_param->standard_dec_min){
                $assessment = "Above Std.";
            }elseif($rating < $sugar_analysis_param->standard_dec_max && $rating < $sugar_analysis_param->standard_dec_min){
                $assessment = "Below Std.";
            }

        }


        return $assessment;


    }





}