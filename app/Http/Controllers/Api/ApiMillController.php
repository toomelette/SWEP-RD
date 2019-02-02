<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;


use App\Core\Interfaces\MillInterface;
use Illuminate\Http\Request;




class ApiMillController extends Controller{




	protected $mill_repo;





	public function __construct(MillInterface $mill_repo){

		$this->mill_repo = $mill_repo;

	}






	public function inputMillByMillId(Request $request, $mill_id){

    	if($request->Ajax()){
    		$response_mill = $this->mill_repo->getByMillId($mill_id);
	    	return json_encode($response_mill);
	    }

	    return abort(404);

    }






    
}
