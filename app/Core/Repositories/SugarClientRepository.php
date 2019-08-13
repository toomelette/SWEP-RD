<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SugarClientInterface;


use App\Models\SugarClient;


class SugarClientRepository extends BaseRepository implements SugarClientInterface {
	



    protected $sugar_client;




	public function __construct(SugarClient $sugar_client){

        $this->sugar_client = $sugar_client;
        parent::__construct();

    }






    public function store($request){

        $sugar_client = new SugarClient;
        $sugar_client->slug = $this->str->random(16);
        $sugar_client->sugar_client_id = $this->getSugarClientInc();
        $sugar_client->name = $request->received_from;
        $sugar_client->address = $request->address;
        $sugar_client->created_at = $this->carbon->now();
        $sugar_client->updated_at = $this->carbon->now();
        $sugar_client->ip_created = request()->ip();
        $sugar_client->ip_updated = request()->ip();
        $sugar_client->user_created = $this->auth->user()->user_id;
        $sugar_client->user_updated = $this->auth->user()->user_id;
        $sugar_client->save();
        
        return $sugar_client;

    }





    public function getAll(){

        $sugar_clients = $this->cache->remember('sugar_clients:getAll', 240, function(){
            return $this->sugar_client->select('sugar_client_id','name', 'address')
                                      ->orderBy('name', 'asc')
                                      ->get();
        });
        
        return $sugar_clients;

    }





    public function isExist($sugar_client_id){

        $sugar_clients = $this->cache->remember('sugar_clients:isExist:'. $sugar_client_id .'', 240, function() use ($sugar_client_id){
            return $this->sugar_client->where('sugar_client_id', $sugar_client_id)->exists();
        });
        
        return $sugar_clients;

    }






    private function getSugarClientInc(){

        $id = 'SC1001';
        $sugar_client = $this->sugar_client->select('sugar_client_id')->orderBy('sugar_client_id', 'desc')->first();

        if($sugar_client != null){
            $num = str_replace('SC', '', $sugar_client->sugar_client_id) + 1;
            $id = 'SC' . $num;
        }
        
        return $id;
        
    }







}