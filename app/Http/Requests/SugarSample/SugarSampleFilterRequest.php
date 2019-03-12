<?php

namespace App\Http\Requests\SugarSample;

use Illuminate\Foundation\Http\FormRequest;

class SugarSampleFilterRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    


    public function rules(){

        return [
            
        ];

    }
    



}
