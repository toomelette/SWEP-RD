<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\CaneJuiceAnalysisInterface;
use App\Core\Interfaces\SugarAnalysisInterface;

use App\Models\CaneJuiceAnalysis;


class CaneJuiceAnalysisRepository extends BaseRepository implements CaneJuiceAnalysisInterface {
	


    protected $cane_juice_analysis;
    protected $sugar_analysis_repo;



	public function __construct(CaneJuiceAnalysis $cane_juice_analysis, SugarAnalysisInterface $sugar_analysis_repo){

        $this->cane_juice_analysis = $cane_juice_analysis;
        $this->sugar_analysis_repo = $sugar_analysis_repo;
        parent::__construct();

    }





    public function store($request, $slug){

        $sugar_analysis = $this->sugar_analysis_repo->findBySlug($slug);
        $cja_analysis = new CaneJuiceAnalysis;
        $cja_analysis->slug = $this->str->random(32);
        $cja_analysis->sample_no = $sugar_analysis->sample_no;
        $cja_analysis->entry_no = $request->entry_no;
        $cja_analysis->date_sampled = $this->__dataType->date_parse($request->date_sampled);
        $cja_analysis->date_analyzed = $this->__dataType->date_parse($request->date_analyzed);
        $cja_analysis->variety = $request->variety;
        $cja_analysis->hacienda = $request->hacienda;
        $cja_analysis->corrected_brix = $request->corrected_brix;
        $cja_analysis->polarization = $request->polarization;
        $cja_analysis->purity = $request->purity;
        $cja_analysis->remarks = $request->remarks;
        $cja_analysis->save();

        return [$sugar_analysis, $cja_analysis];
        
    }






    public function update($request, $slug, $cja_slug){

        dd('test');
        
    }






    public function destroy($cja_slug){

        dd('test');
        
    }






    public function getBySlug($slug){

        $sa = $this->cache->remember('sugar_analysis:cane_juice_analysis:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->cane_juice_analysis->where('slug', $slug)
                                             ->get();
        }); 
        
        if(empty($sa)){
            abort(404);
        }

        return $sa;

    }





}