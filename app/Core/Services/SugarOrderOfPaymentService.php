<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SugarOrderOfPaymentInterface;
use App\Core\Interfaces\SugarServiceInterface;
use App\Core\Interfaces\SugarAnalysisParameterInterface;
use App\Core\BaseClasses\BaseService;



class SugarOrderOfPaymentService extends BaseService{



    protected $sugar_oop_repo;
    protected $sugar_service_repo;
    protected $sa_parameter_repo;



    public function __construct(SugarOrderOfPaymentInterface $sugar_oop_repo, SugarServiceInterface $sugar_service_repo, SugarAnalysisParameterInterface $sa_parameter_repo){

        $this->sugar_oop_repo = $sugar_oop_repo;
        $this->sugar_service_repo = $sugar_service_repo;
        $this->sa_parameter_repo = $sa_parameter_repo;
        parent::__construct();

    }





    public function store($request){

        $total_price = $this->getTotalPrice($request);
        $sugar_oop = $this->sugar_oop_repo->store($request, $total_price);    

        $this->storeSugarAnalysisParameter($request);

        $this->event->fire('sugar_oop.store', $sugar_oop);
        return redirect()->back();

    }




    // UTILS
    private function getTotalPrice($request){

        $services = $request->sugar_service_id;
        $total_price = 0.00;

        if(!empty($services)){
            foreach ($services as $data) {
                $ss_obj = $this->sugar_service_repo->findBySugarServiceId($data);
                $total_price += $ss_obj->price;
            }  
        }
            
        return $total_price;

    }





    private function storeSugarAnalysisParameter($request){

        $services = $request->sugar_service_id;

        if(!empty($services)){
            foreach ($services as $data) {
                $ss_obj = $this->sugar_service_repo->findBySugarServiceId($data);
                $this->sa_parameter_repo->store($request->sample_no, $ss_obj);
            }  
        }

        return null;

    }






}