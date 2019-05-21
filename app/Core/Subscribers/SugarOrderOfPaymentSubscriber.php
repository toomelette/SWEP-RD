<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SugarOrderOfPaymentSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }




	public function subscribe($events){

		$events->listen('sugar_oop.store', 'App\Core\Subscribers\SugarOrderOfPaymentSubscriber@onStore');
        $events->listen('sugar_oop.update', 'App\Core\Subscribers\SugarOrderOfPaymentSubscriber@onUpdate');
        $events->listen('sugar_oop.destroy', 'App\Core\Subscribers\SugarOrderOfPaymentSubscriber@onDestroy');

	}




    public function onStore($sugar_oop){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_order_of_payments:fetch:*');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:fetch:*');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:getByDate_CustomerType_SampleId:*');

        $this->session->flash('SUGAR_OOP_CREATE_SUCCESS', 'Order of Payment has been successfully created!');
        $this->session->flash('SUGAR_OOP_CREATE_SUCCESS_SLUG', $sugar_oop->slug);

    }




    public function onUpdate($sugar_oop){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_order_of_payments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_order_of_payments:findBySlug:'. $sugar_oop->slug .'');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:*');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:getByDate_CustomerType_SampleId:*');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis_parameter:findBySampleNoSugarServiceId:*');

        $this->session->flash('SUGAR_OOP_UPDATE_SUCCESS', 'Order of Payment has been successfully updated!');
        $this->session->flash('SUGAR_OOP_UPDATE_SUCCESS_SLUG', $sugar_oop->slug);

    }




    public function onDestroy($sugar_oop){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_order_of_payments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_order_of_payments:findBySlug:'. $sugar_oop->slug .'');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:findBySlug:*');

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis:getByDate_CustomerType_SampleId:*');
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sugar_analysis_parameter:findBySampleNoSugarServiceId:*');

        $this->session->flash('SUGAR_OOP_DELETE_SUCCESS', 'Order of Payment has been successfully deleted!');
        $this->session->flash('SUGAR_OOP_DELETE_SUCCESS_SLUG', $sugar_oop->slug);

    }





}