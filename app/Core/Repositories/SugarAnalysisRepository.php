<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarAnalysisInterface;

use App\Models\SugarAnalysis;


class SugarAnalysisRepository extends BaseRepository implements SugarAnalysisInterface {
	


    protected $sugar_analysis;



	public function __construct(SugarAnalysis $sugar_analysis){

        $this->sugar_analysis = $sugar_analysis;
        parent::__construct();

    }




    public function store($request, $total_price){

        $sugar_analysis = new SugarAnalysis;
        $sugar_analysis->slug = $this->str->random(16);
        $sugar_analysis->sample_no = $request->sample_no;
        $sugar_analysis->customer_type = $request->customer_type;
        $sugar_analysis->mill_id = $request->mill_id;
        $sugar_analysis->date = $this->__dataType->date_parse($request->date);
        $sugar_analysis->origin = $request->received_from;
        $sugar_analysis->address = $request->address;
        $sugar_analysis->quantity = 0.00;
        $sugar_analysis->week_ending = null;
        $sugar_analysis->date_sampled = null;
        $sugar_analysis->date_submitted = null;
        $sugar_analysis->date_analyzed = null;
        $sugar_analysis->description = '';
        $sugar_analysis->total_price = $total_price;
        $sugar_analysis->created_at = $this->carbon->now();
        $sugar_analysis->updated_at = $this->carbon->now();
        $sugar_analysis->ip_created = request()->ip();
        $sugar_analysis->ip_updated = request()->ip();
        $sugar_analysis->user_created = $this->auth->user()->user_id;
        $sugar_analysis->user_updated = $this->auth->user()->user_id;
        $sugar_analysis->save();

        return $sugar_analysis;
        
    }





}