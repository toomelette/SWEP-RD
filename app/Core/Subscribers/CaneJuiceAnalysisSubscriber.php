<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class CaneJuiceAnalysisSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('cane_juice_analysis.store', 'App\Core\Subscribers\CaneJuiceAnalysisSubscriber@onStore');

    }




    public function onStore($sa, $cja){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sa->slug .'');

        $this->session->flash('CJ_ANALYSIS_CREATE_SUCCESS', 'Record successfully created!');
        $this->session->flash('CJ_ANALYSIS_CREATE_SUCCESS_SLUG', $cja->slug);

    }





}