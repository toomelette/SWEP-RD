<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarSampleParameter extends Model{
    

	use Sortable;

    protected $table = 'sgrlab_sugar_sample_parameters';
    
	public $timestamps = false;





	/** RELATIONSHIPS **/
    public function sugarSample() {
      return $this->belongsTo('App\Models\SugarSample','sugar_sample_id','sugar_sample_id');
    }




}
