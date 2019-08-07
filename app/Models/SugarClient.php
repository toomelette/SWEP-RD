<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SugarClient extends Model{


    protected $table = 'sgrlab_sugar_clients';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'sugar_client_id' => '',
        'name' => '',
        'address' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];

    
}
