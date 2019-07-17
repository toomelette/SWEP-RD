<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CaneJuiceAnalysis extends Model{



    protected $table = 'sgrlab_cane_juice_analysis';

    protected $dates = ['date_submitted', 'date_sampled', 'date_analyzed_from', 'date_analyzed_to'];
    
	public $timestamps = false;



    protected $attributes = [

        'slug' => '',
        'sample_no' => '',
        'entry_no' => '',
        'date_submitted' => null,
        'date_sampled' => null,
        'date_analyzed_from' => null,
        'date_analyzed_to' => null,
        'variety' => '',
        'hacienda' => '',
        'corrected_brix' => '',
        'polarization' => '',
        'purity' => '',
        'remarks' => '',

    ];




    /** RELATIONSHIPS **/

    public function sugarAnalysis() {
      return $this->belongsTo('App\Models\SugarAnalysis','sample_no','sample_no');
    }

    public function sugarOrderOfPayment() {
      return $this->belongsTo('App\Models\SugarOrderOfPayment','sample_no','sample_no');
    }



    
}
