<?php

namespace App\Http\Controllers;


use App\Core\Services\MillService;
use App\Http\Requests\Mill\MillFormRequest;
use App\Http\Requests\Mill\MillFilterRequest;


class MillController extends Controller{


    protected $mill_service;



    public function __construct(MillService $mill_service){

        $this->mill_service = $mill_service;

    }




    
    public function index(MillFilterRequest $request){
        
        return $this->mill_service->fetch($request);

    }


    

    public function create(){
        
        return view('dashboard.mill.create');

    }


   

    public function store(MillFormRequest $request){
        
        return $this->mill_service->store($request);

    }
 



    public function edit($slug){
        
        return $this->mill_service->edit($slug);

    }




    public function update(MillFormRequest $request, $slug){
        
        return $this->mill_service->update($request, $slug);

    }

    


    public function destroy($slug){
        
       return $this->mill_service->destroy($slug);

    }



    
}
