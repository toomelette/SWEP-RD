<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SugarClientSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sugar_client.store', 'App\Core\Subscribers\SugarClientSubscriber@onStoreOOP');

    }




    public function onStoreOOP(){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_clients:getAll');

        $this->session->flash('SUGAR_CLIENT_CREATE_SUCCESS', 'Client has been successfully created!');

    }





}