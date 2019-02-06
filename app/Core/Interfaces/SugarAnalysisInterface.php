<?php

namespace App\Core\Interfaces;
 


interface SugarAnalysisInterface {
	
	public function fetch($request);

	public function store($request, $total_price);

	public function updateOrderOfPayment($request, $slug, $total_price);

	public function updateResult($request, $slug);

	public function findBySlug($slug);
		
}