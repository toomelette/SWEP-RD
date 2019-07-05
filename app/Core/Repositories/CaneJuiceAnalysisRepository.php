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

        $cja = new CaneJuiceAnalysis;
        $cja->slug = $this->str->random(32);
        $cja->sample_no = $sample_no;
        $cja->entry_no = $request->entry_no;
        $cja->date_submitted = $this->__dataType->date_parse($request->date_submitted);
        $cja->date_sampled = $this->__dataType->date_parse($request->date_sampled);
        $cja->date_analyzed_from = $this->__dataType->date_parse($request->date_analyzed_from);
        $cja->date_analyzed_to = $this->__dataType->date_parse($request->date_analyzed_to);
        $cja->variety = $request->variety;
        $cja->hacienda = $request->hacienda;
        $cja->corrected_brix = $request->corrected_brix;
        $cja->polarization = $request->polarization;
        $cja->purity = $request->purity;
        $cja->remarks = $request->remarks;
        $cja->save();

        return $cja;
        
    }






    public function update($request, $cja_slug){

        $cja = $this->findBySlug($cja_slug);
        $cja->entry_no = $request->e_entry_no;
        $cja->date_submitted = $this->__dataType->date_parse($request->e_date_submitted);
        $cja->date_sampled = $this->__dataType->date_parse($request->e_date_sampled);
        $cja->date_analyzed_from = $this->__dataType->date_parse($request->e_date_analyzed_from);
        $cja->date_analyzed_to = $this->__dataType->date_parse($request->e_date_analyzed_to);
        $cja->variety = $request->e_variety;
        $cja->hacienda = $request->e_hacienda;
        $cja->corrected_brix = $request->e_corrected_brix;
        $cja->polarization = $request->e_polarization;
        $cja->purity = $request->e_purity;
        $cja->remarks = $request->e_remarks;
        $cja->save();

        return $cja;
        
    }






    public function destroy($cja_slug){

        $cja = $this->findBySlug($cja_slug);  
        $cja->delete();

        return $cja;
        
    }






    public function findBySlug($cja_slug){

        $cja = $this->cache->remember('sugar_analysis:cane_juice_analysis:findBySlug:' . $cja_slug, 240, function() use ($cja_slug){
            return $this->cane_juice_analysis->where('slug', $cja_slug)
                                             ->first();
        }); 
        
        if(empty($cja)){
            abort(404);
        }

        return $cja;

    }






    public function getBySlug($cja_slug){

        $cja = $this->cache->remember('sugar_analysis:cane_juice_analysis:getBySlug:' . $cja_slug, 240, function() use ($cja_slug){
            return $this->cane_juice_analysis->where('slug', $cja_slug)
                                             ->get();
        }); 
        
        if(empty($cja)){
            abort(404);
        }

        return $cja;

    }





}