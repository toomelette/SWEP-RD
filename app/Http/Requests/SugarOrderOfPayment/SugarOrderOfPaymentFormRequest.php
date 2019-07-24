<?php

namespace App\Http\Requests\SugarOrderOfPayment;

use Illuminate\Foundation\Http\FormRequest;

class SugarOrderOfPaymentFormRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    


    public function rules(){

        $sugar_service = $this->request->get('sugar_service_id');

        $rules = [
            
            'customer_type'=>'required|string|max:11',
            'received_from'=>'sometimes|required|string|max:90',
            'mill_id'=>'sometimes|required|string|max:45',
            'address'=>'required|string|max:255',
            'date'=>'required|date_format:"m/d/Y"',
            'sugar_sample_id'=>'required|string|max:11',
            'cja_num_of_samples'=>'sometimes|required|numeric|max:50',
            'received_by'=>'required|string|max:90',

        ];
        
	    if(!empty($sugar_service)){
	        foreach($sugar_service as $key => $value){
	            $rules['sugar_service_id.'.$key] = 'required|string|max:11';
	        } 
	    }

        return $rules;

    }



}
