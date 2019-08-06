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

        	'arar_year'=>'sometimes|required|integer|max:3000',

        	'soam_mill_id'=>'sometimes|required|string|max:11',
            'soam_sugar_sample_id'=>'sometimes|required|string|max:11',
        	'soam_we_from'=>'sometimes|required|date_format:"m/d/Y"',
        	'soam_we_to'=>'sometimes|required|date_format:"m/d/Y"',

            'sosa_we_from'=>'sometimes|required|date_format:"m/d/Y"',
            'sosa_we_to'=>'sometimes|required|date_format:"m/d/Y"',

        	
        ];
    
    }



}
