<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MillInterface;

use App\Models\Mill;


class MillRepository extends BaseRepository implements MillInterface {
	


    protected $mill;



	public function __construct(Mill $mill){

        $this->mill = $mill;
        parent::__construct();

    }




    public function getAll(){

        $mills = $this->cache->remember('mills:getAll', 240, function(){
            return $this->mill->select('mill_id', 'name')->get();
        });
        
        return $mills;

    }






}