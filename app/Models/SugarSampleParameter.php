<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class SugarSampleParameter extends Model{


    protected $table = 'sgrlab_sugar_sample_parameters';
    
	public $timestamps = false;
    	


    protected $attributes = [

        'sugar_sample_id' => '',
        'sugar_service_id' => '',
        'name' => '',
        'price' => null,
        'standard_str' => '',

    ];



	/** RELATIONSHIPS **/
    public function sugarSample() {
      return $this->belongsTo('App\Models\SugarSample','sugar_sample_id','sugar_sample_id');
    }




}
