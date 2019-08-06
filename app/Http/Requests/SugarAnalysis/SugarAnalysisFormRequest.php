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
            'date_submitted'=>'required|date_format:"m/d/Y"',
        	'date_sampled'=>'required|date_format:"m/d/Y"',
        	'date_analyzed_from'=>'required|date_format:"m/d/Y"',
            'date_analyzed_to'=>'required|date_format:"m/d/Y"',
            'quantity_mt'=>'nullable|numeric|max:100000',
            'code'=>'sometimes|nullable|string|max:45',
            'report_no'=>'sometimes|nullable|string|max:45',
            'source'=>'sometimes|nullable|string|max:255',

            'SS1001'=>'sometimes|nullable|numeric|max:10000',
            'SS1002'=>'sometimes|nullable|numeric|max:10000',
            'SS1003'=>'sometimes|nullable|numeric|max:10000',
            'SS1004'=>'sometimes|nullable|numeric|max:10000',
            'SS1005'=>'sometimes|nullable|numeric|max:10000',
            'SS1006'=>'sometimes|nullable|numeric|max:10000',
            'SS1007'=>'sometimes|nullable|numeric|max:10000',
            'SS1008'=>'sometimes|nullable|numeric|max:10000',
            'SS1009'=>'sometimes|nullable|numeric|max:10000',
            'SS1010'=>'sometimes|nullable|numeric|max:10000',
            'SS1011'=>'sometimes|nullable|numeric|max:10000',
            'SS1012'=>'sometimes|nullable|numeric|max:10000',
            'SS1013'=>'sometimes|nullable|numeric|max:10000',
            'SS1014'=>'sometimes|nullable|numeric|max:10000',
            'SS1015'=>'sometimes|nullable|numeric|max:10000',
            'SS1016'=>'sometimes|nullable|numeric|max:10000',
            'SS1017'=>'sometimes|nullable|string|max:45',
            'SS1017_moisture'=>'sometimes|nullable|numeric|max:10000',
            'SS1017_sf'=>'sometimes|nullable|numeric|max:10000',
            'SS1018'=>'sometimes|nullable|numeric|max:10000',
            'SS1019'=>'sometimes|nullable|numeric|max:10000',
            'SS1020'=>'sometimes|nullable|numeric|max:10000',
            'SS1021'=>'sometimes|nullable|numeric|max:10000',


        ];
    
    }



}
