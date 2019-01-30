<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class OrderOfPayment extends Model{



	use Sortable;

    protected $table = 'sgrlab_order_of_payment';

    protected $dates = ['date', 'created_at', 'updated_at'];
    
	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'sample_no' => '',
        'kind_of_sample' => '',
        'date' => null,
        'address' => '',
        'received_from' => '',
        'received_by' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    
}
