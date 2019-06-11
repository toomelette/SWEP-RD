<?php

namespace App\Http\Controllers;

use App\Http\Requests\SugarAnalysis\SugarAnalysisFormRequest;
use App\Http\Requests\SugarAnalysis\SugarAnalysisFilterRequest;
use App\Http\Requests\SugarAnalysis\SugarAnalysisReportFormRequest;
use App\Http\Requests\SugarAnalysis\SugarAnalysisCaneJuiceCreateFormRequest;
use App\Http\Requests\SugarAnalysis\SugarAnalysisCaneJuiceEditFormRequest;
use App\Http\Requests\SugarAnalysis\SugarAnalysisSetOrNoFormRequest;
use App\Core\Services\SugarAnalysisService;



class SugarAnalysisController extends Controller{

	

	protected $sa_service;




    public function __construct(SugarAnalysisService $sa_service){

        $this->sa_service = $sa_service;

    }




	 public function index(SugarAnalysisFilterRequest $request){
        
        return $this->sa_service->fetch($request);

    }




     public function setOrNo(SugarAnalysisSetOrNoFormRequest $request, $slug){
        
        return $this->sa_service->setOrNo($request, $slug);

    }




	 public function edit($slug){
        
        return $this->sa_service->edit($slug);

    }




	 public function update(SugarAnalysisFormRequest $request, $slug){
        
        return $this->sa_service->update($request, $slug);

    }




     public function show($slug){
        
        return $this->sa_service->show($slug);

    }




     public function print($slug){
        
        return $this->sa_service->print($slug);

    }




	 public function report(){
        
        return view('dashboard.sugar_analysis.report');

    }




     public function report_generate(SugarAnalysisReportFormRequest $request){
        
        return $this->sa_service->report_generate($request);

    }




     public function caneJuiceAnalysisSetOrNo(SugarAnalysisCaneJuiceSetOrNoFormRequest $request, $slug){
        
        return $this->sa_service->caneJuiceAnalysisSetOrNo($request, $slug);

    }




     public function caneJuiceAnalysisStore(SugarAnalysisCaneJuiceCreateFormRequest $request, $slug){
        
        return $this->sa_service->caneJuiceAnalysisStore($request, $slug);

    }




     public function caneJuiceAnalysisUpdate(SugarAnalysisCaneJuiceEditFormRequest $request, $slug, $cja_slug){
        
        return $this->sa_service->caneJuiceAnalysisUpdate($request, $slug, $cja_slug);

    }




     public function caneJuiceAnalysisDestroy($slug, $cja_slug){
        
        return $this->sa_service->caneJuiceAnalysisDestroy($slug, $cja_slug);

    }




     public function caneJuiceAnalysisPrint($slug){
        
        return $this->sa_service->caneJuiceAnalysisPrint($slug);

    }



    
}
