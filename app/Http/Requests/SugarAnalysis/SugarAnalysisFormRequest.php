<?php

namespace App\Http\Requests\SugarAnalysis;

use Illuminate\Foundation\Http\FormRequest;

class SugarAnalysisFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
        ];
    
    }



}
