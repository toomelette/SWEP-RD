<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarSampleInterface;

use App\Models\SugarSample;


class SugarSampleRepository extends BaseRepository implements SugarSampleInterface {
	



    protected $sugar_sample;




	public function __construct(SugarSample $sugar_sample){

        $this->sugar_sample = $sugar_sample;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $sugar_samples = $this->cache->remember('sugar_samples:fetch:' . $key, 240, function() use ($request){

            $sugar_sample = $this->sugar_sample->newQuery();
            
            if(isset($request->q)){
                $this->search($sugar_sample, $request->q);
            }

            return $this->populate($sugar_sample);

        });

        return $sugar_samples;

    }






    public function store($request){

        $sugar_sample = new SugarSample;
        $sugar_sample->slug = $this->str->random(16);
        $sugar_sample->sugar_sample_id = $this->getSugarSampleIdInc();
        $sugar_sample->name = $request->name;
        $sugar_sample->created_at = $this->carbon->now();
        $sugar_sample->updated_at = $this->carbon->now();
        $sugar_sample->ip_created = request()->ip();
        $sugar_sample->ip_updated = request()->ip();
        $sugar_sample->user_created = $this->auth->user()->user_id;
        $sugar_sample->user_updated = $this->auth->user()->user_id;
        $sugar_sample->save();
        
        return $sugar_sample;

    }






    public function update($request, $slug){

        $sugar_sample = $this->findBySlug($slug);
        $sugar_sample->name = $request->name;
        $sugar_sample->updated_at = $this->carbon->now();
        $sugar_sample->ip_updated = request()->ip();
        $sugar_sample->user_updated = $this->auth->user()->user_id;
        $sugar_sample->save();
        
        $sugar_sample->sugarSampleParameter()->delete();

        return $sugar_sample;

    }






    public function destroy($slug){

        $sugar_sample = $this->findBySlug($slug);  
        $sugar_sample->delete();
        $sugar_sample->sugarSampleParameter()->delete();

        return $sugar_sample;

    }






    public function findBySlug($slug){

        $sugar_sample = $this->cache->remember('sugar_samples:findBySlug:'. $slug, 240, function() use ($slug){
            return $this->sugar_sample->where('slug', $slug)->first();
        }); 
        
        if(empty($sugar_sample)){
            abort(404);
        }

        return $sugar_sample;

    }






    public function getAll(){

        $sugar_samples = $this->cache->remember('sugar_samples:getAll', 240, function(){
            return $this->sugar_sample->select('sugar_sample_id', 'name')->get();
        });
        
        return $sugar_samples;

    }






    private function getSugarSampleIdInc(){

        $id = 'SS1001';

        $sugar_sample = $this->sugar_sample->select('sugar_sample_id')->orderBy('sugar_sample_id', 'desc')->first();

        if($sugar_sample != null){
            if($sugar_sample->sugar_sample_id != null){
                $num = str_replace('SS', '', $sugar_sample->sugar_sample_id) + 1;
                $id = 'SS' . $num;
            }
        }
        
        return $id;
        
    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('name', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






}