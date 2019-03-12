<?php

namespace App\Http\Controllers;

use App\Core\Services\SugarSampleService;
use App\Http\Requests\SugarSample\SugarSampleFormRequest;
use App\Http\Requests\SugarSample\SugarSampleFilterRequest;



class SugarSampleController extends Controller{


	protected $sugar_sample_service;



    public function __construct(SugarSampleService $sugar_sample_service){

        $this->sugar_sample_service = $sugar_sample_service;

	}



	public function index(SugarSampleFilterRequest $request){
        
        return $this->sugar_sample_service->fetch($request);

    }


    

    public function create(){
        
        return view('dashboard.sugar_sample.create');

    }


   

    public function store(SugarSampleFormRequest $request){
        
        return $this->sugar_sample_service->store($request);

    }
 



    public function edit($slug){
        
        return $this->sugar_sample_service->edit($slug);

    }

    


    public function show($slug){
        
        return $this->sugar_sample_service->show($slug);

    }




    public function update(SugarSampleFormRequest $request, $slug){
        
        return $this->sugar_sample_service->update($request, $slug);

    }

    


    public function destroy($slug){
        
       return $this->sugar_sample_service->destroy($slug);

    }



    
}
