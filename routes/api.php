<?php


// Submenu
Route::get('/submenu/select_submenu_byMenuId/{menu_id}', 'Api\ApiSubmenuController@selectSubmenuByMenuId')
		->name('selectSubmenuByMenuId');


// Mill
Route::get('/mill/input_mill_byMillId/{mill_id}', 'Api\ApiMillController@inputMillByMillId')
		->name('inputMillByMillId');


// Sugar Analysis
Route::get('/sugar_analysis/cane_juice_analysis/{slug}/edit', 'Api\ApiSugarAnalysisController@editCaneJuiceAnalysis')
		->name('sugar_analysis.cane_juice_analysis_edit');



