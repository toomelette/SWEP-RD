<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SugarOrderOfPaymentInterface;
use App\Core\BaseClasses\BaseService;



class SugarOrderOfPaymentService extends BaseService{



    protected $sugar_oop_repo;



    public function __construct(SugarOrderOfPaymentInterface $sugar_oop_repo){

        $this->sugar_oop_repo = $sugar_oop_repo;
        parent::__construct();

    }





    public function store($request){

        $sugar_oop = $this->sugar_oop_repo->store($request);

        $this->event->fire('sugar_oop.store', $sugar_oop);
        return redirect()->back();

    }








}