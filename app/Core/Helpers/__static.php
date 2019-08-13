<?php

namespace App\Core\Helpers;



class __static{



    // Profile
    public static function user_colors(){

        return [

	      'Blue/Dark' => 'sidebar-mini skin-blue',
	      'White/Dark' => 'sidebar-mini skin-black',
	      'Purple/Dark' => 'sidebar-mini skin-purple',
	      'Green/Dark' => 'sidebar-mini skin-green',
	      'Red/Dark' => 'sidebar-mini skin-red',
	      'Yellow/Dark' => 'sidebar-mini skin-yellow',
	      'Blue/Light' => 'sidebar-mini skin-blue-light',
	      'White/Light' => 'sidebar-mini skin-black-light',
	      'Purple/Light' => 'sidebar-mini skin-purple-light',
	      'Green/Light' => 'sidebar-mini skin-green-light',
	      'Red/Light' => 'sidebar-mini skin-red-light',
	      'Yellow/Light' => 'sidebar-mini skin-yellow-light',

	    ];

    
    }




    // LMD Mills
    public static function lmd_mill_districts(){

        return [

	      'Panay' => 'PANAY',
	      'Negros Occidental North' => 'NEGOCC-N',
	      'Negros Occidental South' => 'NEGOCC-S',
	      'Negros Oriental' => 'NEGOR',
	      'Cebu' => 'CEBU',
	      'Leyte' => 'LEYTE',

	    ];

    }




    // Sugar Services
    public static function sugar_services(){

        return [

			"pol" => "SS1001",
			"ash" => "SS1004",
			"affination" => "SS1005",
			"colorW" => "SS1006",
			"colorA" => "SS1007",
			"grainSize" => "SS1008",
			"dextran" => "SS1009",
			"sulphite" => "SS1010",
			"brix" => "SS1012",
			"reducingSugar" => "SS1013",
			"sucrose" => "SS1014",
			"totalSugarAsInvert" => "SS1015",
			"totalReducingSugarafterHydrolysis" => "SS1016",
			"mois" => "SS1017",
			"starch" => "SS1018",
			"apparentPurity" => "SS1019",
			"specificGravity" => "SS1020",
			"ph" => "SS1021",

	    ];

    }




    // Sugar Samples
    public static function sugar_samples(){

        return [

        	"rawSugar" => "SS1001",
			"muscovado" => "SS1003",
			"molasses" => "SS1004",
			"cja" => "SS1006",

	    ];

    }




}