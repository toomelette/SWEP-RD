<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SugarServiceSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sugar_service.store', 'App\Core\Subscribers\SugarServiceSubscriber@onStore');
        $events->listen('sugar_service.update', 'App\Core\Subscribers\SugarServiceSubscriber@onUpdate');
        $events->listen('sugar_service.destroy', 'App\Core\Subscribers\SugarServiceSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:getAll:*');

        $this->session->flash('SUGAR_SERVICE_CREATE_SUCCESS', 'Laboratory Service has been successfully created!');

    }





    public function onUpdate($sugar_service){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:getAll:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:findBySlug:'. $sugar_service->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:findBySugarServiceId:'. $sugar_service->sugar_service_id .'');

        $this->session->flash('SUGAR_SERVICE_UPDATE_SUCCESS', 'Laboratory Service has been successfully updated!');
        $this->session->flash('SUGAR_SERVICE_UPDATE_SUCCESS_SLUG', $sugar_service->slug);

    }



    public function onDestroy($sugar_service){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:getAll:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:findBySlug:'. $sugar_service->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_services:findBySugarServiceId:'. $sugar_service->sugar_service_id .'');

        $this->session->flash('SUGAR_SERVICE_DELETE_SUCCESS', 'Laboratory Service has been successfully deleted!');
        $this->session->flash('SUGAR_SERVICE_DELETE_SUCCESS_SLUG', $sugar_service->slug);

    }





}