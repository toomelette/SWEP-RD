<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SugarClients extends Model{


	use Sortable;

    protected $table = 'sgrlab_sugar_clients';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    
    public $sortable = ['name', 'address'];




    protected $attributes = [

        'slug' => '',
        'client_id' => '',
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
