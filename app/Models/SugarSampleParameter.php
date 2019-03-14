<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarSampleParameter extends Model{
    

	use Sortable;

    protected $table = 'sgrlab_sugar_sample_parameters';
    
	public $timestamps = false;
    	


    protected $attributes = [

        'sugar_sample_id' => '',
        'sugar_service_id' => '',
        'name' => '',
        'price' => 0.00,
        'standard' => '',

    ];



	/** RELATIONSHIPS **/
    public function sugarSample() {
      return $this->belongsTo('App\Models\SugarSample','sugar_sample_id','sugar_sample_id');
    }




}
