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
      font-size:14px;
      font-weight: bold;
      
    }

    .data-row-body{

      text-align: center;
      padding:5px;
      font-size:14  px;
      
    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  <div class="wrapper">




    {{-- HEADER --}}
    <div class="row" style="padding:10px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
        <div class="col-sm-3">
          <img src="{{ asset('images/sra.png') }}" style="width:130px;">
        </div>
        <div class="col-sm-8" style="text-align: center; padding-right:125px;">
          <span style="font-size:12px;">Republic of the Philippines</span><br>
          <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span style="font-size:12px;">North Avenue, Diliman, Quezon City</span><br>
          <span style="font-size:12px;">(034)433-4962 / 435-3758, FAX(034)435-3758</span><br>
          <span style="font-size:12px;">TIN 000784-336-000</span>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <div class="col-md-1"></div>
    </div>




    {{-- Body --}}
    <div class="row" style="margin-top:5px; border-top:solid 1px;">

      <div class="col-md-12" style="text-align:center; margin-top:5px;">
        @if ($sa->sugar_sample_id == "SS1003")
          <span style="font-size:15px; font-weight: bold;">MUSCOVADO SUGAR QUALITY TEST CERTIFICATE</span>
        @elseif($sa->sugar_sample_id == "SS1004")
          <span style="font-size:15px; font-weight: bold;">QUALITY TEST ON MOLASSES</span>
        @else
          <span style="font-size:15px; font-weight: bold;">RAW SUGAR QUALITY TEST CERTIFICATE</span>
        @endif
      </div>



      <div class="col-sm-12" style="margin-top:10px;">  
        <div class="col-sm-4">
          <span>DATE</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ __dataType::date_parse($sa->date, 'F d, Y') }}</p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>SAMPLE NO.</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ $sa->sample_no }}</p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>ORIGIN</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ $sa->origin }}</p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>ADDRESS</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ $sa->address }}</p>
        </div>
      </div>




      @if ($sa->sugar_sample_id == "SS1003")

        <div class="col-sm-12" style="margin-top:5px;">  
          <div class="col-sm-4">
            <span>CODE</span>
          </div>
          <div class="col-sm-8">
            <p>: {{ $sa->code }}</p>
          </div>
        </div>

      @else

        <div class="col-sm-12" style="margin-top:5px;">  
          <div class="col-sm-4">
            <span>QUANTITY</span>
          </div>
          <div class="col-sm-8">
            <p>: {{ $sa->quantity }}</p>
          </div>
        </div>
        
      @endif

      @if ($sa->sugar_sample_id == "SS1004")

        <div class="col-sm-12" style="margin-top:-10px;">  
          <div class="col-sm-4">
            <span>SOURCE</span>
          </div>
          <div class="col-sm-8">
            <p>: {{ $sa->source }}</p>
          </div>
        </div>

      @endif

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>WEEK ENDING</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ __dataType::date_parse($sa->week_ending, 'F d, Y') }}</p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>DATE SAMPLED</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ __dataType::date_parse($sa->date_sampled, 'F d, Y') }}</p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>DATE SUBMITTED</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ __dataType::date_parse($sa->date_submitted, 'F d, Y') }}</p>
        </div>
      </div>

      <div class="col-sm-12" style="margin-top:-10px;">  
        <div class="col-sm-4">
          <span>DATE ANALYZED</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ __dataType::date_scope($sa->date_analyzed_from, $sa->date_analyzed_to) }}</p>
        </div>
      </div>



      <div class="col-sm-12" style="margin-top:5px;">  
        <div class="col-sm-4">
          <span>DESCRIPTION OF SAMPLE</span>
        </div>
        <div class="col-sm-8">
          <p>: {{ $sa->description }}</p>
        </div>
      </div>

    </div>





    {{-- TABLE --}}
    <table style="margin-left:10px; margin-right:10px; border:solid 1px;">
      
      <thead>
  
        <td class="data-row-head" style="width:350px;">PARAMETERS</td>
        <td class="data-row-head" style="width:150px;">RESULTS</td>
        <td class="data-row-head" style="width:150px;">STANDARDS</td>
        <td class="data-row-head" style="width:150px;">ASSESSMENT</td>

      </thead>
            
      @foreach ($sa->sugarAnalysisParameter as $data)

        <tbody>

          <td class="data-row-body">{{ $data->name }}</td>
          <td class="data-row-body">{{ $data->result }}</td>
          <td class="data-row-body">{{ $data->standard }}</td>
          <td class="data-row-body">{{ $data->assessment }}</td>

        </tbody>

      @endforeach

    </table>





    {{-- FOOTER --}}
    <div class="row">

      <div class="col-sm-12" style="margin-left:-5px; margin-top:10px;">

        <div class="col-sm-2">
          <span>Charges</span>
        </div>

        <div class="col-sm-10">
          <span>: Php <b>{{ number_format($sa->total_price, 2) }}</b></span>
        </div>

        <div class="col-sm-2">
          <span>&nbsp;</span>
        </div>

        <div class="col-sm-10">
          <span>OR #</span>
        </div>

        <div class="col-sm-6" style="margin-top:30px;">
          <span>Certified Correct:</span>
        </div>

        <div class="col-sm-6" style="margin-top:30px;">
          <span>Noted by:</span>
        </div>

        <div class="col-sm-6" style="margin-top:50px;">
          <span><b>JANET C. DILAG, RCh</b></span><br>
          <span>SRS II - LABORATORY SERVICES, VISAYAS</span><br>
          <span>CHEMIST LICENSE NO. 6302</span>
        </div>

        <div class="col-sm-6" style="margin-top:50px;">
          <span><b>{{ Request::get('nb') }}</b></span><br>
          <span>{{ Request::get('p') }}</span><br>
          <span>{{ Request::get('d') }}</span>
        </div>

      </div>
    
    </div>




  </div>

</body>

</html>

