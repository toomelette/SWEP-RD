<?php

namespace App\Core\Interfaces;
 


interface SugarClientInterface {

	public function getAll();

	public function store($request);

	public function isExist($sugar_client_id);
		
}