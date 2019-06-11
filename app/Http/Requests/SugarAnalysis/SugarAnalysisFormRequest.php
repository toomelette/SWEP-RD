<?php

namespace App\Http\Requests\SugarAnalysis;

use Illuminate\Foundation\Http\FormRequest;

class SugarAnalysisFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
        	'week_ending'=>'required|date_format:"m/d/Y"',
        	'date_sampled'=>'required|date_format:"m/d/Y"',
        	'date_submitted'=>'required|date_format:"m/d/Y"',
        	'date_analyzed_from'=>'required|date_format:"m/d/Y"',
            'date_analyzed_to'=>'required|date_format:"m/d/Y"',
            'quantity'=>'nullable|string|max:45',
            'code'=>'sometimes|nullable|string|max:45',
            'report_no'=>'sometimes|nullable|string|max:45',
            'source'=>'sometimes|nullable|string|max:255',

        ];
    
    }



}
