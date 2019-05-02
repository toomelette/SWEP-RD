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




    public function onStore($sa, $cja){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sa->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:getBySlug:'. $cja->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:findBySlug:'. $cja->slug .'');

        $this->session->flash('CJ_ANALYSIS_CREATE_SUCCESS', 'Record successfully created!');
        $this->session->flash('CJ_ANALYSIS_CREATE_SUCCESS_SLUG', $cja->slug);

    }




    public function onUpdate($sa, $cja){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sa->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:getBySlug:'. $cja->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:findBySlug:'. $cja->slug .'');

        $this->session->flash('CJ_ANALYSIS_UPDATE_SUCCESS', 'Record successfully updated!');
        $this->session->flash('CJ_ANALYSIS_UPDATE_SUCCESS_SLUG', $cja->slug);

    }




    public function onDestroy($sa, $cja){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:'. $sa->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:getBySlug:'. $cja->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:cane_juice_analysis:findBySlug:'. $cja->slug .'');

        $this->session->flash('CJ_ANALYSIS_DESTROY_SUCCESS', 'Record successfully updated!');
        $this->session->flash('CJ_ANALYSIS_DESTROY_SUCCESS_SLUG', $cja->slug);

    }




}