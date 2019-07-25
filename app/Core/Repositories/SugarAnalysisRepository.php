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

        $key = str_slug($request->fullUrl(), '_');

        $sugar_analysis = $this->cache->remember('sugar_analysis:fetch:' . $key, 240, function() use ($request){

            $sa = $this->sugar_analysis->newQuery();
            
            $we = $this->__dataType->date_parse($request->we);

            if(isset($request->q)){
                $this->search($sa, $request->q);
            }
            
            if(isset($request->ss)){
                $sa->where('sugar_sample_id', $request->ss);
            }
            
            if(isset($request->we)){
                $sa->whereDate('week_ending', $we);
            }

            return $this->populate($sa);

        });

        return $sugar_analysis;

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
        $sugar_analysis->cja_num_of_samples = $request->sugar_sample_id == "SS1006" ? $request->cja_num_of_samples : 0;
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






    public function updateResult($request, $slug){

        $sugar_analysis = $this->findBySlug($slug);
        $sugar_analysis->week_ending = $this->__dataType->date_parse($request->week_ending);
        $sugar_analysis->date_sampled = $this->__dataType->date_parse($request->date_sampled);
        $sugar_analysis->date_submitted = $this->__dataType->date_parse($request->date_submitted);
        $sugar_analysis->date_analyzed_from = $this->__dataType->date_parse($request->date_analyzed_from);
        $sugar_analysis->date_analyzed_to = $this->__dataType->date_parse($request->date_analyzed_to);
        $sugar_analysis->quantity = $request->quantity;
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

        $sa = $this->cache->remember('sugar_analysis:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sugar_analysis->where('slug', $slug)
                              ->with(['sugarAnalysisParameter', 'caneJuiceAnalysis'])
                              ->first();
        }); 
        
        if(empty($sa)){
            abort(404);
        }

        return $sa;

    }






    public function getByDate_CustomerType_SampleId($date_from, $date_to, $customer_type = [], $sample_id = []){

        $customer_type_string = implode(',', $customer_type);
        $sample_id_string = implode(',', $sample_id);

        $cache_key = 'sugar_analysis:getByDate_CustomerType_SampleId:'. $date_from .'-'. $date_to .':'. $customer_type_string .':'. $sample_id_string;

        $sa = $this->cache->remember($cache_key, 240, function() use ($date_from, $date_to, $customer_type, $sample_id){
           
            $sa_list = $this->sugar_analysis->newQuery();

            if(isset($date_from) || isset($date_to)){

                $df = $this->__dataType->date_parse($date_from);
                $dt = $this->__dataType->date_parse($date_to);

                $sa_list->whereBetween('date', [$df, $dt]);

            }

            $sa_list->whereIn('customer_type', $customer_type);

            $sa_list->whereIn('sugar_sample_id', $sample_id);

            return $sa_list->get();

        }); 

        return $sa;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('sample_no', 'LIKE', '%'. $key .'%')
                      ->orwhere('origin', 'LIKE', '%'. $key .'%')
                      ->orwhere('or_no', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('sample_no', 'origin', 'sugar_sample_id', 'week_ending', 'status', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }





}