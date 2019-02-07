<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SugarServiceInterface;
use App\Core\BaseClasses\BaseService;


class SugarServiceService extends BaseService{


    protected $ss_repo;



    public function __construct(SugarServiceInterface $ss_repo){

        $this->ss_repo = $ss_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sugar_services = $this->ss_repo->fetch($request);

        $request->flash();
        return view('dashboard.sugar_service.index')->with('sugar_services', $sugar_services);

    }






    public function store($request){

        $sugar_service = $this->ss_repo->store($request);

        $this->event->fire('sugar_service.store');
        return redirect()->back();

    }






    public function edit($slug){

        $sugar_service = $this->ss_repo->findbySlug($slug);
        return view('dashboard.sugar_service.edit')->with('sugar_service', $sugar_service);

    }






    public function update($request, $slug){

        $sugar_service = $this->ss_repo->update($request, $slug);

        $this->event->fire('sugar_service.update', $sugar_service);
        return redirect()->route('dashboard.sugar_service.index');

    }






    public function destroy($slug){

        $sugar_service = $this->ss_repo->destroy($slug);

        $this->event->fire('sugar_service.destroy', $sugar_service);
        return redirect()->back();

    }






}