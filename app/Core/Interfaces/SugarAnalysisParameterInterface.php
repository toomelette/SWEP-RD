<?php

namespace App\Core\Interfaces;
 


interface SugarAnalysisParameterInterface {

	public function store($sample_no, $sugar_service_instance);

	public function update($sample_no, $sugar_service_id ,$result, $moisture_result_dec = null, $moisture_sf_dec = null);
		
}