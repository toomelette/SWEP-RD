<?php

namespace App\Core\Interfaces;
 


interface SugarOrderOfPaymentInterface {

	public function store($request, $total_price);
		
}