<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\SugarAnalysisInterface;
use App\Core\Interfaces\SugarAnalysisParameterInterface;
use App\Core\BaseClasses\BaseService;



class SugarAnalysisService extends BaseService{



    protected $sa_repo;
    protected $sa_parameter_repo;



    public function __construct(SugarAnalysisInterface $sa_repo, SugarAnalysisParameterInterface $sa_parameter_repo){

        $this->sa_repo = $sa_repo;
        $this->sa_parameter_repo = $sa_parameter_repo;
        parent::__construct();

    }






    public function fetch($request){

        $sugar_analysis = $this->sa_repo->fetch($request);

        $request->flash();
        
        return view('dashboard.sugar_analysis.index')->with('sugar_analysis', $sugar_analysis);

    }






    public function edit($slug){

        $sa = $this->sa_repo->findBySlug($slug);  
        return view('dashboard.sugar_analysis.edit')->with('sa', $sa);

    }






    public function show($slug){

        $sa = $this->sa_repo->findBySlug($slug);  
        return view('dashboard.sugar_analysis.show')->with('sa', $sa);

    }






    public function update($request, $slug){

        $sa = $this->sa_repo->updateResult($request, $slug);

        foreach ($sa->sugarAnalysisParameter as $data) {
            
            $id = $data->sugar_service_id;
            $assessment = $data->sugar_service_id.'_assessment';

            if (isset($request->$id) || $request->$id == ""){
                $this->sa_parameter_repo->update($sa->sample_no, $data->sugar_service_id, $request->$id, $request->$assessment);
            }

        }

        $this->event->fire('sugar_analysis.update', $sa);
        return redirect()->back();

    }






    public function print($slug){

        $sa = $this->sa_repo->findBySlug($slug);  
        return view('printables.sugar_analysis.result')->with('sa', $sa);

    }







}