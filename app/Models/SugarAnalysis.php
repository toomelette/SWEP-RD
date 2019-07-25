<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarAnalysis extends Model{



	use Sortable;

    protected $table = 'sgrlab_sugar_analysis';

    protected $dates = ['date', 'week_ending', 'date_sampled', 'date_submitted', 'date_analyzed_from', 'date_analyzed_to', 'created_at', 'updated_at'];
    
	public $timestamps = false;
    
    public $sortable = ['sample_no', 'sugar_sample_id', 'origin', 'week_ending', 'status'];



    protected $attributes = [

       	'slug' => '',
        'sample_no' => '',
        'mill_id' => '',
        'sugar_client_id' => '',
        'sugar_sample_id' => '',
        'customer_type' => '',
        'date' => null,
        'or_no' => '',
        'origin' => '',
        'address' => '',
        'total_price' => 0.00,
        'quantity' => '',
        'week_ending' => null,
        'date_sampled' => null,
        'date_submitted' => null,
        'date_analyzed_from' => null,
        'date_analyzed_to' => null,
        'description' => '',
        'code' => '',
        'source' => '',
        'report_no' => '',
        'status' => 'PENDING',
        'cja_num_of_samples' => 0,
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

    public function caneJuiceAnalysis() {
        return $this->hasMany('App\Models\CaneJuiceAnalysis','sample_no','sample_no');
    }


    public function sugarSample() {
        return $this->belongsTo('App\Models\SugarSample','sugar_sample_id','sugar_sample_id');
    }


    public function sugarOrderOfPayment() {
        return $this->belongsTo('App\Models\SugarOrderOfPayment','sample_no','sample_no');
    }

    

}
