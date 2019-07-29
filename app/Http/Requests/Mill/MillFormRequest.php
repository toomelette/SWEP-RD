<?php

namespace App\Http\Requests\Mill;

use Illuminate\Foundation\Http\FormRequest;

class MillFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }



    public function rules(){

        return [

            'mill_id' => 'required|max:45|string',
            'name' => 'required|max:255|string',
            'short_name' => 'required|max:90|string',
            'address' => 'required|max:255|string',
            'district' => 'required|max:45|string',

        ];
    
    }


    
}
