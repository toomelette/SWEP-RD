<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarOrderOfPaymentInterface;

use App\Models\SugarOrderOfPayment;


class SugarOrderOfPaymentRepository extends BaseRepository implements SugarOrderOfPaymentInterface {
	


    protected $sugar_oop;



	public function __construct(SugarOrderOfPayment $sugar_oop){

        $this->sugar_oop = $sugar_oop;
        parent::__construct();

    }




    public function store($request, $total_price){

        $sugar_oop = new SugarOrderOfPayment;
        $sugar_oop->slug = $this->str->random(16);
        $sugar_oop->sample_no = $request->sample_no;
        $sugar_oop->sugar_sample = $request->sugar_sample;
        $sugar_oop->date = $this->__dataType->date_parse($request->date);
        $sugar_oop->address = $request->address;
        $sugar_oop->received_from = $request->received_from;
        $sugar_oop->received_by = $request->received_by;
        $sugar_oop->total_price = $total_price;
        $sugar_oop->created_at = $this->carbon->now();
        $sugar_oop->updated_at = $this->carbon->now();
        $sugar_oop->ip_created = request()->ip();
        $sugar_oop->ip_updated = request()->ip();
        $sugar_oop->user_created = $this->auth->user()->user_id;
        $sugar_oop->user_updated = $this->auth->user()->user_id;
        $sugar_oop->save();

        return $sugar_oop;
        
    }






}