<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\SugarSampleInterface;
use App\Core\Interfaces\SugarSampleParameterInterface;
use App\Core\Interfaces\SugarServiceInterface;
use App\Core\BaseClasses\BaseService;



class SugarSampleService extends BaseService{



    protected $sugar_sample_repo;
    protected $sugar_sample_parameter_repo;
    protected $sugar_service_repo;



    public function __construct(SugarSampleInterface $sugar_sample_repo, SugarSampleParameterInterface $sugar_sample_parameter_repo, SugarServiceInterface $sugar_service_repo){

        $this->sugar_sample_repo = $sugar_sample_repo;
        $this->sugar_sample_parameter_repo = $sugar_sample_parameter_repo;
        $this->sugar_service_repo = $sugar_service_repo;
        parent::__construct();

    }






    public function fetch($request){

        $sugar_samples = $this->sugar_sample_repo->fetch($request);
        $request->flash();
        
        return view('dashboard.sugar_sample.index')->with('sugar_samples', $sugar_samples);

    }






    public function store($request){

        $sugar_sample = $this->sugar_sample_repo->store($request);

        $this->storeSugarSampleParameter($sugar_sample->sugar_sample_id, $request);

        $this->event->fire('sugar_sample.store');
        return redirect()->back();

    }






    public function edit($slug){

        $sugar_sample = $this->sugar_sample_repo->findBySlug($slug);  
        return view('dashboard.sugar_sample.edit')->with('sugar_sample', $sugar_sample);

    }






    public function update($request, $slug){

        $sugar_sample = $this->sugar_sample_repo->update($request, $slug);
        
        $this->storeSugarSampleParameter($sugar_sample->sugar_sample_id, $request);

        $this->event->fire('sugar_sample.update', $sugar_sample);
        return redirect()->route('dashboard.sugar_sample.index');

    }






    public function show($slug){

        $sugar_sample = $this->sugar_sample_repo->findBySlug($slug);  
        return view('dashboard.sugar_sample.show')->with('sugar_sample', $sugar_sample);

    }






    public function destroy($slug){

        $sugar_sample = $this->sugar_sample_repo->destroy($slug);

        $this->event->fire('sugar_sample.destroy', $sugar_sample);
        return redirect()->back();

    }




    // Utils
    private function storeSugarSampleParameter($sugar_sample_id, $request){

        $services = $request->sugar_service_id;

        if(!empty($services)){
            foreach ($services as $data) {
                $sugar_service_instance = $this->sugar_service_repo->findBySugarServiceId($data);
                $this->sugar_sample_parameter_repo->store($sugar_sample_id, $sugar_service_instance);
            }  
        }

        return null;

    }







}