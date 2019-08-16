<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarAnalysisInterface;

use App\Models\SugarAnalysis;


class SugarAnalysisRepository extends BaseRepository implements SugarAnalysisInterface {
	



    protected $sugar_analysis;




	public function __construct(SugarAnalysis $sugar_analysis){

        $this->sugar_analysis = $sugar_analysis;
        parent::__construct();

    }






    public function fetch($request){

        $cache_key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $sugar_analyses = $this->cache->remember('sugar_analysis:fetch:' . $cache_key, 240, function() use ($request, $entries){

            $sugar_analysis = $this->sugar_analysis->newQuery();
            $we = $this->__dataType->date_parse($request->we);

            if(isset($request->q)){ $this->search($sugar_analysis, $request->q); }
            
            if(isset($request->ss)){ $sugar_analysis->where('sugar_sample_id', $request->ss); }
            
            if(isset($request->we)){ $sugar_analysis->whereDate('week_ending', $we); }

            return $this->populate($sugar_analysis, $entries);

        });

        return $sugar_analyses;

    }






    public function setOrNo($request, $slug){

        $sugar_analysis = $this->findBySlug($slug);
        $sugar_analysis->or_no = $request->or_no;
        $sugar_analysis->save();

        return $sugar_analysis;
        
    }






    public function storeOrderOfPayment($request, $total_price, $sample_no){

        $sugar_analysis = new SugarAnalysis;
        $sugar_analysis->slug = $this->str->random(16);
        $sugar_analysis->sample_no = $sample_no;
        $sugar_analysis->sugar_sample_id = $request->sugar_sample_id;
        $sugar_analysis->customer_type = $request->customer_type;
        $sugar_analysis->mill_id = $request->mill_id;
        $sugar_analysis->sugar_client_id = $request->sugar_client_id;
        $sugar_analysis->date = $this->__dataType->date_parse($request->date);
        $sugar_analysis->origin = $request->received_from;
        $sugar_analysis->address = $request->address;
        $sugar_analysis->total_price = $total_price;
        $sugar_analysis->cja_num_of_samples = $request->cja_num_of_samples;
        $sugar_analysis->created_at = $this->carbon->now();
        $sugar_analysis->updated_at = $this->carbon->now();
        $sugar_analysis->ip_created = request()->ip();
        $sugar_analysis->ip_updated = request()->ip();
        $sugar_analysis->user_created = $this->auth->user()->user_id;
        $sugar_analysis->user_updated = $this->auth->user()->user_id;
        $sugar_analysis->save();
        
        return $sugar_analysis;
        
    }






    public function updateOrderOfPayment($request, $slug, $total_price){

        $sugar_analysis = $this->findBySlug($slug);
        $sugar_analysis->sugar_sample_id = $request->sugar_sample_id;
        $sugar_analysis->customer_type = $request->customer_type;
        $sugar_analysis->mill_id = $request->mill_id;
        $sugar_analysis->sugar_client_id = $request->sugar_client_id;
        $sugar_analysis->date = $this->__dataType->date_parse($request->date);
        $sugar_analysis->origin = $request->received_from;
        $sugar_analysis->address = $request->address;
        $sugar_analysis->total_price = $total_price;
        $sugar_analysis->cja_num_of_samples = $request->cja_num_of_samples;
        $sugar_analysis->updated_at = $this->carbon->now();
        $sugar_analysis->ip_updated = request()->ip();
        $sugar_analysis->user_updated = $this->auth->user()->user_id;
        $sugar_analysis->save();

        return $sugar_analysis;
        
    }






    public function updateResult($request, $sugar_analysis){

        $sugar_analysis->week_ending = $this->__dataType->date_parse($request->week_ending);
        $sugar_analysis->date_submitted = $this->__dataType->date_parse($request->date_submitted);
        $sugar_analysis->date_sampled = $this->__dataType->date_parse($request->date_sampled);
        $sugar_analysis->date_analyzed = $request->date_analyzed;
        $sugar_analysis->quantity_mt = $request->quantity_mt;
        $sugar_analysis->code = $request->code;
        $sugar_analysis->report_no = $request->report_no;
        $sugar_analysis->source = $request->source;
        $sugar_analysis->description = $request->description;
        $sugar_analysis->status = "ANALYZED";
        $sugar_analysis->updated_at = $this->carbon->now();
        $sugar_analysis->ip_updated = request()->ip();
        $sugar_analysis->user_updated = $this->auth->user()->user_id;
        $sugar_analysis->save();

        return $sugar_analysis;
        
    }






    public function findBySlug($slug){

        $sugar_analysis = $this->cache->remember('sugar_analysis:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sugar_analysis->where('slug', $slug)
                                        ->with(['sugarAnalysisParameter', 
                                                'sugarAnalysisParameter.sugarAnalysisParameterMethod', 
                                                'caneJuiceAnalysis', 
                                                'sugarSample'])
                                        ->first();
        }); 
        
        if(empty($sugar_analysis)){ abort(404); }

        return $sugar_analysis;

    }






    public function getByCustomerType_SugarSampleId_Date($customer_type, $sugar_sample_id, $date_from, $date_to){

        $cache_key = 'sugar_analysis:getByCustomerType_SugarSampleId_Date:'. $customer_type .':'. $sugar_sample_id.':'. $date_from .'-'. $date_to;

        $sugar_analyses = $this->cache->remember($cache_key, 240, function() use ($customer_type, $sugar_sample_id, $date_from, $date_to){
           
            $sugar_analysis = $this->sugar_analysis->newQuery();

            $sugar_analysis->where('customer_type', $customer_type);
            $sugar_analysis->where('sugar_sample_id', $sugar_sample_id);

            if(isset($date_from) && isset($date_to)){

                $df = $this->__dataType->date_parse($date_from);
                $dt = $this->__dataType->date_parse($date_to);
                $sugar_analysis->whereBetween('date', [$df, $dt]);

            }

            return $sugar_analysis->get();

        }); 

        return $sugar_analyses;

    }






    public function getByMillId_SugarSampleId_WeekEnding($mill_id, $sugar_sample_id, $week_ending_from, $week_ending_to){

        $cache_key = 'sugar_analysis:getByMillId_SugarSampleId_WeekEnding:'. $mill_id .':'. $sugar_sample_id .':'. $week_ending_from .'-'. $week_ending_to;

        $sugar_analyses = $this->cache->remember($cache_key, 240, function() use ($mill_id, $sugar_sample_id, $week_ending_from, $week_ending_to){
           
            $sugar_analysis = $this->sugar_analysis->newQuery();

            $sugar_analysis->where('mill_id', $mill_id);
            $sugar_analysis->where('sugar_sample_id', $sugar_sample_id);

            if(isset($week_ending_from) && isset($week_ending_to)){

                $week_ending_from = $this->__dataType->date_parse($week_ending_from);
                $week_ending_to = $this->__dataType->date_parse($week_ending_to);
                $sugar_analysis->whereBetween('week_ending', [$week_ending_from, $week_ending_to]);

            }

            return $sugar_analysis->get();

        }); 

        return $sugar_analyses;

    }






    public function getBySugarSampleId_WeekEnding($sugar_sample_id, $week_ending_from, $week_ending_to){

        $cache_key = 'sugar_analysis:getBySugarSampleId_WeekEnding:'. $sugar_sample_id .':'. $week_ending_from .'-'. $week_ending_to;

        $sugar_analyses = $this->cache->remember($cache_key, 240, function() use ($sugar_sample_id, $week_ending_from, $week_ending_to){
           
            $sugar_analysis = $this->sugar_analysis->newQuery();

            $sugar_analysis->where('sugar_sample_id', $sugar_sample_id);

            if(isset($week_ending_from) || isset($week_ending_to)){

                $week_ending_from = $this->__dataType->date_parse($week_ending_from);
                $week_ending_to = $this->__dataType->date_parse($week_ending_to);
                $sugar_analysis->whereBetween('week_ending', [$week_ending_from, $week_ending_to]);

            }

            $sugar_analysis->with(['sugarAnalysisParameter']);

            return $sugar_analysis->get();

        }); 

        return $sugar_analyses;

    }






    private function search($instance, $key){

        return $instance->where(function ($instance) use ($key) {
                $instance->where('sample_no', 'LIKE', '%'. $key .'%')
                         ->orwhere('origin', 'LIKE', '%'. $key .'%')
                         ->orwhere('or_no', 'LIKE', '%'. $key .'%');
        });

    }





    private function populate($instance, $entries){

        return $instance->select('sample_no', 'origin', 'sugar_sample_id', 'week_ending', 'status', 'slug')
                        ->with(['sugarSample', 'caneJuiceAnalysis'])
                        ->sortable()
                        ->orderBy('updated_at', 'desc')
                        ->paginate($entries);

    }





}