<?php

namespace App\Http\Requests\SugarService;

use Illuminate\Foundation\Http\FormRequest;

class SugarServiceFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rules =  [
            'seq_no'=>'required|int|max:100',
            'name'=>'required|string|max:255',
            'price'=>'nullable|string|max:13',
            'standard_str'=>'nullable|string|max:90',
            'standard_dec_max'=>'nullable|numeric|max:100000000',
            'standard_dec_min'=>'nullable|numeric|max:100000000'
        ];

        if(!empty($this->request->get('row'))){
            foreach($this->request->get('row') as $key => $value){
                $rules['row.'.$key.'.name'] = 'required|string|max:255';
            } 
        }

        return $rules;
    
    }


    
}
