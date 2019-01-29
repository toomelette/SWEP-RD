<?php

namespace App\Core\ViewComposers;


use View;
use Auth;
use App\Core\Interfaces\UserMenuInterface;


class UserMenuComposer{
   


    protected $user_menu_repo;
	protected $auth;




	public function __construct(UserMenuInterface $user_menu_repo){

        $this->user_menu_repo = $user_menu_repo;
		$this->auth = auth();
    
	}





    public function compose($view){

        $user_menus = [];


        if($this->auth->check()){

            $user_menus_u = $this->user_menu_repo->getByCategory('U');

            $user_menus_su = $this->user_menu_repo->getByCategory('SU');

            $user_menus_sgrlab = $this->user_menu_repo->getByCategory('SGRLAB');

        }  


    	$view->with([
            'global_user_menus_u'=> $user_menus_u,
            'global_user_menus_su'=> $user_menus_su,
            'global_user_menus_sgrlab'=> $user_menus_sgrlab,
        ]);


    }






}