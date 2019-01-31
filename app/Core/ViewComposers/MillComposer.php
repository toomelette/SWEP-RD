<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\MillInterface;


class MillComposer{
   



	protected $mill_repo;




	public function __construct(MillInterface $mill_repo){

		$this->mill_repo = $mill_repo;

	}





    public function compose($view){

        $mills = $this->mill_repo->getAll();
        
    	$view->with('global_mills_all', $mills);

    }






}