<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SugarAnalysisParameterMethod extends Model{


	protected $table = 'sgrlab_sugar_analysis_parameter_methods';
    
	public $timestamps = false;



    protected $attributes = [

        'sugar_analysis_parameter_id' => '',
        'name' => '',
    
    ];




    /** RELATIONSHIPS **/
    public function sugarAnalysisParameter() {
      return $this->belongsTo('App\Models\SugarAnalysisParameter','sugar_analysis_parameter_id','sugar_analysis_parameter_id');
    }

    
}
