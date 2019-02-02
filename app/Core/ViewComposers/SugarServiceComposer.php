<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\SugarServiceInterface;


class SugarServiceComposer{
   



	protected $sugar_service_repo;




	public function __construct(SugarServiceInterface $sugar_service_repo){

		$this->sugar_service_repo = $sugar_service_repo;

	}





    public function compose($view){

        $sugar_services = $this->sugar_service_repo->getAll();
        
    	$view->with('global_sugar_service_all', $sugar_services);

    }






}