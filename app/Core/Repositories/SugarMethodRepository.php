<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarMethodInterface;

use App\Models\SugarMethod;


class SugarMethodRepository extends BaseRepository implements SugarMethodInterface {
	


    protected $sugar_method;



	public function __construct(SugarMethod $sugar_method){

        $this->sugar_method = $sugar_method;
        parent::__construct();

    }




    public function store($sugar_service_id, $name){

        $sugar_method = new SugarMethod;
        $sugar_method->sugar_service_id = $sugar_service_id;
        $sugar_method->name = $name;
        $sugar_method->save();

        return $sugar_method;
        
    }





}