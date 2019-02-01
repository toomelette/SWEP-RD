<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SugarOrderOfPaymentSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }




	public function subscribe($events){

		$events->listen('sugar_oop.store', 'App\Core\Subscribers\SugarOrderOfPaymentSubscriber@onStore');

	}




    public function onStore($sugar_oop){

        $this->session->flash('SUGAR_OOP_CREATE_SUCCESS', 'Order of Payment has been successfully created!');
        $this->session->flash('SUGAR_OOP_CREATE_SUCCESS_SLUG', $sugar_oop->slug);

    }





}