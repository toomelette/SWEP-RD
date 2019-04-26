<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaneJuiceAnalysis\CaneJuiceAnalysisFormRequest;
use App\Http\Requests\CaneJuiceAnalysis\CaneJuiceAnalysisFilterRequest;

class CaneJuiceAnalysisController extends Controller{






	public function index(CaneJuiceAnalysisFilterRequest $request){
        
        return dd('Index');

    }


    

    public function create(){
        
        return view('dashboard.cane_juice_analysis.create');
    }


   

    public function store(CaneJuiceAnalysisFormRequest $request){
        
        return dd('Store');

    }
 



    public function edit($slug){
        
        return dd('Edit');

    }




    public function update(CaneJuiceAnalysisFormRequest $request, $slug){
        
        return dd('Update');

    }

    


    public function destroy($slug){
        
       return dd('Destroy');

    }



    
}
