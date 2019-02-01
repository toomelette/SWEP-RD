<?php

namespace App\Http\Controllers;


use App\Http\Requests\SugarOrderOfPayment\SugarOrderOfPaymentFormRequest;
use App\Http\Requests\SugarOrderOfPayment\SugarOrderOfPaymentFilterRequest;
use App\Core\Services\SugarOrderOfPaymentService;



class SugarOrderOfPaymentController extends Controller{



    protected $sugar_oop;




    public function __construct(SugarOrderOfPaymentService $sugar_oop){

        $this->sugar_oop = $sugar_oop;

    }




	 public function index(SugarOrderOfPaymentFilterRequest $request){
        
        dd('List');

    }


    

    public function create(){
        
        return view('dashboard.sugar_order_of_payment.create');

    }

   


    public function store(SugarOrderOfPaymentFormRequest $request){
        
        return $this->sugar_oop->store($request);

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
