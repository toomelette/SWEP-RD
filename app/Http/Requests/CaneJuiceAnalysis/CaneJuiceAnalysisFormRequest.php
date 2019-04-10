<?php

namespace App\Http\Requests\CaneJuiceAnalysis;

use Illuminate\Foundation\Http\FormRequest;

class CaneJuiceAnalysisFormRequest extends FormRequest{



    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
        ];
    
    }




}
