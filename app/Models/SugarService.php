<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SugarService extends Model{


	use Sortable;

    protected $table = 'sgrlab_sugar_services';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    
    public $sortable = ['name', 'standard', 'price'];




    protected $attributes = [

        'slug' => '',
        'sugar_service_id' => '',
        'name' => '',
        'price' => 0.00,
        'standard_str' => '',
        'standard_dec_max' => 0.000,
        'standard_dec_min' => 0.000,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];   




    /** RELATIONSHIPS **/ 
    public function sugarMethod() {
        return $this->hasMany('App\Models\SugarMethod','sugar_service_id','sugar_service_id');
    }
    


    
}
