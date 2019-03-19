<?php

namespace App\Http\Requests\SugarService;

use Illuminate\Foundation\Http\FormRequest;

class SugarServiceFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


   

    public function rules(){

        return [
            
        	'q'=>'nullable|string|max:90',
            
        ];

    }


    
}
