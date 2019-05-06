<?php

namespace App\Http\Requests\SugarAnalysis;

use Illuminate\Foundation\Http\FormRequest;

class SugarAnalysisReportFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            't'=>'required|string|max:11',
        	'year'=>'required|integer|max:3000',
        ];
    
    }



}
