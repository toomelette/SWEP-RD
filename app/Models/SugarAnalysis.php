<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarAnalysis extends Model{



	use Sortable;

    protected $table = 'sgrlab_sugar_analysis';

    protected $dates = ['date', 'week_ending', 'date_sampled', 'date_submitted', 'date_analyzed', 'created_at', 'updated_at'];
    
	public $timestamps = false;



    protected $attributes = [

       	'slug' => '',
        'sample_no' => '',
        'mill_id' => '',
        'sugar_sample_id' => '',
        'customer_type' => '',
        'date' => null,
        'origin' => '',
        'address' => '',
        'quantity' => '',
        'week_ending' => null,
        'date_sampled' => null,
        'date_submitted' => null,
        'date_analyzed' => null,
        'description' => '',
        'total_price' => 0.00,
        'code' => '',
        'source' => '',
        'report_no' => '',
        'status' => 'PENDING',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];





    /** RELATIONSHIPS **/ 
    public function sugarAnalysisParameter() {
        return $this->hasMany('App\Models\SugarAnalysisParameter','sample_no','sample_no');
    }


    public function sugarSample() {
        return $this->belongsTo('App\Models\SugarSample','sugar_sample_id','sugar_sample_id');
    }


    public function sugarOrderOfPayment() {
        return $this->belongsTo('App\Models\SugarOrderOfPayment','sample_no','sample_no');
    }

    

}
