<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Mill extends Model{



	use Sortable;

    protected $table = 'lmd_mills';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    
    public $sortable = ['mill_id', 'name', 'address'];




    protected $attributes = [

        'slug' => '',
        'mill_id' => '',
        'name' => '',
        'short_name' => '',
        'address' => '',
        'district' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    /** RELATIONSHIPS **/ 
    public function sugarAnalysis() {
        return $this->hasMany('App\Models\SugarAnalysis','mill_id','mill_id');
    }



    
}
