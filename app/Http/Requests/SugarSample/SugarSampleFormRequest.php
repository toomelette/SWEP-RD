<?php

namespace App\Http\Requests\SugarSample;

use Illuminate\Foundation\Http\FormRequest;

class SugarSampleFormRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    


    public function rules(){

        $sugar_sample = $this->request->get('sugar_service_id');

        $rules = [
            
            'name'=>'required|string|max:250',

        ];
        
	    if(!empty($sugar_sample)){
	        foreach($sugar_sample as $key => $value){
	            $rules['sugar_service_id.'.$key] = 'required|string|max:11';
	        } 
	    }

        return $rules;

    }
    



}
