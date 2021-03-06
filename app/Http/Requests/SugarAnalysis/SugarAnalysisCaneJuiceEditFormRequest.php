<?php

namespace App\Http\Requests\SugarAnalysis;

use Illuminate\Foundation\Http\FormRequest;

class SugarAnalysisCaneJuiceEditFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
        	'e_entry_no'=>'required|string|max:45',
            'e_date_submitted'=>'required|date_format:"m/d/Y"',
        	'e_date_sampled'=>'required|date_format:"m/d/Y"',
            'e_date_analyzed'=>'required|string|max:255',
            'e_variety'=>'nullable|string|max:90',
            'e_hacienda'=>'nullable|string|max:255',
            'e_corrected_brix'=>'nullable|string|max:45',
            'e_polarization'=>'nullable|string|max:45',
            'e_purity'=>'nullable|string|max:45',
            'e_remarks'=>'nullable|string|max:255',

        ];
    
    }



}
