<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');
		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Core\Repositories\UserMenuRepository');
		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');

		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');
		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');

		// LMD
		$this->app->bind('App\Core\Interfaces\MillInterface', 'App\Core\Repositories\MillRepository');

		// Sugar Laboratory
		$this->app->bind('App\Core\Interfaces\SugarOrderOfPaymentInterface', 'App\Core\Repositories\SugarOrderOfPaymentRepository');
		$this->app->bind('App\Core\Interfaces\SugarServiceInterface', 'App\Core\Repositories\SugarServiceRepository');
		$this->app->bind('App\Core\Interfaces\SugarAnalysisInterface', 'App\Core\Repositories\SugarAnalysisRepository');
		$this->app->bind('App\Core\Interfaces\SugarAnalysisParameterInterface', 'App\Core\Repositories\SugarAnalysisParameterRepository');
		$this->app->bind('App\Core\Interfaces\CaneJuiceAnalysisInterface', 'App\Core\Repositories\CaneJuiceAnalysisRepository');
		$this->app->bind('App\Core\Interfaces\SugarSampleInterface', 'App\Core\Repositories\SugarSampleRepository');
		$this->app->bind('App\Core\Interfaces\SugarSampleParameterInterface', 'App\Core\Repositories\SugarSampleParameterRepository');
		
	}



}