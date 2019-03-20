<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SugarSampleSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }




	public function subscribe($events){

		$events->listen('sugar_sample.store', 'App\Core\Subscribers\SugarSampleSubscriber@onStore');
        $events->listen('sugar_sample.update', 'App\Core\Subscribers\SugarSampleSubscriber@onUpdate');
        $events->listen('sugar_sample.destroy', 'App\Core\Subscribers\SugarSampleSubscriber@onDestroy');

	}




    public function onStore(){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:getAll');

        $this->session->flash('SUGAR_SAMPLE_CREATE_SUCCESS', 'Sugar Sample has been successfully created!');

    }




    public function onUpdate($sugar_sample){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:findBySlug:'. $sugar_sample->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:findBySugarSampleId:'. $sugar_sample->sugar_sample_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:getAll');
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_sample_parameters:getBySugarSampleId:'. $sugar_sample->sugar_sample_id .'');

        $this->session->flash('SUGAR_SAMPLE_UPDATE_SUCCESS', 'Sugar Sample has been successfully updated!');
        $this->session->flash('SUGAR_SAMPLE_UPDATE_SUCCESS_SLUG', $sugar_sample->slug);

    }




    public function onDestroy($sugar_sample){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:findBySlug:'. $sugar_sample->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:findBySugarSampleId:'. $sugar_sample->sugar_sample_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_samples:getAll');
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_sample_parameters:getBySugarSampleId:'. $sugar_sample->sugar_sample_id .'');

        $this->session->flash('SUGAR_SAMPLE_DELETE_SUCCESS', 'Sugar Sample has been successfully deleted!');
        $this->session->flash('SUGAR_SAMPLE_DELETE_SUCCESS_SLUG', $sugar_sample->slug);

    }





}