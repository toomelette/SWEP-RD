<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class CaneJuiceAnalysisParameter extends Model{


	use Sortable;

    protected $table = 'sgrlab_cane_juice_analysis_parameters';

    protected $dates = ['date_sampled', 'date_analyzed'];
    
	public $timestamps = false;



    protected $attributes = [

        'slug' => '',
        'cane_juice_analysis_id' => '',
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

    public function caneJuiceAnalysis() {
      return $this->belongsTo('App\Models\CaneJuiceAnalysis','cane_juice_analysis_id','cane_juice_analysis_id');
    }



    
}
