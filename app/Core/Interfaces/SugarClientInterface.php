<?php

namespace App\Core\Interfaces;
 


interface SugarClientInterface {

	public function store($request);

	public function getAll();

	public function isExist($sugar_client_id);
		
}