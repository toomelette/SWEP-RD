<?php

namespace App\Core\Interfaces;
 


interface SugarSampleParameterInterface{

	public function store($sugar_sample_id, $sugar_service);
	
	public function updateSugarService($sugar_service);
	
	public function getBySugarSampleId($sugar_sample_id);
		
}