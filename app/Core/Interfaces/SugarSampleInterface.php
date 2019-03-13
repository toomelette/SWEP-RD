<?php

namespace App\Core\Interfaces;
 


interface SugarSampleInterface{
	
	public function store($request);
	
	public function fetch($request);
	
	public function findBySlug($slug);
	
	public function findBySugarSampleId($id);
	
	public function update($request, $slug);
	
	public function destroy($slug);

	public function getAll();
		
}