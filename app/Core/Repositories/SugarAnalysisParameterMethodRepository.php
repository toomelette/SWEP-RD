<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarAnalysisParameterMethodInterface;

use App\Models\SugarAnalysisParameterMethod;


class SugarAnalysisParameterMethodRepository extends BaseRepository implements SugarAnalysisParameterMethodInterface {
	


    protected $sugar_analysis_pm;



	public function __construct(SugarAnalysisParameterMethod $sugar_analysis_pm){

        $this->sugar_analysis_pm = $sugar_analysis_pm;
        parent::__construct();

    }




    public function store($sugar_analysis_parameter_id, $name){

        $sugar_analysis_pm = new SugarAnalysisParameterMethod;
        $sugar_analysis_pm->sugar_analysis_parameter_id = $sugar_analysis_parameter_id;
        $sugar_analysis_pm->name = $name;
        $sugar_analysis_pm->save();

        return $sugar_analysis_pm;
        
    }





}