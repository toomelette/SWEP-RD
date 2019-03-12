<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarSample extends Model{

	use Sortable;

    protected $table = 'sgrlab_sugar_samples';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    	



    /** RELATIONSHIPS **/
    public function sugarSampleParameter() {
      return $this->hasMany('App\Models\SugarSampleParameter','sugar_sample_id','sugar_sample_id');
    }




}
