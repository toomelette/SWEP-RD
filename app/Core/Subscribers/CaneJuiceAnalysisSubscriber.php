<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class CaneJuiceAnalysisSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('cane_juice_analysis.store', 'App\Core\Subscribers\CaneJuiceAnalysisSubscriber@onStore');
        $events->listen('cane_juice_analysis.update', 'App\Core\Subscribers\CaneJuiceAnalysisSubscriber@onUpdate');
        $events->listen('cane_juice_analysis.destroy', 'App\Core\Subscribers\CaneJuiceAnalysisSubscriber@onDestroy');

    }




    public function onStore($sugar_analysis, $cane_juice_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sugar_analysis->slug .'');

        $this->session->flash('CJ_ANALYSIS_CREATE_SUCCESS', 'Record successfully created!');
        $this->session->flash('CJ_ANALYSIS_CREATE_SUCCESS_SLUG', $cane_juice_analysis->slug);

    }




    public function onUpdate($sugar_analysis, $cane_juice_analysis){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sugar_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:findBySlug:'. $cane_juice_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:getBySlug:'. $cane_juice_analysis->slug .'');

        $this->session->flash('CJ_ANALYSIS_UPDATE_SUCCESS', 'Record successfully updated!');
        $this->session->flash('CJ_ANALYSIS_UPDATE_SUCCESS_SLUG', $cane_juice_analysis->slug);

    }




    public function onDestroy($sugar_analysis, $cane_juice_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sugar_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:getBySlug:'. $cane_juice_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:findBySlug:'. $cane_juice_analysis->slug .'');

        $this->session->flash('CJ_ANALYSIS_DESTROY_SUCCESS', 'Record successfully deleted!');
        $this->session->flash('CJ_ANALYSIS_DESTROY_SUCCESS_SLUG', $cane_juice_analysis->slug);

    }




}