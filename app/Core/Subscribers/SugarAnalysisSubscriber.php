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




    public function onUpdate($sa){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sa->slug .'');

        $this->session->flash('SUGAR_ANALYSIS_UPDATE_SUCCESS', 'Sugar Analysis Result has been successfully updated!');
        $this->session->flash('SUGAR_ANALYSIS_UPDATE_SUCCESS_SLUG', $sa->slug);

    }




    public function onSetOrNo($sa){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sa->slug .'');

        $this->session->flash('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS', 'OR No. successfully set!!');

    }





}