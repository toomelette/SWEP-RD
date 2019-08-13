<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\SugarAnalysisInterface;
use App\Core\Interfaces\SugarAnalysisParameterInterface;
use App\Core\Interfaces\CaneJuiceAnalysisInterface;
use App\Core\Interfaces\MillInterface;
use App\Core\BaseClasses\BaseService;



class SugarAnalysisService extends BaseService{



    protected $sugar_analysis_repo;
    protected $sugar_analysis_parameter_repo;
    protected $cane_juice_analysis_repo;
    protected $mill_repo;



    public function __construct(SugarAnalysisInterface $sugar_analysis_repo, SugarAnalysisParameterInterface $sugar_analysis_parameter_repo, CaneJuiceAnalysisInterface $cane_juice_analysis_repo, MillInterface $mill_repo){

        $this->sugar_analysis_repo = $sugar_analysis_repo;
        $this->sugar_analysis_parameter_repo = $sugar_analysis_parameter_repo;
        $this->cane_juice_analysis_repo = $cane_juice_analysis_repo;
        $this->mill_repo = $mill_repo;
        parent::__construct();

    }






    public function fetch($request){

        $sugar_analysis = $this->sugar_analysis_repo->fetch($request);

        $request->flash();
        
        return view('dashboard.sugar_analysis.index')->with('sugar_analysis', $sugar_analysis);

    }






    public function setOrNo($request, $slug){

        $sa = $this->sugar_analysis_repo->setOrNo($request, $slug);

        $this->event->fire('sugar_analysis.set_or_no', $sa);
        return redirect()->back();

    }






    public function edit($slug){

        $sugar_samples = $this->__static->sugar_samples();

        $sa = $this->sugar_analysis_repo->findBySlug($slug);  

        if($sa->sugar_sample_id == $sugar_samples['cja']){

            return view('dashboard.sugar_analysis.edit_cane_juice')->with('sa', $sa);

        }else{

            return view('dashboard.sugar_analysis.edit')->with('sa', $sa);
            
        }  

    }






    public function show($slug){

        $sugar_samples = $this->__static->sugar_samples();

        $sa = $this->sugar_analysis_repo->findBySlug($slug);

        if($sa->sugar_sample_id == $sugar_samples['cja']){

            return view('dashboard.sugar_analysis.show_cane_juice')->with('sa', $sa);

        }else{

            return view('dashboard.sugar_analysis.show')->with('sa', $sa);
            
        } 

    }






    public function update($request, $slug){

        $sa = $this->sugar_analysis_repo->updateResult($request, $slug);

        foreach ($sa->sugarAnalysisParameter as $data) {
            
            $sugar_services = $this->__static->sugar_services();

            $id = $data->sugar_service_id;
            $assessment = $data->sugar_service_id.'_assessment';

            $req_moisture = $sugar_services['mois'].'_moisture';
            $req_sf = $sugar_services['mois'].'_sf';

            if (isset($request->$id) || $request->$id == ""){

                if (isset($request->$req_moisture) && isset($request->$req_sf)) {
                    
                    $this->sugar_analysis_parameter_repo->update($sa->sample_no, $data->sugar_service_id, $request->$id, $request->$req_moisture, $request->$req_sf);

                }else{

                    $this->sugar_analysis_parameter_repo->update($sa->sample_no, $data->sugar_service_id, $request->$id);
                
                }
            
            }

        }

        $this->event->fire('sugar_analysis.update', $sa);
        return redirect()->back();

    }






    public function print($slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);  
        return view('printables.sugar_analysis.test_certificate')->with('sa', $sa);

    }






    public function caneJuiceAnalysisStore($request, $slug){

        $sa = $this->sugar_analysis_repo->findBySlug($slug);

        $cja_samples = $sa->caneJuiceAnalysis()->count() + 1;

        if ($sa->cja_num_of_samples < $cja_samples) {
            
            $this->session->flash('CJA_NUM_OF_SAMPLES_ERROR', 'You Encoded more than '. $sa->cja_num_of_samples .' samples. Please update Order of Payment Record.');
            return redirect()->back();

        }

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






    public function report_generate($request){

        if ($request->t == "ARAR") {

            return $this->annualRevenueAccomplishmentReport($request);

        }elseif ($request->t == "SOAM") {
            
            return $this->statementOfAccountReport($request);
            
        }elseif ($request->t == "SOSA") {

            return $this->summaryOfRawSugarAnalyses($request);
            
        }

    }






    // Reports

    private function annualRevenueAccomplishmentReport($request){

        $year = $request->arar_year;

        $sugar_samples = $this->__static->sugar_samples();
        

        // first quarter
        $first_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1002', $sugar_samples['rawSugar']);
        $first_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1002', $sugar_samples['molasses']);
        $first_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1002', $sugar_samples['muscovado']);
        $first_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1002', $sugar_samples['cja']);

        $first_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1001', $sugar_samples['rawSugar']);
        $first_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1001', $sugar_samples['molasses']);
        $first_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1001', $sugar_samples['muscovado']);
        $first_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-01-01', $year .'-03-31', 'CT1001', $sugar_samples['cja']);


        // second quarter
        $second_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1002', $sugar_samples['rawSugar']);
        $second_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1002', $sugar_samples['molasses']);
        $second_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1002', $sugar_samples['muscovado']);
        $second_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1002', $sugar_samples['cja']);

        $second_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1001', $sugar_samples['rawSugar']);
        $second_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1001', $sugar_samples['molasses']);
        $second_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1001', $sugar_samples['muscovado']);
        $second_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-04-01', $year .'-06-30', 'CT1001', $sugar_samples['cja']);


        // third quarter
        $third_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1002', $sugar_samples['rawSugar']);
        $third_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1002', $sugar_samples['molasses']);
        $third_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1002', $sugar_samples['muscovado']);
        $third_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1002', $sugar_samples['cja']);

        $third_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1001', $sugar_samples['rawSugar']);
        $third_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1001', $sugar_samples['molasses']);
        $third_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1001', $sugar_samples['muscovado']);
        $third_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-07-01', $year .'-09-30', 'CT1001', $sugar_samples['cja']);


        // fourth quarter
        $fourth_quarter_mill_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1002', $sugar_samples['rawSugar']);
        $fourth_quarter_mill_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1002', $sugar_samples['molasses']);
        $fourth_quarter_mill_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1002', $sugar_samples['muscovado']);
        $fourth_quarter_mill_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1002', $sugar_samples['cja']);

        $fourth_quarter_walkin_rawSugar = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1001', $sugar_samples['rawSugar']);
        $fourth_quarter_walkin_molasses = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1001', $sugar_samples['molasses']);
        $fourth_quarter_walkin_muscovado = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1001', $sugar_samples['muscovado']);
        $fourth_quarter_walkin_caneJuice = $this->sugar_analysis_repo->getByDate_CustomerType_SugarSampleId($year .'-10-01', $year .'-12-31', 'CT1001', $sugar_samples['cja']);


        // Total Revenue per Quarter and Customer Type
        $total_revenue_first_mill = $first_quarter_mill_rawSugar->sum('total_price') + $first_quarter_mill_molasses->sum('total_price');
        $total_revenue_first_walkin = $first_quarter_walkin_rawSugar->sum('total_price') + $first_quarter_walkin_molasses->sum('total_price') + $first_quarter_walkin_muscovado->sum('total_price') + $first_quarter_walkin_caneJuice->sum('total_price');

        $total_revenue_second_mill = $second_quarter_mill_rawSugar->sum('total_price') + $second_quarter_mill_molasses->sum('total_price');
        $total_revenue_second_walkin = $second_quarter_walkin_rawSugar->sum('total_price') + $second_quarter_walkin_molasses->sum('total_price') + $second_quarter_walkin_muscovado->sum('total_price') + $second_quarter_walkin_caneJuice->sum('total_price');

        $total_revenue_third_mill = $third_quarter_mill_rawSugar->sum('total_price') + $third_quarter_mill_molasses->sum('total_price');
        $total_revenue_third_walkin = $third_quarter_walkin_rawSugar->sum('total_price') + $third_quarter_walkin_molasses->sum('total_price') + $third_quarter_walkin_muscovado->sum('total_price') + $third_quarter_walkin_caneJuice->sum('total_price');

        $total_revenue_fourth_mill = $fourth_quarter_mill_rawSugar->sum('total_price') + $fourth_quarter_mill_molasses->sum('total_price');
        $total_revenue_fourth_walkin = $fourth_quarter_walkin_rawSugar->sum('total_price') + $fourth_quarter_walkin_molasses->sum('total_price') + $fourth_quarter_walkin_muscovado->sum('total_price') + $fourth_quarter_walkin_caneJuice->sum('total_price');


        return view('printables.sugar_analysis.annual_accomplishment_report')->with([

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


                    'total_revenue_first_mill' => $total_revenue_first_mill,
                    'total_revenue_first_walkin' => $total_revenue_first_walkin,
                    'total_revenue_second_mill' => $total_revenue_second_mill,
                    'total_revenue_second_walkin' => $total_revenue_second_walkin,
                    'total_revenue_third_mill' => $total_revenue_third_mill,
                    'total_revenue_third_walkin' => $total_revenue_third_walkin,
                    'total_revenue_fourth_mill' => $total_revenue_fourth_mill,
                    'total_revenue_fourth_walkin' => $total_revenue_fourth_walkin,

                ]);

    }






    private function statementOfAccountReport($request){
        
        $sugar_analysis_list = $this->sugar_analysis_repo->getByMillId_SugarSampleId_WeekEnding($request->soam_mill_id, $request->soam_sugar_sample_id, $request->soam_we_from, $request->soam_we_to);

        $mill = $this->mill_repo->findByMillId($request->soam_mill_id);

        return view('printables.sugar_analysis.statement_of_account_report')->with([

            'sugar_analysis_list' => $sugar_analysis_list,
            'mill' => $mill,

        ]);

    }






    private function summaryOfRawSugarAnalyses($request){

        $sugar_samples = $this->__static->sugar_samples();

        $sugar_analysis_list = $this->sugar_analysis_repo->getBySugarSampleId_WeekEnding($sugar_samples['rawSugar'], $request->sosa_we_from, $request->sosa_we_to);
        
        return view('printables.sugar_analysis.summary_of_raw_sugar_analyses')->with('sugar_analysis_list', $sugar_analysis_list);

    }







}