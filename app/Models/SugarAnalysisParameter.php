<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SugarAnalysisParameter extends Model{


	use Sortable;

    protected $table = 'sgrlab_sugar_analysis_parameters';
    
	public $timestamps = false;



    protected $attributes = [

        'sample_no' => '',
        'sugar_service_id' => '',
        'name' => '',
        'price' => 0.00,
        'result' => '',
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
    



}
