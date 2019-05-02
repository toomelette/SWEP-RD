<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;


use App\Core\Interfaces\CaneJuiceAnalysisInterface;
use Illuminate\Http\Request;




class ApiSugarAnalysisController extends Controller{




	protected $cja_repo;





	public function __construct(CaneJuiceAnalysisInterface $cja_repo){

		$this->cja_repo = $cja_repo;

	}






	public function editCaneJuiceAnalysis(Request $request, $slug){

    	if($request->Ajax()){
    		$response_cja = $this->cja_repo->getBySlug($slug);
	    	return json_encode($response_cja);
	    }

	    return abort(404);

    }






    
}
