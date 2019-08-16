<?php

namespace App\Http\Requests\SugarAnalysis;

use Illuminate\Foundation\Http\FormRequest;

class SugarAnalysisFilterRequest extends FormRequest{



    
    public function authorize(){
        
        return true;
    
    }



    public function rules(){

        return [
            
        	'q'=>'nullable|string|max:90',
            'ss' => 'nullable|max:20|string',
            'we' => 'nullable|date_format:"m/d/Y"',
            
        ];

    }




}
