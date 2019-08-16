<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\CaneJuiceAnalysisInterface;

use App\Models\CaneJuiceAnalysis;


class CaneJuiceAnalysisRepository extends BaseRepository implements CaneJuiceAnalysisInterface {
	


    protected $cane_juice_analysis;



	public function __construct(CaneJuiceAnalysis $cane_juice_analysis){

        $this->cane_juice_analysis = $cane_juice_analysis;
        parent::__construct();

    }





    public function store($request, $sample_no){

        $cane_juice_analysis = new CaneJuiceAnalysis;
        $cane_juice_analysis->slug = $this->str->random(32);
        $cane_juice_analysis->sample_no = $sample_no;
        $cane_juice_analysis->entry_no = $request->entry_no;
        $cane_juice_analysis->date_submitted = $this->__dataType->date_parse($request->date_submitted);
        $cane_juice_analysis->date_sampled = $this->__dataType->date_parse($request->date_sampled);
        $cane_juice_analysis->date_analyzed = $request->date_analyzed;
        $cane_juice_analysis->variety = $request->variety;
        $cane_juice_analysis->hacienda = $request->hacienda;
        $cane_juice_analysis->corrected_brix = $request->corrected_brix;
        $cane_juice_analysis->polarization = $request->polarization;
        $cane_juice_analysis->purity = $request->purity;
        $cane_juice_analysis->remarks = $request->remarks;
        $cane_juice_analysis->save();

        return $cane_juice_analysis;
        
    }






    public function update($request, $cane_juice_analysis_slug){

        $cane_juice_analysis = $this->findBySlug($cane_juice_analysis_slug);
        $cane_juice_analysis->entry_no = $request->e_entry_no;
        $cane_juice_analysis->date_submitted = $this->__dataType->date_parse($request->e_date_submitted);
        $cane_juice_analysis->date_sampled = $this->__dataType->date_parse($request->e_date_sampled);
        $cane_juice_analysis->date_analyzed = $request->e_date_analyzed;
        $cane_juice_analysis->variety = $request->e_variety;
        $cane_juice_analysis->hacienda = $request->e_hacienda;
        $cane_juice_analysis->corrected_brix = $request->e_corrected_brix;
        $cane_juice_analysis->polarization = $request->e_polarization;
        $cane_juice_analysis->purity = $request->e_purity;
        $cane_juice_analysis->remarks = $request->e_remarks;
        $cane_juice_analysis->save();

        return $cja;
        
    }






    public function destroy($cane_juice_analysis_slug){

        $cane_juice_analysis = $this->findBySlug($cane_juice_analysis_slug);  
        $cane_juice_analysis->delete();

        return $cane_juice_analysis;
        
    }






    public function findBySlug($cane_juice_analysis_slug){

        $cane_juice_analysis = $this->cache->remember('sugar_analysis:cane_juice_analysis:findBySlug:' . $cane_juice_analysis_slug, 240, function() use ($cane_juice_analysis_slug){
            return $this->cane_juice_analysis->where('slug', $cane_juice_analysis_slug)->first();
        }); 
        
        if(empty($cane_juice_analysis)){ abort(404); }

        return $cane_juice_analysis;

    }






    public function getBySlug($cane_juice_analysis_slug){

        $cane_juice_analysis = $this->cache->remember('sugar_analysis:cane_juice_analysis:getBySlug:' . $cane_juice_analysis_slug, 240, function() use ($cane_juice_analysis_slug){
            return $this->cane_juice_analysis->where('slug', $cane_juice_analysis_slug)->get();
        }); 
        
        if(empty($cane_juice_analysis)){ abort(404); }

        return $cane_juice_analysis;

    }





}