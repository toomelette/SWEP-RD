<?php

namespace App\Http\Requests\SugarSample;

use Illuminate\Foundation\Http\FormRequest;

class SugarSampleFormRequest extends FormRequest{



    public function authorize(){

        return true;

    }

    


    public function rules(){

        $rules = ['name'=>'required|string|max:250',];
        
	    if(!empty($this->request->get('sugar_service_id'))){
	        foreach($this->request->get('sugar_service_id') as $key => $value){
	            $rules['sugar_service_id.'.$key] = 'required|string|max:11';
	        } 
	    }

        return $rules;

    }
    



}
