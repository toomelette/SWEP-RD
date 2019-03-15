<?php

namespace App\Core\Interfaces;
 


interface SugarAnalysisParameterInterface {

	public function store($sample_no, $obj);

	public function update($sample_no, $sugar_service_id ,$result);
		
}