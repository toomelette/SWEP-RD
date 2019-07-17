<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarOrderOfPayment extends Model{



	use Sortable;

    protected $table = 'sgrlab_sugar_order_of_payment';

    protected $dates = ['date', 'created_at', 'updated_at'];
    
	public $timestamps = false;
    
    public $sortable = ['sample_no', 'sugar_sample_id', 'received_from', 'date', 'received_by'];





    protected $attributes = [

        'slug' => '',
        'sample_no' => '',
        'sugar_sample_id' => '',
        'date' => null,
        'address' => '',
        'received_from' => '',
        'received_by' => '',
        'total_price' => 0.00,
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



    public function sugarAnalysis() {
        return $this->hasOne('App\Models\SugarAnalysis','sample_no','sample_no');
    }


    public function caneJuiceAnalysis() {
        return $this->hasMany('App\Models\CaneJuiceAnalysis','sample_no','sample_no');
    }



    public function sugarSample() {
        return $this->belongsTo('App\Models\SugarSample','sugar_sample_id','sugar_sample_id');
    }

    

    
}
