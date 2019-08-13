<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quality Test Certificate</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">


  <style type="text/css">

    table, td {

      border: 1px solid black;

    }

    thead{

      -webkit-print-color-adjust: exact; 
      background-color: #78B681 !important;

    }

    .data-row-head{

      text-align: center;
      padding:5px;
      font-size:12px;
      font-weight: bold;
      
    }

    .data-row-body-mill-name{

      padding:5px;
      font-size:12px;
      
    }

    .data-row-body{

      padding:5px;
      font-size:12px;
      text-align: center;
      
    }

    .bg-wm{

      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      position:absolute;
      opacity:0.3;
      margin-top: 150px;
      padding:80px;

    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  <img class="bg-wm" src="{{ asset('images/sra_wm.jpg') }}">

  <div class="wrapper">
    

    {{-- HEADER --}}
    <div class="row">
      <div class="col-md-12">
        <div class="col-sm-3">
          <img src="{{ asset('images/sra.png') }}" style="width:110px;">
        </div>
        <div class="col-sm-8" style="padding-right:125px; font-family: tahoma; line-height:13px; margin-left:-40px;">
          <span style="font-size:12px;">Republic of the Philippines</span><br>
          <span style="font-size:12px;">Department of Agriculture</span><br>
          <span style="font-size:12px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span style="font-size:12px;">North Avenue, Diliman, Quezon City</span><br>
          <span style="font-size:12px;">Philippines 6100</span><br>
          <span style="font-size:12px;">TIN 000-784-336</span>
        </div>
        <div class="col-sm-1"></div>
      </div>

      <div class="col-sm-12" style="margin-top: 5px;"></div>

      <div class="col-sm-12" style="text-align: center;">

        <span style="font-size:14px; font-weight:bold;">SUMMARY OF RAW SUGAR ANALYSES</span><br>

        <span style="font-size:14px; font-weight:bold;">
          Crop Year {{ __dataType::date_parse(Request::get('sosa_we_from'), "Y") .' - '. __dataType::date_parse(Request::get('sosa_we_to'), "Y") }}
        </span><br>

      </div>
    </div>




    {{-- TABLE --}}
    <div class="row" style="margin-top:20px;">

      <div class="col-md-12" style="position: center;">

        <table style="margin-left:10px; margin-right:10px; border:solid 1px; margin :auto;">
      
          <thead>

              <td class="data-row-head" style="width:200px;">Sugar Mills</td>
              <td class="data-row-head" style="width:100px;">Production in Metric Tons</td>
              <td class="data-row-head" style="width:100px;">Pol</td>
              <td class="data-row-head" style="width:100px;">Moisture</td>
              <td class="data-row-head" style="width:100px;">Safety Factor</td>
              <td class="data-row-head" style="width:100px;">Ash</td>
              <td class="data-row-head" style="width:100px;">Color Whole</td>
              <td class="data-row-head" style="width:100px;">Color Affined</td>
              <td class="data-row-head" style="width:100px;">Grain Size</td>

          </thead>
                
          <tbody>

            

            @foreach (__static::lmd_mill_districts() as $data_district => $key_district)

              <tr>

                <td class="data-row-body" style="border-right:0;"><b>{{ $data_district }}</b></td>
                <td class="data-row-body" style="border-right:0; border-left:0;"></td>
                <td class="data-row-body" style="border-right:0; border-left:0;"></td>
                <td class="data-row-body" style="border-right:0; border-left:0;"></td>
                <td class="data-row-body" style="border-right:0; border-left:0;"></td>
                <td class="data-row-body" style="border-right:0; border-left:0;"></td>
                <td class="data-row-body" style="border-right:0; border-left:0;"></td>
                <td class="data-row-body" style="border-right:0; border-left:0;"></td>
                <td class="data-row-body" style="border-left:0;"></td>

              </tr>

              @foreach ($global_mills_all as $data_mill)

                @if ($key_district == $data_mill->district)

                <?php
                  
                  $num_of_sa = 0;

                  $quantity_mt = 0.000;
                  $pol = 0.00;
                  $mois = 0.00;
                  $sf = 0.00;
                  $ash = 0.00;
                  $color_whole = 0.00;
                  $color_affined = 0.00;
                  $grain_size = 0.00;

                  $sugar_services_static = __static::sugar_services();

                  foreach ($sugar_analysis_list as $data_sa) {

                    if ($data_sa->mill_id == $data_mill->mill_id) {
                      
                      $num_of_sa++;


                      /** Quantity **/
                      if (isset($data_sa->quantity_mt)) {
                        $quantity_mt += $data_sa->quantity_mt;
                      }


                      /** Polarization **/
                      $pol_instance = $data_sa->sugarAnalysisParameter()->findBySugarServiceId($sugar_services_static['pol']);

                      if (!empty($pol_instance)) {
                        if (isset($pol_instance->result_dec)) {
                          $pol =+ $pol_instance->result_dec;
                        }
                      }


                      /** Moisture **/
                      $mois_instance = $data_sa->sugarAnalysisParameter()->findBySugarServiceId($sugar_services_static['mois']);
                      
                      if (!empty($mois_instance)) {
                        if (isset($mois_instance->moisture_result_dec)) {
                          $mois =+ $mois_instance->moisture_result_dec;
                        }
                      }


                      /** Safety Factor **/
                      $sf_instance = $data_sa->sugarAnalysisParameter()->findBySugarServiceId($sugar_services_static['mois']);
                      
                      if (!empty($sf_instance)) {
                        if (isset($sf_instance->moisture_sf_dec)) {
                          $sf =+ $sf_instance->moisture_sf_dec;
                        }
                      }


                      /** Ash **/
                      $ash_instance = $data_sa->sugarAnalysisParameter()->findBySugarServiceId($sugar_services_static['ash']);
                      
                      if (!empty($ash_instance)) {
                        if (isset($ash_instance->result_dec)) {
                          $ash =+ $ash_instance->result_dec;  
                        }
                      }


                      /** Color of Whole **/
                      $color_whole_instance = $data_sa->sugarAnalysisParameter()->findBySugarServiceId($sugar_services_static['colorW']);
                      
                      if (!empty($color_whole_instance)) {
                        if (isset($color_whole_instance->result_dec)) {
                          $color_whole =+ $color_whole_instance->result_dec;  
                        }
                      }


                      /** Color of Affined **/
                      $color_affined_instance = $data_sa->sugarAnalysisParameter()->findBySugarServiceId($sugar_services_static['colorA']);
                      
                      if (!empty($color_affined_instance)) {
                        if (isset($color_affined_instance->result_dec)) {
                          $color_affined =+ $color_affined_instance->result_dec;  
                        }
                      }


                      /** Grain Size **/
                      $grain_size_instance = $data_sa->sugarAnalysisParameter()->findBySugarServiceId($sugar_services_static['grainSize']);
                      
                      if (!empty($grain_size_instance)) {
                        if (isset($grain_size_instance->result_dec)) {
                          $grain_size =+ $grain_size_instance->result_dec;  
                        }
                      }

                    
                    }

                  }


                ?>


                <tr>

                  <td class="data-row-body-mill-name">
                    {{ $data_mill->short_name }}
                  </td>

                  {{-- Quantity in MT --}}
                  <td class="data-row-body">
                    {{ number_format($quantity_mt, 3) }}
                  </td>

                  {{-- Polarization --}}
                  <td class="data-row-body">
                    @if ($pol != 0 && $num_of_sa != 0)
                      {{ number_format($pol / $num_of_sa, 2) }}  
                    @else
                      0.00
                    @endif
                  </td>

                  {{-- Moisture --}}
                  <td class="data-row-body">
                    @if ($mois != 0 && $num_of_sa != 0)
                      {{ number_format($mois / $num_of_sa, 2) }}
                    @else
                      0.00  
                    @endif
                  </td>

                  {{-- Safety Factor --}}
                  <td class="data-row-body">
                    @if ($sf != 0 && $num_of_sa != 0)
                      {{ number_format($sf / $num_of_sa, 2) }}  
                    @else
                      0.00
                    @endif
                  </td>

                  {{-- Ash --}}
                  <td class="data-row-body">
                    @if ($ash != 0 && $num_of_sa != 0)
                      {{ number_format($ash / $num_of_sa, 2) }} 
                    @else
                      0.00 
                    @endif
                  </td>

                  {{-- Color Whole --}}
                  <td class="data-row-body">
                    @if ($color_whole != 0 && $num_of_sa != 0)
                      {{ number_format($color_whole / $num_of_sa, 2) }}  
                    @else
                      0.00
                    @endif
                  </td>

                  {{-- Color Affined --}}
                  <td class="data-row-body">
                    @if ($color_affined != 0 && $num_of_sa != 0)
                      {{ number_format($color_affined / $num_of_sa, 2) }}  
                    @else
                      0.00
                    @endif
                  </td>

                  {{-- Grain Size --}}
                  <td class="data-row-body">
                    @if ($grain_size != 0 && $num_of_sa != 0)
                      {{ number_format($grain_size / $num_of_sa, 2) }}  
                    @else
                      0.00
                    @endif
                  </td>

                </tr>
                  
                @endif
                
              @endforeach

            @endforeach

          </tbody>

        </table>

      </div>
      
    </div>
    


  </div>

</body>

</html>

