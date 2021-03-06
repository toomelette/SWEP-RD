<?php

namespace App\Core\Interfaces;
 


interface MillInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function findByMillId($mill_id);

	public function getAll();

	public function getByMillId($mill_id);
		
}