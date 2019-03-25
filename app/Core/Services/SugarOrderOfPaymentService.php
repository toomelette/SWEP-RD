<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SugarOrderOfPaymentInterface;
use App\Core\Interfaces\SugarServiceInterface;
use App\Core\Interfaces\SugarAnalysisParameterInterface;
use App\Core\Interfaces\SugarAnalysisInterface;
use App\Core\Interfaces\SugarSampleInterface;
use App\Core\BaseClasses\BaseService;



class SugarOrderOfPaymentService extends BaseService{



    protected $sugar_oop_repo;
    protected $sugar_service_repo;
    protected $sa_parameter_repo;
    protected $sa_repo;
    protected $ss_repo;



    public function __construct(SugarOrderOfPaymentInterface $sugar_oop_repo, SugarServiceInterface $sugar_service_repo, SugarAnalysisParameterInterface $sa_parameter_repo, SugarAnalysisInterface $sa_repo, SugarSampleInterface $ss_repo){

        $this->sugar_oop_repo = $sugar_oop_repo;
        $this->sugar_service_repo = $sugar_service_repo;
        $this->sa_parameter_repo = $sa_parameter_repo;
        $this->sa_repo = $sa_repo;
        $this->ss_repo = $ss_repo;
        parent::__construct();

    }






    public function fetch($request){

        $sugar_oops = $this->sugar_oop_repo->fetch($request);

        $request->flash();
        
        return view('dashboard.sugar_order_of_payment.index')->with('sugar_oops', $sugar_oops);

    }






    public function store($request){

        $total_price = $this->getTotalPrice($request);

        // Sugar OOP
        $sugar_oop = $this->sugar_oop_repo->store($request, $total_price);    

        // Sugar Analysis
        $this->sa_repo->store($request, $total_price);

        // Sugar Analysis Parameter
        $this->storeSugarAnalysisParameter($request);

        $this->event->fire('sugar_oop.store', $sugar_oop);
        return redirect()->back();

    }






    public function update($request, $slug){

        $total_price = $this->getTotalPrice($request);
        
        $sugar_oop = $this->sugar_oop_repo->findBySlug($slug);  

        // Sugar Analysis
        $this->sa_repo->updateOrderOfPayment($request, $sugar_oop->sugarAnalysis->slug, $total_price);

        // Sugar OOP
        $this->sugar_oop_repo->update($request, $sugar_oop, $total_price);

        // Sugar Analysis Parameters
        $this->storeSugarAnalysisParameter($request);

        $this->event->fire('sugar_oop.update', $sugar_oop);
        return redirect()->back();

    }






    public function edit($slug){
        
        $sugar_oop = $this->sugar_oop_repo->findBySlug($slug);  
        return view('dashboard.sugar_order_of_payment.edit')->with('sugar_oop', $sugar_oop);

    }






    public function show($slug){
        
        $sugar_oop = $this->sugar_oop_repo->findBySlug($slug);  
        return view('dashboard.sugar_order_of_payment.show')->with('sugar_oop', $sugar_oop);

    }






    public function delete($slug){

        $sugar_oop = $this->sugar_oop_repo->destroy($slug);

        $this->event->fire('sugar_oop.destroy', $sugar_oop);
        return redirect()->back();

    }






    public function print($slug){
        
        $sugar_oop = $this->sugar_oop_repo->findBySlug($slug);  
        return view('printables.sugar_order_of_payment.receipt')->with('sugar_oop', $sugar_oop);

    }





    // UTILS
    private function getTotalPrice($request){

        $total_price = 0.00;

        $services = $request->sugar_service_id;

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