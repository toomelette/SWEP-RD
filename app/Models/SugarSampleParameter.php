<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarSampleParameter extends Model{
    

	use Sortable;

    protected $table = 'sgrlab_sugar_sample_parameters';
    
	public $timestamps = false;


}
