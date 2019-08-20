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

        $cache_key = str_slug($request->fullUrl(), '_');

        $entries = isset($request->e) ? $request->e : 20;

        $sugar_oops = $this->cache->remember('sugar_order_of_payments:fetch:' . $cache_key, 240, function() use ($request, $entries){

            $sugar_oop = $this->sugar_oop->newQuery();
            $df = $this->__dataType->date_parse($request->df);
            $dt = $this->__dataType->date_parse($request->dt);

            if(isset($request->q)){ $this->search($sugar_oop, $request->q); }

            if(isset($request->ss)){ $sugar_oop->where('sugar_sample_id', $request->ss); }

            if(isset($request->df) && isset($request->dt)){ $sugar_oop->whereBetween('date', [$df, $dt]); }

            return $this->populate($sugar_oop, $entries);

        });

        return $sugar_oops;

    }





    public function store($request, $total_price){

        $sugar_oop = new SugarOrderOfPayment;
        $sugar_oop->slug = $this->str->random(16);
        $sugar_oop->sample_no = $this->getSampleNoInc();
        $sugar_oop->sugar_sample_id = $request->sugar_sample_id;
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
        
        $sugar_oop->sugar_sample_id = $request->sugar_sample_id;
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
        
        foreach ($sugar_oop->sugarAnalysisParameter as $data) {
            $data->sugarAnalysisParameterMethod()->delete();
        }

        return $sugar_oop;
        
    }






    public function destroy($slug){

        $sugar_oop = $this->findBySlug($slug);  

        $sugar_oop->delete();
        $sugar_oop->sugarAnalysis()->delete();
        $sugar_oop->sugarAnalysisParameter()->delete();
        $sugar_oop->caneJuiceAnalysis()->delete();

        foreach ($sugar_oop->sugarAnalysisParameter as $data) {
            $data->sugarAnalysisParameterMethod()->delete();
        }
        
        return $sugar_oop;

    }






    public function findBySlug($slug){

        $sugar_oop = $this->cache->remember('sugar_order_of_payments:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sugar_oop->where('slug', $slug)
                                   ->with(['sugarAnalysis', 
                                           'caneJuiceAnalysis', 
                                           'sugarAnalysisParameter',  
                                           'sugarSample'])
                                   ->first();
        }); 
        
        if(empty($sugar_oop)){ abort(404); }

        return $sugar_oop;

    }






    private function getSampleNoInc(){

        $sample_no = $this->carbon->now()->format('Y') .'0001';
        $sugar_oop = $this->sugar_oop->select('sample_no')->orderBy('sample_no', 'desc')->first();

        if($sugar_oop != null){ $sample_no = $sugar_oop->sample_no + 1; }
        
        return $sample_no;
        
    }






    private function search($instance, $key){

        return $instance->where(function ($instance) use ($key) {
                $instance->where('sample_no', 'LIKE', '%'. $key .'%')
                         ->orwhere('received_from', 'LIKE', '%'. $key .'%')
                         ->orwhere('received_by', 'LIKE', '%'. $key .'%');
        });

    }





    private function populate($instance, $entries){

        return $instance->select('sample_no', 'received_from', 'received_by', 'sugar_sample_id', 'date', 'slug')
                        ->with(['sugarSample'])
                        ->sortable()
                        ->orderBy('updated_at', 'desc')
                        ->paginate($entries);

    }
    






}