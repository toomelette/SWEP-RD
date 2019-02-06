<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\SugarAnalysisInterface;
use App\Core\BaseClasses\BaseService;



class SugarAnalysisService extends BaseService{



    protected $sa_repo;



    public function __construct(SugarAnalysisInterface $sa_repo){

        $this->sa_repo = $sa_repo;
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






    public function update($request, $slug){

        $sa = $this->sa_repo->updateResult($request, $slug);

        $this->event->fire('sugar_analysis.update', $sa);
        return redirect()->route('dashboard.sugar_analysis.index');

    }







}