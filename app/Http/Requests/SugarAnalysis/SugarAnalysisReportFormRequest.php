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
        	'year'=>'sometimes|required|integer|max:3000',


        	'mill_id'=>'sometimes|required|string|max:11',
            'sugar_sample_id'=>'sometimes|required|string|max:11',
        	'we_from'=>'sometimes|required|date_format:"m/d/Y"',
        	'we_to'=>'sometimes|required|date_format:"m/d/Y"',
        	
        ];
    
    }



}
