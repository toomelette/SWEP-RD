<?php

namespace App\Core\Interfaces;
 


interface SugarAnalysisInterface {
	
	public function fetch($request);

	public function store($request, $total_price);

	public function updateOrderOfPayment($request, $slug, $total_price);

	public function updateResult($request, $slug);

	public function findBySlug($slug);

	public function getByDate_CustomerType_Sample_Id($date_from, $date_to, $customer_type, $sample_id);
		
}