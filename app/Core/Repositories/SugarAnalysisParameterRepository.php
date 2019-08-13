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
        $sa_parameter->sugar_analysis_parameter_id = $this->getSugarAnalysisParameterIdInc();
        $sa_parameter->sugar_service_id = $sugar_service->sugar_service_id;
        $sa_parameter->name = $sugar_service->name;
        $sa_parameter->price = $sugar_service->price;
        $sa_parameter->standard_str = $sugar_service->standard_str;
        $sa_parameter->standard_dec_max = $sugar_service->standard_dec_max;
        $sa_parameter->standard_dec_min = $sugar_service->standard_dec_min;
        $sa_parameter->save();

        return $sa_parameter;
        
    }





    public function update($sample_no, $sugar_service_id, $result, $moisture_result_dec = null, $moisture_sf_dec = null){

        $sa_parameter = $this->findBySampleNo_SugarServiceId($sample_no, $sugar_service_id);
        $sugar_services = $this->__static->sugar_services();
        
        if ($sugar_service_id == $sugar_services['mois']) {
            $sa_parameter->moisture_result_dec = $moisture_result_dec;   
            $sa_parameter->moisture_sf_dec = $moisture_sf_dec;   
        }

        $sa_parameter->result_dec = $result;
        $sa_parameter->assessment = $this->setAssessment($sa_parameter, $result, $moisture_sf_dec);
        $sa_parameter->save();

        return $sa_parameter;
        
    }






    public function findBySampleNo_SugarServiceId($sample_no, $sugar_service_id){

        $cache_key = 'sugar_analysis_parameter:findBySampleNo_SugarServiceId:'.$sample_no.':'. $sugar_service_id;

        $sa_parameter = $this->cache->remember($cache_key, 240, function() use ($sample_no, $sugar_service_id){
            return $this->sa_parameter->where('sample_no', $sample_no)->where('sugar_service_id', $sugar_service_id)->first();
        }); 
        
        if(empty($sa_parameter)){ abort(404); }

        return $sa_parameter;

    }






    private function getSugarAnalysisParameterIdInc(){

        $id = 'SAP1000001';

        $sa_parameter = $this->sa_parameter->select('sugar_analysis_parameter_id')
                                           ->orderBy('sugar_analysis_parameter_id', 'desc')
                                           ->first();

        if($sa_parameter != null){
            $num = str_replace('SAP', '', $sa_parameter->sugar_analysis_parameter_id) + 1;
            $id = 'SAP' . $num;
        }
        
        return $id;
        
    }






    private function setAssessment($sa_parameter, $result, $moisture_sf_dec = null){

        $sugar_services = $this->__static->sugar_services();
        $rating = $sa_parameter->sugar_service_id == $sugar_services['mois'] ? $moisture_sf_dec : $result;
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