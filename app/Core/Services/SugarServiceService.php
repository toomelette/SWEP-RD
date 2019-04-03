<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SugarServiceInterface;
use App\Core\Interfaces\SugarSampleparameterInterface;
use App\Core\BaseClasses\BaseService;


class SugarServiceService extends BaseService{


    protected $sugar_service_repo;
    protected $sugar_sample_parameter;



    public function __construct(SugarServiceInterface $sugar_service_repo, SugarSampleparameterInterface $sugar_sample_parameter){

        $this->sugar_service_repo = $sugar_service_repo;
        $this->sugar_sample_parameter = $sugar_sample_parameter;
        parent::__construct();

    }





    public function fetch($request){

        $sugar_services = $this->sugar_service_repo->fetch($request);

        $request->flash();
        return view('dashboard.sugar_service.index')->with('sugar_services', $sugar_services);

    }






    public function store($request){

        $sugar_service = $this->sugar_service_repo->store($request);

        $this->event->fire('sugar_service.store');
        return redirect()->back();

    }






    public function edit($slug){

        $sugar_service = $this->sugar_service_repo->findbySlug($slug);

        return view('dashboard.sugar_service.edit')->with('sugar_service', $sugar_service);

    }






    public function update($request, $slug){

        $sugar_service = $this->sugar_service_repo->update($request, $slug);

        $this->sugar_sample_parameter->update($sugar_service);

        $this->event->fire('sugar_service.update', $sugar_service);
        return redirect()->route('dashboard.sugar_service.index');

    }






    public function destroy($slug){

        $sugar_service = $this->sugar_service_repo->destroy($slug);

        $this->event->fire('sugar_service.destroy', $sugar_service);
        return redirect()->back();

    }






}