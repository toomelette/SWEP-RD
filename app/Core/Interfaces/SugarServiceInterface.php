<?php

namespace App\Core\Interfaces;
 


interface SugarServiceInterface {

	public function getAll();

	public function findBySugarServiceId($ss_id);
		
}