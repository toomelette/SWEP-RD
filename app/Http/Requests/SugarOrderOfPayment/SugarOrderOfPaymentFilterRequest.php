<?php

namespace App\Http\Requests\SugarOrderOfPayment;

use Illuminate\Foundation\Http\FormRequest;

class SugarOrderOfPaymentFilterRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    

   

    public function rules(){

        return [
            
        	'q'=>'nullable|string|max:90',
            'ss' => 'nullable|max:20|string',
            'df' => 'date_format:"m/d/Y"|nullable',
            'dt' => 'date_format:"m/d/Y"|nullable',
            
        ];

    }
    



}
