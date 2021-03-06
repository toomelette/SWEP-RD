<?php

namespace App\Core\Interfaces;
 


interface SugarAnalysisInterface {
	
	public function fetch($request);

	public function setOrNo($request, $slug);

	public function storeOrderOfPayment($request, $total_price, $sample_no);

	public function updateOrderOfPayment($request, $slug, $total_price);

	public function updateResult($request, $sugar_analysis);

	public function findBySlug($slug);

	public function getByCustomerType_SugarSampleId_Date($customer_type, $sugar_sample_id, $date_from, $date_to);

	public function getByMillId_SugarSampleId_WeekEnding($mill_id, $sugar_sample_id, $week_ending_from, $week_ending_to);

	public function getBySugarSampleId_WeekEnding($sugar_sample_id, $week_ending_from, $week_ending_to);
		
}