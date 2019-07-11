<?php

namespace App\Http\Requests\SugarService;

use Illuminate\Foundation\Http\FormRequest;

class SugarServiceFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rows = $this->request->get('row');

        $rules =  [
            
            'name'=>'required|string|max:255',
            'price'=>'required|string|max:13',
            'standard'=>'required|string|max:90'

        ];


        if(!empty($rows)){

            foreach($rows as $key => $value){
                    
                $rules['row.'.$key.'.name'] = 'required|string|max:255';

            } 

        }

        return $rules;
    
    }


    
}
