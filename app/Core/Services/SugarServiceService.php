<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SugarServiceInterface;
use App\Core\Interfaces\SugarSampleParameterInterface;
use App\Core\Interfaces\SugarMethodInterface;
use App\Core\BaseClasses\BaseService;


class SugarServiceService extends BaseService{


    protected $sugar_service_repo;
    protected $sugar_sample_parameter;
    protected $sugar_method_repo;



    public function __construct(SugarServiceInterface $sugar_service_repo, SugarSampleParameterInterface $sugar_sample_parameter, SugarMethodInterface $sugar_method_repo){

        $this->sugar_service_repo = $sugar_service_repo;
        $this->sugar_sample_parameter = $sugar_sample_parameter;
        $this->sugar_method_repo = $sugar_method_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sugar_services = $this->sugar_service_repo->fetch($request);

        $request->flash();
        return view('dashboard.sugar_service.index')->with('sugar_services', $sugar_services);

    }






    public function store($request){

        $rows = $request->row;
        $sugar_service = $this->sugar_service_repo->store($request);

        if(!empty($rows)){
            foreach ($rows as $row) {
                $sugar_method = $this->sugar_method_repo->store($sugar_service->sugar_service_id, $row['name']);
            }
        }

        $this->event->fire('sugar_service.store');
        return redirect()->back();

    }






    public function edit($slug){

        $sugar_service = $this->sugar_service_repo->findbySlug($slug);

        return view('dashboard.sugar_service.edit')->with('sugar_service', $sugar_service);

    }






    public function update($request, $slug){

        $rows = $request->row;

        $sugar_service = $this->sugar_service_repo->update($request, $slug);
        $sugar_sample_parameter = $this->sugar_sample_parameter->updateSugarService($sugar_service);
        
        $sugar_service->sugarMethod()->delete();

        if(!empty($rows)){
            foreach ($rows as $row) {
                $sugar_method = $this->sugar_method_repo->store($sugar_service->sugar_service_id, $row['name']);
            }
        }

        $this->event->fire('sugar_service.update', $sugar_service);
        return redirect()->route('dashboard.sugar_service.index');

    }






    public function destroy($slug){

        $sugar_service = $this->sugar_service_repo->destroy($slug);
        
        $this->event->fire('sugar_service.destroy', $sugar_service);
        return redirect()->back();

    }






}