<?php

namespace App\Http\Requests\SugarOrderOfPayment;

use Illuminate\Foundation\Http\FormRequest;

class SugarOrderOfPaymentFormRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    


    public function rules(){

        $rules = [
            
            'sugar_sample_id'=>'required|string|max:11',
            'customer_type'=>'required|string|max:11',
            'received_from'=>'sometimes|required|string|max:90',
            'sugar_client_id'=>'sometimes|nullable|string|max:11',
            'mill_id'=>'sometimes|required|string|max:45',
            'address'=>'required|string|max:255',
            'date'=>'required|date_format:"m/d/Y"',
            'cja_num_of_samples'=>'sometimes|required|numeric|max:50',
            'received_by'=>'required|string|max:90',

        ];
        
	    if(!empty($this->request->get('sugar_service_id'))){
	        foreach($this->request->get('sugar_service_id') as $key => $value){
	            $rules['sugar_service_id.'.$key] = 'required|string|max:11';
	        } 
	    }

        return $rules;

    }



}
