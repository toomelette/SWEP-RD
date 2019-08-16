<?php

namespace App\Core\Interfaces;
 


interface CaneJuiceAnalysisInterface {

	public function store($request, $sample_no);

	public function update($request, $cane_juice_analysis_slug);

	public function destroy($cane_juice_analysis_slug);

	public function getBySlug($cane_juice_analysis_slug);
		
}