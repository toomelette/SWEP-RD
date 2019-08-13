<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Helpers\__static;
use App\Core\Interfaces\SugarSampleParameterInterface;



class SugarSampleParameterComposer{
   


	protected $ss_parameter;
    protected $__static;




	public function __construct(SugarSampleParameterInterface $ss_parameter, __static $__static){

		$this->ss_parameter = $ss_parameter;
        $this->__static = $__static;

	}





    public function compose($view){

        $sugar_samples = $this->__static->sugar_samples();

        $ss_parameter_raw_sugar = $this->ss_parameter->getBySugarSampleId($sugar_samples['rawSugar']);
        $ss_parameter_muscovado = $this->ss_parameter->getBySugarSampleId($sugar_samples['muscovado']);
        $ss_parameter_molasses = $this->ss_parameter->getBySugarSampleId($sugar_samples['molasses']);
        $ss_parameter_cja = $this->ss_parameter->getBySugarSampleId($sugar_samples['cja']);
        
    	$view->with([

    		'global_sugar_sample_parameter_raw_sugar' => $ss_parameter_raw_sugar, 
    		'global_sugar_sample_parameter_muscovado' => $ss_parameter_muscovado, 
            'global_sugar_sample_parameter_molasses' => $ss_parameter_molasses, 
            'global_sugar_sample_parameter_cja' => $ss_parameter_cja, 

    	]);

    }






}