<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\SugarSampleInterface;



class SugarSampleComposer{
   


	protected $sugar_sample;




	public function __construct(SugarSampleInterface $sugar_sample){

		$this->sugar_sample = $sugar_sample;

	}





    public function compose($view){

        $sugar_samples = $this->sugar_sample->getAll();
        
    	$view->with('global_sugar_samples_all', $sugar_samples);

    }






}