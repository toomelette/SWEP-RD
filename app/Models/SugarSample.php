<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarSample extends Model{

	use Sortable;

    protected $table = 'sgrlab_sugar_samples';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    
    public $sortable = ['name'];

    	


    protected $attributes = [

        'slug' => '',
        'sugar_sample_id' => '',
        'name' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    /** RELATIONSHIPS **/
    public function sugarSampleParameter() {
      return $this->hasMany('App\Models\SugarSampleParameter','sugar_sample_id','sugar_sample_id');
    }



    public function sugarOrderOfPayment() {
      return $this->hasMany('App\Models\SugarOrderOfPayment','sugar_sample_id','sugar_sample_id');
    }



    public function sugarAnalysis() {
      return $this->hasMany('App\Models\SugarAnalysis','sugar_sample_id','sugar_sample_id');
    }




}
