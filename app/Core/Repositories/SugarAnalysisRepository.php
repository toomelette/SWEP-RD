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
            
            if(isset($request->q)){
                $this->search($sa, $request->q);
            }

            return $this->populate($sa);

        });

        return $sugar_analysis;

    }






    public function store($request, $total_price){

        $sugar_analysis = new SugarAnalysis;
        $sugar_analysis->slug = $this->str->random(16);
        $sugar_analysis->sample_no = $request->sample_no;
        $sugar_analysis->customer_type = $request->customer_type;
        $sugar_analysis->mill_id = $request->mill_id;
        $sugar_analysis->date = $this->__dataType->date_parse($request->date);
        $sugar_analysis->origin = $request->received_from;
        $sugar_analysis->address = $request->address;
        $sugar_analysis->quantity = 0.00;
        $sugar_analysis->week_ending = null;
        $sugar_analysis->date_sampled = null;
        $sugar_analysis->date_submitted = null;
        $sugar_analysis->date_analyzed = null;
        $sugar_analysis->description = '';
        $sugar_analysis->total_price = $total_price;
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
        $sugar_analysis->sample_no = $request->sample_no;
        $sugar_analysis->customer_type = $request->customer_type;
        $sugar_analysis->mill_id = $request->mill_id;
        $sugar_analysis->date = $this->__dataType->date_parse($request->date);
        $sugar_analysis->origin = $request->received_from;
        $sugar_analysis->address = $request->address;
        $sugar_analysis->quantity = 0.00;
        $sugar_analysis->week_ending = null;
        $sugar_analysis->date_sampled = null;
        $sugar_analysis->date_submitted = null;
        $sugar_analysis->date_analyzed = null;
        $sugar_analysis->description = '';
        $sugar_analysis->total_price = $total_price;
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
        $sugar_analysis->date_analyzed = $this->__dataType->date_parse($request->date_analyzed);
        $sugar_analysis->quantity = $this->__dataType->string_to_num($request->quantity);
        $sugar_analysis->description = $request->description;
        $sugar_analysis->updated_at = $this->carbon->now();
        $sugar_analysis->ip_updated = request()->ip();
        $sugar_analysis->user_updated = $this->auth->user()->user_id;
        $sugar_analysis->save();

        return $sugar_analysis;
        
    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('sample_no', 'LIKE', '%'. $key .'%')
                      ->orwhere('origin', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('sample_no', 'origin', 'week_ending', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function findBySlug($slug){

        $sa = $this->cache->remember('sugar_analysis:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sugar_analysis->where('slug', $slug)
                              ->with(['sugarAnalysisParameter'])
                              ->first();
        }); 
        
        if(empty($sa)){
            abort(404);
        }

        return $sa;

    }





}