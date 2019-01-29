<?php

namespace App\Http\Middleware;

use Closure;
use App\Core\Interfaces\UserMenuInterface;
use App\Core\Interfaces\UserSubmenuInterface;

class CheckUserRouteExist{



    protected $user_menu_repo;
    protected $user_submenu_repo;



    public function __construct(UserMenuInterface $user_menu_repo, UserSubmenuInterface $user_submenu_repo){

        $this->user_menu_repo = $user_menu_repo;
        $this->user_submenu_repo = $user_submenu_repo;
        
    }
  




    public function handle($request, Closure $next){

        if($this->user_menu_repo->isExist() || $this->user_submenu_repo->isExist()){

            return $next($request);

        }

        return abort(404);
    
    }





}
