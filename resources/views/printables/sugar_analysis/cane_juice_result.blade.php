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
      padding:2px;
      font-size:12px;
      font-weight: bold;
      
    }

    .data-row-body{

      text-align: center;
      padding:5px;
      font-size:12px;
      
    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  <div class="wrapper">




    {{-- HEADER --}}
    <div class="row" style="padding:10px;">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">
        <div class="col-sm-3">
          <img src="{{ asset('images/sra.png') }}" style="width:130px;">
        </div>
        <div class="col-sm-8" style="text-align: center; padding-right:150px;">
          <span style="font-size:12px;">Republic of the Philippines</span><br>
          <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span style="font-size:12px;">North Avenue, Diliman, Quezon City</span><br>
          <span style="font-size:12px;">(034)433-4962 / 435-3758, FAX(034)435-3758</span><br>
          <span style="font-size:12px;">TIN 000784-336-000</span>
        </div>
        <div class="col-sm-1"></div>
      </div>

      <div class="col-sm-2"></div>

      <div class="col-sm-12" style="border-top: solid 1px; margin-top: 15px;"></div>

      <div class="col-sm-12" style="text-align: center; margin-top: 15px;">
          <span style="font-size:14px; font-weight: bold;">CANE JUICE ANALYSIS</span>
      </div>

    </div>



    {{-- TABLE --}}
    <table style="margin-left:10px; margin-right:10px; border:solid 1px;">
      
      <thead>
  
        <td class="data-row-head" style="width:150;">ENTRY NO.</td>
        <td class="data-row-head" style="width:150px;">DATE SAMPLED</td>
        <td class="data-row-head" style="width:150px;">DATE ANALYZED</td>
        <td class="data-row-head" style="width:150px;">VARIETY</td>
        <td class="data-row-head" style="width:150px;">HACIENDA</td>
        <td class="data-row-head" style="width:150px;">CORRECTED BRIX</td>
        <td class="data-row-head" style="width:150px;">% POL</td>
        <td class="data-row-head" style="width:150px;">PURITY</td>
        <td class="data-row-head" style="width:150px;">REMARKS PSTC/LkgTC</td>

      </thead>
            
      @foreach ($sa->caneJuiceAnalysis->sortBy('entry_no') as $data)

        <tbody>

          <td class="data-row-body">{{ $data->entry_no }}</td>
          <td class="data-row-body">{{ __dataType::date_parse($data->date_sampled, 'm/d/Y') }}</td>
          <td class="data-row-body">{{ __dataType::date_parse($data->date_analyzed, 'm/d/Y') }}</td>
          <td class="data-row-body">{{ $data->variety }}</td>
          <td class="data-row-body">{{ $data->hacienda }}</td>
          <td class="data-row-body">{{ $data->corrected_brix }}</td>
          <td class="data-row-body">{{ $data->polarization }}</td>
          <td class="data-row-body">{{ $data->purity }}</td>
          <td class="data-row-body">{{ $data->remarks }}</td>

        </tbody>

      @endforeach

    </table>





    {{-- FOOTER --}}
    <div class="row">

      <div class="col-sm-12" style="margin-left:-5px; margin-top:15px;">

        <div class="col-sm-12" style="font-style: italic; font-weight: bold;">
          <span>Note: This theoretical PSTC is higher by about 0.25 than actually milled in a sugar mill.</span>
        </div>

        <div class="col-sm-12" style="margin-top:10px; font-style: italic; font-weight: bold;">
          <span>Remarks: Analytical results based on juices of sugarcane as received and extracted by a miniature mill</span>
        </div>

        <div class="col-sm-12" style="margin-top: 20px;"></div>

        <div class="col-sm-1">
          <span>Charges</span>
        </div>

        <div class="col-sm-11">
          <span>: Php <b>{{ number_format($sa->total_price, 2) }}</b></span>
        </div>

        <div class="col-sm-1">
          <span>&nbsp;</span>
        </div>

        <div class="col-sm-11">
          <span>OR #</span>
        </div>

        <div class="col-sm-6" style="margin-top:20px;">
          <span>Certified Correct:</span>
        </div>

        <div class="col-sm-6" style="margin-top:20px;">
          <span>Noted by:</span>
        </div>

        <div class="col-sm-6" style="margin-top:40px;">
          <span><b>JANET C. DILAG, RCh</b></span><br>
          <span>SRS II - LABORATORY SERVICES, VISAYAS</span><br>
          <span>CHEMIST LICENSE NO. 6302</span>
        </div>

        <div class="col-sm-6" style="margin-top:40px;">
          <span><b>{{ Request::get('nb') }}</b></span><br>
          <span>{{ Request::get('p') }}</span><br>
          <span>{{ Request::get('d') }}</span>
        </div>

      </div>
    
    </div>




  </div>

</body>

</html>
