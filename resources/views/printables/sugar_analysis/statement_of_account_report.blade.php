<?php
  
  $sugar_samples_static = __static::sugar_samples();

?>

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

        <span style="font-size:14px; font-weight:bold;">STATEMENT OF ACCOUNT</span><br>

        <span style="font-size:14px;">
            
            @if (Request::get('soam_sugar_sample_id') == $sugar_samples_static['rawSugar'])
               Raw Sugar
            @elseif(Request::get('soam_sugar_sample_id') == $sugar_samples_static['muscovado'])
               Muscovado
            @elseif(Request::get('soam_sugar_sample_id') == $sugar_samples_static['molasses'])
               Molasses
            @elseif(Request::get('soam_sugar_sample_id') == $sugar_samples_static['cja'])
               Cane Juice
            @endif

            Analysis Fee

        </span><br>

        <span style="font-size:14px; font-weight:bold;">
          Crop Year {{ __dataType::date_parse(Request::get('soam_we_from'), "Y") .' - '. __dataType::date_parse(Request::get('soam_we_to'), "Y") }}
        </span><br>

      </div>
    </div>




    {{-- Mill Info --}}
    <div class="row" style="margin-top:20px;">
      <div class="col-md-12">
        <div class="col-sm-12">
          <span style="font-size:12px;">Mill / Company : {{ $mill->name }}</span><br>
          <span style="font-size:12px;">Address : {{ $mill->address }}</span><br>
        </div>
      </div>
    </div>




    {{-- TABLE --}}
    <div class="row" style="margin-top:20px;">
     
      <div class="col-md-12" style="text-align: center;">
        <span style="font-size:14px; font-weight: bold;">DESCRIPTION</span><br>
      </div>

      <div class="col-md-12" style="position: center;">

        <table style="margin-left:10px; margin-right:10px; border:solid 1px; margin :auto;">
      
          <thead>

              <td class="data-row-head" >No.</td>
              <td class="data-row-head" style="width:150px;">Date</td>
              <td class="data-row-head" style="width:150px;">Entry No.</td>
              <td class="data-row-head" style="width:150px;">Week Ending</td>
              <td class="data-row-head" style="width:150px;">Charges (PHP)</td>

          </thead>
                
          <tbody>

            @foreach ($sugar_analysis_list as $key => $data)

              <tr>

                <td class="data-row-body">{{ $key + 1 }}</td>

                <td class="data-row-body">{{ __dataType::date_parse($data->date, "m/d/Y") }}</td>

                <td class="data-row-body">{{ $data->sample_no }}</td>

                <td class="data-row-body">{{ __dataType::date_parse($data->week_ending, "m/d/Y") }}</td>

                <td class="data-row-body">{{ number_format($data->total_price, 2) }}</td>

              </tr>

            @endforeach

              <tr>

                <td class="data-row-body"></td>

                <td class="data-row-body"></td>

                <td class="data-row-body"></td>

                <td class="data-row-body"><b>TOTAL</b></td>

                <td class="data-row-body">{{ number_format($sugar_analysis_list->sum('total_price'), 2) }}</td>

              </tr>

          </tbody>

        </table>

      </div>
      
    </div>
    


  </div>

</body>

</html>

