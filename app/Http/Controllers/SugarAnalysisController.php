<?php

namespace App\Http\Controllers;

use App\Http\Requests\SugarAnalysis\SugarAnalysisFormRequest;
use App\Http\Requests\SugarAnalysis\SugarAnalysisFilterRequest;
use App\Core\Services\SugarAnalysisService;



class SugarAnalysisController extends Controller{

	

	protected $sa_service;




    public function __construct(SugarAnalysisService $sa_service){

        $this->sa_service = $sa_service;

    }




	 public function index(SugarAnalysisFilterRequest $request){
        
        return $this->sa_service->fetch($request);

    }




	 public function edit($slug){
        
        return $this->sa_service->edit($slug);

    }




	 public function update(SugarAnalysisFormRequest $request, $slug){
        
        return $this->sa_service->update($request, $slug);

    }




	 public function report(){
        
        return dd('Reports');

    }



    
}
