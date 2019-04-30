<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class CaneJuiceAnalysis extends Model{


	use Sortable;

    protected $table = 'sgrlab_cane_juice_analysis';

    protected $dates = ['date_sampled', 'date_analyzed'];
    
	public $timestamps = false;



    protected $attributes = [

        'slug' => '',
        'sample_no' => '',
        'entry_no' => '',
        'date_sampled' => null,
        'date_analyzed' => null,
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



    
}
