<?php

namespace App\Core\Interfaces;
 


interface CaneJuiceAnalysisInterface {

	public function store($request, $sample_no);

	public function update($request, $cja_slug);

	public function destroy($cja_slug);

	public function getBySlug($cja_slug);
		
}