<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SugarAnalysisParameter extends Model{



    protected $table = 'sgrlab_sugar_analysis_parameters';
    
	public $timestamps = false;



    protected $attributes = [

        'sample_no' => '',
        'sugar_analysis_parameter_id' => '',
        'sugar_service_id' => '',
        'name' => '',
        'price' => 0.00,
        'result' => '',
        'result_dec' => 0.00,
        'standard' => '',
        'assessment' => '',

    ];




    /** RELATIONSHIPS **/
    public function sugarOrderOfPayment() {
      return $this->belongsTo('App\Models\SugarOrderOfPayment','sample_no','sample_no');
    }


    public function sugarAnalysis() {
      return $this->belongsTo('App\Models\SugarAnalysis','sample_no','sample_no');
    }


    public function sugarAnalysisParameterMethod() {
      return $this->hasMany('App\Models\SugarAnalysisParameterMethod','sugar_analysis_parameter_id','sugar_analysis_parameter_id');
    }
    



}
