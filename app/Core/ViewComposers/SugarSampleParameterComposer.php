<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\SugarSampleParameterInterface;



class SugarSampleParameterComposer{
   


	protected $ss_parameter;




	public function __construct(SugarSampleParameterInterface $ss_parameter){

		$this->ss_parameter = $ss_parameter;

	}





    public function compose($view){

        $ss_parameter_raw_sugar = $this->ss_parameter->getBySugarSampleId('SS1001');
        $ss_parameter_raw_sugar_complete = $this->ss_parameter->getBySugarSampleId('SS1002');
        $ss_parameter_raw_sugar_special = $this->ss_parameter->getBySugarSampleId('SS1005');
        $ss_parameter_muscovado = $this->ss_parameter->getBySugarSampleId('SS1003');
        $ss_parameter_molasses = $this->ss_parameter->getBySugarSampleId('SS1004');
        
    	$view->with([

    		'global_sugar_sample_parameter_raw_sugar' => $ss_parameter_raw_sugar,
    		'global_sugar_sample_parameter_raw_sugar_complete' => $ss_parameter_raw_sugar_complete, 
    		'global_sugar_sample_parameter_raw_sugar_special' => $ss_parameter_raw_sugar_special, 
    		'global_sugar_sample_parameter_muscovado' => $ss_parameter_muscovado, 
    		'global_sugar_sample_parameter_molasses' => $ss_parameter_molasses, 

    	]);

    }






}