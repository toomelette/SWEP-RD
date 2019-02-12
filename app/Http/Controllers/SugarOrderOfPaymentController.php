<?php

namespace App\Http\Controllers;


use App\Http\Requests\SugarOrderOfPayment\SugarOrderOfPaymentFormRequest;
use App\Http\Requests\SugarOrderOfPayment\SugarOrderOfPaymentFilterRequest;
use App\Core\Services\SugarOrderOfPaymentService;



class SugarOrderOfPaymentController extends Controller{



    protected $sugar_oop_service;




    public function __construct(SugarOrderOfPaymentService $sugar_oop_service){

        $this->sugar_oop_service = $sugar_oop_service;

    }




	 public function index(SugarOrderOfPaymentFilterRequest $request){
        
        return $this->sugar_oop_service->fetch($request);

    }


    

    public function create(){
        
        return view('dashboard.sugar_order_of_payment.create');

    }

   


    public function store(SugarOrderOfPaymentFormRequest $request){
        
        return $this->sugar_oop_service->store($request);

    }
 



    public function edit($slug){
        
        return $this->sugar_oop_service->edit($slug);

    }




    public function update(SugarOrderOfPaymentFormRequest $request, $slug){
        
        return $this->sugar_oop_service->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->sugar_oop_service->delete($slug);

    }

    


    public function show($slug){
        
        return $this->sugar_oop_service->show($slug);

    }

    


    public function print($slug){
        
        return $this->sugar_oop_service->print($slug);

    }



    
}
