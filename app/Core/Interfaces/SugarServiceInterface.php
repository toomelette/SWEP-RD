<?php

namespace App\Core\Interfaces;
 


interface SugarServiceInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function getAll();

	public function findBySugarServiceId($ss_id);
		
}