<?php

namespace App\Core\Interfaces;
 


interface CaneJuiceAnalysisInterface {

	public function store($request, $slug);

	public function update($request, $slug, $cja_slug);

	public function destroy($slug, $cja_slug);

	public function getBySlug($cja_slug);
		
}