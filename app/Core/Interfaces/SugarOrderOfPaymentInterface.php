<?php

namespace App\Core\Interfaces;
 


interface SugarOrderOfPaymentInterface {
	
	public function fetch($request);

	public function store($request, $total_price);

	public function update($request, $sugar_oop, $total_price);

	public function findBySlug($slug);
		
}