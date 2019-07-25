<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\SugarClientInterface;



class SugarClientComposer{
   


	protected $sugar_client_repo;




	public function __construct(SugarClientInterface $sugar_client_repo){

		$this->sugar_client_repo = $sugar_client_repo;

	}





    public function compose($view){

        $sugar_clients = $this->sugar_client_repo->getAll();

        $sugar_clients_json = [];

        foreach ($sugar_clients as $data) {
        	 
        	$sugar_clients_json[] = [
			    'value' => $data->name,
			    'id' => $data->sugar_client_id,
			    'address' => $data->address,
			];

        }
        
    	$view->with('global_sugar_clients_all_json', json_encode($sugar_clients_json));

    }






}