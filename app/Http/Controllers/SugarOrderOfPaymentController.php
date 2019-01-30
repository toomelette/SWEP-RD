<?php

namespace App\Http\Controllers;


use App\Http\Requests\SugarOrderOfPayment\SugarOrderOfPaymentFormRequest;
use App\Http\Requests\SugarOrderOfPayment\SugarOrderOfPaymentFilterRequest;


class SugarOrderOfPaymentController extends Controller{





	 public function index(SugarOrderOfPaymentFilterRequest $request){
        
        dd('List');

    }

    

    public function create(){
        
        return view('dashboard.sugar_order_of_payment.create');

    }

   

    public function store(SugarOrderOfPaymentFormRequest $request){
        
        dd('Store');

    }
 



    public function edit($slug){
        
        dd('Edit');

    }




    public function update(SugarOrderOfPaymentFormRequest $request, $slug){
        
        dd('Update');

    }

    


    public function destroy($slug){
        
        dd('Destroy');

    }



    
}
