<?php 

namespace App\Core\BaseClasses;

use App;
use Session;
use App\Core\Helpers\__cache;
use App\Core\Helpers\__dataType;


class BaseSubscriber{


    protected $session;
    protected $cacheHelper;
    protected $__dataType;



    public function __construct(){

        $this->session = session();
        $this->__cache = App::make(__cache::class);
        $this->__dataType = App::make(__dataType::class);
        
    }





}