<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SugarOrderOfPaymentInterface;
use App\Core\Interfaces\SugarServiceInterface;
use App\Core\Interfaces\SugarAnalysisParameterInterface;
use App\Core\Interfaces\SugarAnalysisInterface;
use App\Core\Interfaces\SugarAnalysisParameterMethodInterface;
use App\Core\BaseClasses\BaseService;



class SugarOrderOfPaymentService extends BaseService{



    protected $sugar_oop_repo;
    protected $sugar_service_repo;
    protected $sugar_analysis_parameter_repo;
    protected $sugar_analysis_repo;
    protected $sugar_apm_repo;



    public function __construct(SugarOrderOfPaymentInterface $sugar_oop_repo, SugarServiceInterface $sugar_service_repo, SugarAnalysisParameterInterface $sugar_analysis_parameter_repo, SugarAnalysisInterface $sugar_analysis_repo, SugarAnalysisParameterMethodInterface $sugar_apm_repo){

        $this->sugar_oop_repo = $sugar_oop_repo;
        $this->sugar_service_repo = $sugar_service_repo;
        $this->sugar_analysis_parameter_repo = $sugar_analysis_parameter_repo;
        $this->sugar_analysis_repo = $sugar_analysis_repo;
        $this->sugar_apm_repo = $sugar_apm_repo;
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
        $this->sugar_analysis_repo->storeOrderOfPayment($request, $total_price, $sugar_oop->sample_no);

        // Sugar Analysis Parameter
        $this->storeSugarAnalysisParameter($sugar_oop->sample_no, $request);

        $this->event->fire('sugar_oop.store', $sugar_oop);
        return redirect()->back();

    }






    public function update($request, $slug){

        $total_price = $this->getTotalPrice($request);
        
        $sugar_oop = $this->sugar_oop_repo->findBySlug($slug);  

        // Cane Juice Analysis
        if($sugar_oop->sugar_sample_id == "SS1006"){
            if ($request->sugar_sample_id != "SS1006") {
                $sugar_oop->caneJuiceAnalysis()->delete();
            }
        }

        // Sugar Analysis
        $this->sugar_analysis_repo->updateOrderOfPayment($request, $sugar_oop->sugarAnalysis->slug, $total_price);

        // Sugar OOP
        $this->sugar_oop_repo->update($request, $sugar_oop, $total_price);

        // Sugar Analysis Parameters
        $this->storeSugarAnalysisParameter($sugar_oop->sample_no, $request);

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

        if ($request->sugar_sample_id == "SS1006") {
            
            $total_price = $request->cja_num_of_samples * 100;

        }else{

            $services = $request->sugar_service_id;

            if(!empty($services)){
                foreach ($services as $data) {
                    $sugar_service_instance = $this->sugar_service_repo->findBySugarServiceId($data);
                    $total_price += $sugar_service_instance->price;
                }  
            }

                
        }

        return $total_price;

    }





    private function storeSugarAnalysisParameter($sample_no, $request){

        $services = $request->sugar_service_id;

        if(!empty($services)){

            foreach ($services as $data_sugar_service) {

                $sugar_service_instance = $this->sugar_service_repo->findBySugarServiceId($data_sugar_service);

                $sugar_analysis_parameter = $this->sugar_analysis_parameter_repo->store($sample_no, $sugar_service_instance);          

                foreach ($sugar_service_instance->sugarMethod as $data_sugar_method) { 
                    
                    $this->sugar_apm_repo->store($sugar_analysis_parameter->sugar_analysis_parameter_id, $data_sugar_method->name);

                }

            }  

        }

        return null;

    }






}