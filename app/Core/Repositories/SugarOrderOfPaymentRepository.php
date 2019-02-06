<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarOrderOfPaymentInterface;

use App\Models\SugarOrderOfPayment;


class SugarOrderOfPaymentRepository extends BaseRepository implements SugarOrderOfPaymentInterface {
	


    protected $sugar_oop;



	public function __construct(SugarOrderOfPayment $sugar_oop){

        $this->sugar_oop = $sugar_oop;
        parent::__construct();

    }






    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $sugar_oops = $this->cache->remember('sugar_order_of_payments:fetch:' . $key, 240, function() use ($request){

            $sugar_oop = $this->sugar_oop->newQuery();
            
            if(isset($request->q)){
                $this->search($sugar_oop, $request->q);
            }

            return $this->populate($sugar_oop);

        });

        return $sugar_oops;

    }





    public function store($request, $total_price){

        $sugar_oop = new SugarOrderOfPayment;
        $sugar_oop->slug = $this->str->random(16);
        $sugar_oop->sample_no = $request->sample_no;
        $sugar_oop->sugar_sample = $request->sugar_sample;
        $sugar_oop->date = $this->__dataType->date_parse($request->date);
        $sugar_oop->address = $request->address;
        $sugar_oop->received_from = $request->received_from;
        $sugar_oop->received_by = $request->received_by;
        $sugar_oop->total_price = $total_price;
        $sugar_oop->created_at = $this->carbon->now();
        $sugar_oop->updated_at = $this->carbon->now();
        $sugar_oop->ip_created = request()->ip();
        $sugar_oop->ip_updated = request()->ip();
        $sugar_oop->user_created = $this->auth->user()->user_id;
        $sugar_oop->user_updated = $this->auth->user()->user_id;
        $sugar_oop->save();

        return $sugar_oop;
        
    }





    public function update($request, $sugar_oop, $total_price){
        
        $sugar_oop->sample_no = $request->sample_no;
        $sugar_oop->sugar_sample = $request->sugar_sample;
        $sugar_oop->date = $this->__dataType->date_parse($request->date);
        $sugar_oop->address = $request->address;
        $sugar_oop->received_from = $request->received_from;
        $sugar_oop->received_by = $request->received_by;
        $sugar_oop->total_price = $total_price;
        $sugar_oop->updated_at = $this->carbon->now();
        $sugar_oop->ip_updated = request()->ip();
        $sugar_oop->user_updated = $this->auth->user()->user_id;
        $sugar_oop->save();

        $sugar_oop->sugarAnalysisParameter()->delete();

        return $sugar_oop;
        
    }






    public function destroy($slug){

        $sugar_oop = $this->findBySlug($slug);  
        $sugar_oop->delete();
        $sugar_oop->sugarAnalysis()->delete();
        $sugar_oop->sugarAnalysisParameter()->delete();

        return $sugar_oop;

    }






    public function findBySlug($slug){

        $sugar_oop = $this->cache->remember('sugar_order_of_payments:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sugar_oop->where('slug', $slug)
                              ->with(['sugarAnalysisParameter'])
                              ->first();
        }); 
        
        if(empty($sugar_oop)){
            abort(404);
        }

        return $sugar_oop;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('sample_no', 'LIKE', '%'. $key .'%')
                      ->orwhere('received_from', 'LIKE', '%'. $key .'%')
                      ->orwhere('received_by', 'LIKE', '%'. $key .'%')
                      ->orwhere('sugar_sample', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('sample_no', 'received_from', 'received_by', 'sugar_sample', 'date', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






}