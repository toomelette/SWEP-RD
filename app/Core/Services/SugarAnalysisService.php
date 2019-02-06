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

        return dd('List');

    }






    public function edit($slug){

        return dd('Edit');

    }






    public function update($request, $slug){

        return dd('Update');

    }







}