<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarAnalysisParameterMethodInterface;

use App\Models\SugarAnalysisParameterMethod;


class SugarAnalysisParameterMethodRepository extends BaseRepository implements SugarAnalysisParameterMethodInterface {
	


    protected $sugar_apm;



	public function __construct(SugarAnalysisParameterMethod $sugar_apm){

        $this->sugar_apm = $sugar_apm;
        parent::__construct();

    }




    public function store($sugar_analysis_parameter_id, $name){

        $sugar_apm = new SugarAnalysisParameterMethod;
        $sugar_apm->sugar_analysis_parameter_id = $sugar_analysis_parameter_id;
        $sugar_apm->name = $name;
        $sugar_apm->save();

        return $sugar_apm;
        
    }





}