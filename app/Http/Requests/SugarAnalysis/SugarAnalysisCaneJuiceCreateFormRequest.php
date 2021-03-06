<?php

namespace App\Http\Requests\SugarAnalysis;

use Illuminate\Foundation\Http\FormRequest;

class SugarAnalysisCaneJuiceCreateFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
        	'entry_no'=>'required|string|max:45',
            'date_submitted'=>'required|date_format:"m/d/Y"',
        	'date_sampled'=>'required|date_format:"m/d/Y"',
        	'date_analyzed'=>'required|string|max:255',
            'variety'=>'nullable|string|max:90',
            'hacienda'=>'nullable|string|max:255',
            'corrected_brix'=>'nullable|string|max:45',
            'polarization'=>'nullable|string|max:45',
            'purity'=>'nullable|string|max:45',
            'remarks'=>'nullable|string|max:255',

        ];
    
    }



}
