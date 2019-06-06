<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\SugarAnalysisInterface;
use App\Core\Interfaces\SugarAnalysisParameterInterface;
use App\Core\Interfaces\CaneJuiceAnalysisInterface;
use App\Core\BaseClasses\BaseService;



class SugarAnalysisService extends BaseService{



    protected $sugar_analysis_repo;
    protected $sugar_analysis_parameter_repo;
    protected $cane_juice_analysis_repo;



    public function __construct(SugarAnalysisInterface $sugar_analysis_repo, SugarAnalysisParameterInterface $sugar_analysis_parameter_repo, CaneJuiceAnalysisInterface $cane_juice_analysis_repo){

        $this->sugar_analysis_repo = $sugar_analysis_repo;
        $this->sugar_analysis_parameter_repo = $sugar_analysis_parameter_repo;
        $this->cane_juice_analysis_repo = $cane_juice_analysis_repo;
        parent::__construct();

    }






    public function fetch($request){

        $sugar_analysis = $this->sugar_analysis_repo->fetch($request);

        $request->flash();
        
        return view('dashboard.sugar_analysis.index')->with('sugar_analysis', $sugar_analysis);

    }






    public function edit($slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);  

        if($sa->sugar_sample_id == "SS1006"){

            return view('dashboard.sugar_analysis.edit_cane_juice')->with('sa', $sa);

        }else{

            return view('dashboard.sugar_analysis.edit')->with('sa', $sa);
            
        }  

    }






    public function show($slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);

        if($sa->sugar_sample_id == "SS1006"){

            return view('dashboard.sugar_analysis.show_cane_juice')->with('sa', $sa);

        }else{

            return view('dashboard.sugar_analysis.show')->with('sa', $sa);
            
        } 

    }






    public function update($request, $slug){

        $sa = $this->sugar_analysis_repo->updateResult($request, $slug);

        foreach ($sa->sugarAnalysisParameter as $data) {
            
            $id = $data->sugar_service_id;
            $assessment = $data->sugar_service_id.'_assessment';

            if (isset($request->$id) || $request->$id == ""){
                $this->sugar_analysis_parameter_repo->update($sa->sample_no, $data->sugar_service_id, $request->$id, $request->$assessment);
            }

        }

        $this->event->fire('sugar_analysis.update', $sa);
        return redirect()->back();

    }






    public function print($slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);  
        return view('printables.sugar_analysis.result')->with('sa', $sa);

    }






    public function report_generate($request){

        $year = $request->year;

        // first quarter
        $first_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1002'], ['SS1001', 'SS1002', 'SS1005']);
        $first_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1002'], ['SS1004']);
        $first_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1002'], ['SS1003']);
        $first_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1002'], ['SS1006']);

        $first_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1001'], ['SS1001', 'SS1002', 'SS1005']);
        $first_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1001'], ['SS1004']);
        $first_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1001'], ['SS1003']);
        $first_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-01-01', $year .'-03-31', ['CT1001'], ['SS1006']);


        // second quarter
        $second_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1002'], ['SS1001', 'SS1002', 'SS1005']);
        $second_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1002'], ['SS1004']);
        $second_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1002'], ['SS1003']);
        $second_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1002'], ['SS1006']);

        $second_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1001'], ['SS1001', 'SS1002', 'SS1005']);
        $second_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1001'], ['SS1004']);
        $second_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1001'], ['SS1003']);
        $second_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-04-01', $year .'-06-30', ['CT1001'], ['SS1006']);

        // third quarter
        $third_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1002'], ['SS1001', 'SS1002', 'SS1005']);
        $third_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1002'], ['SS1004']);
        $third_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1002'], ['SS1003']);
        $third_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1002'], ['SS1006']);

        $third_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1001'], ['SS1001', 'SS1002', 'SS1005']);
        $third_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1001'], ['SS1004']);
        $third_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1001'], ['SS1003']);
        $third_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-07-01', $year .'-09-30', ['CT1001'], ['SS1006']);

        // fourth quarter
        $fourth_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1002'], ['SS1001', 'SS1002', 'SS1005']);
        $fourth_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1002'], ['SS1004']);
        $fourth_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1002'], ['SS1003']);
        $fourth_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1002'], ['SS1006']);

        $fourth_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1001'], ['SS1001', 'SS1002', 'SS1005']);
        $fourth_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1001'], ['SS1004']);
        $fourth_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1001'], ['SS1003']);
        $fourth_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SampleId($year .'-10-01', $year .'-12-31', ['CT1001'], ['SS1006']);

        return view('printables.sugar_analysis.annual_accomplishment_report')

               ->with([

                    'first_quarter_mill_rawSugar' => $first_quarter_mill_rawSugar,
                    'first_quarter_mill_molasses' => $first_quarter_mill_molasses,
                    'first_quarter_mill_muscovado' => $first_quarter_mill_muscovado,
                    'first_quarter_mill_caneJuice' => $first_quarter_mill_caneJuice,

                    'first_quarter_walkin_rawSugar' => $first_quarter_walkin_rawSugar,
                    'first_quarter_walkin_molasses' => $first_quarter_walkin_molasses,
                    'first_quarter_walkin_muscovado' => $first_quarter_walkin_muscovado,
                    'first_quarter_walkin_caneJuice' => $first_quarter_walkin_caneJuice,


                    'second_quarter_mill_rawSugar' => $second_quarter_mill_rawSugar,
                    'second_quarter_mill_molasses' => $second_quarter_mill_molasses,
                    'second_quarter_mill_muscovado' => $second_quarter_mill_muscovado,
                    'second_quarter_mill_caneJuice' => $second_quarter_mill_caneJuice,

                    'second_quarter_walkin_rawSugar' => $second_quarter_walkin_rawSugar,
                    'second_quarter_walkin_molasses' => $second_quarter_walkin_molasses,
                    'second_quarter_walkin_muscovado' => $second_quarter_walkin_muscovado,
                    'second_quarter_walkin_caneJuice' => $second_quarter_walkin_caneJuice,


                    'third_quarter_mill_rawSugar' => $third_quarter_mill_rawSugar,
                    'third_quarter_mill_molasses' => $third_quarter_mill_molasses,
                    'third_quarter_mill_muscovado' => $third_quarter_mill_caneJuice,
                    'third_quarter_mill_caneJuice' => $third_quarter_mill_caneJuice,

                    'third_quarter_walkin_rawSugar' => $third_quarter_walkin_rawSugar,
                    'third_quarter_walkin_molasses' => $third_quarter_walkin_molasses,
                    'third_quarter_walkin_muscovado' => $third_quarter_walkin_caneJuice,
                    'third_quarter_walkin_caneJuice' => $third_quarter_walkin_caneJuice,


                    'fourth_quarter_mill_rawSugar' => $fourth_quarter_mill_rawSugar,
                    'fourth_quarter_mill_molasses' => $fourth_quarter_mill_molasses,
                    'fourth_quarter_mill_muscovado' => $fourth_quarter_mill_muscovado,
                    'fourth_quarter_mill_caneJuice' => $fourth_quarter_mill_caneJuice,

                    'fourth_quarter_walkin_rawSugar' => $fourth_quarter_walkin_rawSugar,
                    'fourth_quarter_walkin_molasses' => $fourth_quarter_walkin_molasses,
                    'fourth_quarter_walkin_muscovado' => $fourth_quarter_walkin_muscovado,
                    'fourth_quarter_walkin_caneJuice' => $fourth_quarter_walkin_caneJuice,

                ]);

    }






    public function caneJuiceAnalysisSetOrNo($request, $slug){

        $sa = $this->sugar_analysis_repo->setOrNo($request, $slug);

        $this->event->fire('cane_juice_analysis.set_or_no', $sa);
        return redirect()->back();

    }






    public function caneJuiceAnalysisStore($request, $slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);

        $cja = $this->cane_juice_analysis_repo->store($request, $sa->sample_no);

        $this->event->fire('cane_juice_analysis.store', [$sa, $cja]);
        return redirect()->back();

    }






    public function caneJuiceAnalysisUpdate($request, $slug, $cja_slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);

        $cja = $this->cane_juice_analysis_repo->update($request, $cja_slug);

        $this->event->fire('cane_juice_analysis.update', [$sa, $cja]);
        return redirect()->back();

    }






    public function caneJuiceAnalysisDestroy($slug, $cja_slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);

        $cja = $this->cane_juice_analysis_repo->destroy($cja_slug);

        $this->event->fire('cane_juice_analysis.destroy', [$sa, $cja]);
        return redirect()->back();

    }






    public function caneJuiceAnalysisPrint($slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);  
        return view('printables.sugar_analysis.cane_juice_result')->with('sa', $sa);

    }







}