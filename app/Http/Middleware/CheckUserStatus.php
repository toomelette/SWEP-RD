<?php

namespace App\Http\Middleware;


use Auth;
use Session;
use Closure;



class CheckUserStatus{


    protected $auth;
    protected $session;




    public function __construct(){

        $this->auth = auth();
        $this->session = session();
        
    }




    public function handle($request, Closure $next){

        if($this->auth->guard()->check()){

            if($this->auth->user()->is_online == false){

                $this->auth->logout();
                $this->session->flush();
                $this->session->flash('CHECK_NOT_LOGGED_IN', 'You have been SIGNED OUT somewhere! Please Sign in again.');
                return redirect('/');

            }elseif($this->auth->user()->is_active == false){

                $this->auth->logout();
                $this->session->flush();
                $this->session->flash('CHECK_NOT_ACTIVE', 'You have been DEACTIVATED! Please contact the designated IT Personel.');
                return redirect('/');

            }

        return $next($request);

        }

        $this->session->flush();
        $this->session->flash('CHECK_UNAUTHENTICATED', 'Please Sign in to start your session.');
        return redirect('/'); 
    
    }





}
