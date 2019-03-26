<?php

namespace App\Http\Requests\SugarSample;

use Illuminate\Foundation\Http\FormRequest;

class SugarSampleFilterRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    


   

    public function rules(){

        return [
            
        	'q'=>'nullable|string|max:90',
            'ss' => 'nullable|max:20|string',
            'we' => 'date_format:"m/d/Y"|nullable',
            
        ];

    }
    



}
