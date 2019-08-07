<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SugarAnalysisSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }




	public function subscribe($events){

        $events->listen('sugar_analysis.update', 'App\Core\Subscribers\SugarAnalysisSubscriber@onUpdate');
        $events->listen('sugar_analysis.set_or_no', 'App\Core\Subscribers\SugarAnalysisSubscriber@onSetOrNo');

	}




    public function onUpdate($sugar_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sugar_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:getByMillId_SugarSampleId_WeekEnding:'. $sugar_analysis->mill_id .':'. $sugar_analysis->sugar_sample_id .':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:getBySugarSampleId_WeekEnding:'. $sugar_analysis->sugar_sample_id .':*');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis_parameter:findBySampleNo_SugarServiceId:'. $sugar_analysis->sample_no .':*');

        $this->session->flash('SUGAR_ANALYSIS_UPDATE_SUCCESS', 'Sugar Analysis Result has been successfully updated!');
        $this->session->flash('SUGAR_ANALYSIS_UPDATE_SUCCESS_SLUG', $sugar_analysis->slug);

    }




    public function onSetOrNo($sugar_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sugar_analysis->slug .'');

        $this->session->flash('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS', 'OR No. successfully set!!');

    }





}