<?php

namespace App\Http\Requests\SugarOrderOfPayment;

use Illuminate\Foundation\Http\FormRequest;

class SugarOrderOfPaymentFilterRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    


    public function rules(){

        return [
            
        ];

    }
    



}
