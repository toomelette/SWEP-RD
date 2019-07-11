<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SugarMethod extends Model{
    	

	protected $table = 'sgrlab_sugar_methods';
    
	public $timestamps = false;



    protected $attributes = [

        'sugar_service_id' => '',
        'name' => '',
    
    ];




    /** RELATIONSHIPS **/
    public function sugarService() {
      return $this->belongsTo('App\Models\SugarService','sugar_service_id','sugar_service_id');
    }
    


}
