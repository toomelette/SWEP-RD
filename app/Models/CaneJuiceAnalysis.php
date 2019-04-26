<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class CaneJuiceAnalysis extends Model{


	use Sortable;

    protected $table = 'sgrlab_cane_juice_analysis';

    protected $dates = ['date', 'created_at', 'updated_at'];
    
	public $timestamps = false;



    protected $attributes = [

       	'slug' => '',
       	'cane_juice_analysis_id' => '',
       	'origin' => '',
       	'date' => null,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    /** RELATIONSHIPS **/ 
    public function caneJuiceAnalysisParameter() {
        return $this->hasMany('App\Models\CaneJuiceAnalysisParameter','cane_juice_analysis_id','cane_juice_analysis_id');
    }




    
}
