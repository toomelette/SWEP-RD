<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        /** VIEW COMPOSERS  **/


        // USERMENU
        View::composer('layouts.admin-sidenav', 'App\Core\ViewComposers\UserMenuComposer');


        // MENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\MenuComposer');
        

        // SUBMENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\SubmenuComposer');
        

        // MILLS
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit'], 'App\Core\ViewComposers\MillComposer');
        

        // SUGAR SERVICES
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit',
                        'dashboard.sugar_sample.create',
                        'dashboard.sugar_sample.edit'], 'App\Core\ViewComposers\SugarServiceComposer');
        

        // SUGAR SAMPLE
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit'], 'App\Core\ViewComposers\SugarSampleComposer');
        

        // SUGAR SAMPLE PARAMETER
        View::composer(['dashboard.sugar_order_of_payment.create',
                        'dashboard.sugar_order_of_payment.edit'], 'App\Core\ViewComposers\SugarSampleParameterComposer');

        
    }

    



    public function register(){

    
    }





}
