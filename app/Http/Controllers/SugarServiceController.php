<?php

namespace App\Http\Controllers;

use App\Core\Services\SugarServiceService;
use App\Http\Requests\SugarService\SugarServiceFormRequest;
use App\Http\Requests\SugarService\SugarServiceFilterRequest;



class SugarServiceController extends Controller{



    protected $ss_service;



    public function __construct(SugarServiceService $ss_service){

        $this->ss_service = $ss_service;

	}



	public function index(SugarServiceFilterRequest $request){
        
        return $this->ss_service->fetch($request);

    }


    

    public function create(){
        
        return view('dashboard.sugar_service.create');

    }


   

    public function store(SugarServiceFormRequest $request){
        
        return $this->ss_service->store($request);

    }
 



    public function edit($slug){
        
        return $this->ss_service->edit($slug);

    }




    public function update(SugarServiceFormRequest $request, $slug){
        
        return $this->ss_service->update($request, $slug);

    }

    


    public function destroy($slug){
        
       return $this->ss_service->destroy($slug);

    }




    
}
