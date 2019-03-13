<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Employee Service Record</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">
      
    .std_div{

      border-bottom: solid 1px; 
      font-size: 11px; 
      line-height: 12px; 
      font-weight: bold;
      margin-bottom: 15px;
      
    }
      
    .std_font_size{
 
      font-size: 12px;
      
    }

  </style>

</head> 
  
<body onload="window.print();" onafterprint="window.close()" style="padding:5px;">

  <div class="wrapper" style="overflow:hidden !important;">


    <div class="row" style="margin-bottom: 20px;">
      <div class="col-md-1"></div>
      <div class="col-md-10" style="text-align: center;">
        <span style="font-weight:bold; font-size:15px;">Sugar Regulatory Administration</span><br>
        <p style="font-size:15px; margin-top: -5px; margin-bottom: -10px;">Sugar Reference Unit</p><br>
        <span style="font-weight:bold; font-size:15px; text-decoration: underline;">ACKNOWLEDGEMENT RECEIPT</span>
      </div>
      <div class="col-md-1"></div>
    </div>


    {{-- Fields --}}
    <div class="row" style="padding-bottom: 10px;">

      <div class="col-sm-8" style="margin-bottom: 15px;">
        &nbsp;
      </div>

      <div class="col-sm-4">
        <div class="col-sm-3 std_font_size">
          Date:
        </div>
        <div class="col-sm-9 std_div">
          {{ __dataType::date_parse($sugar_oop->date, 'F d,Y') }}
        </div>
      </div>

      <div class="col-sm-6">
        <div class="col-sm-5 std_font_size">
          Received From:
        </div>
        <div class="col-sm-7 std_div no-padding">
          {{ $sugar_oop->received_from }}
        </div>
      </div>

      <div class="col-sm-6">
        <div class="col-sm-5 std_font_size">
          Address:
        </div>
        <div class="col-sm-7 std_div no-padding" >
          {{ $sugar_oop->address }}
        </div>
      </div>

      <div class="col-sm-6">
        <div class="col-sm-5 std_font_size">
          Kind of Sample:
        </div>
        <div class="col-sm-7 std_div no-padding" >
          {{ $sugar_oop->sugar_sample }}
        </div>
      </div>

      <div class="col-sm-6">
        <div class="col-sm-5 std_font_size">
          Entry Number:
        </div>
        <div class="col-sm-7 std_div no-padding">
          {{ $sugar_oop->sample_no }}
        </div>
      </div>

      <div class="col-sm-6">
        <div class="col-sm-5 std_font_size">
          Kind of Analysis:
        </div>
        <div class="col-sm-7 std_div no-padding">
          @foreach ($sugar_oop->sugarAnalysisParameter as $data)
          {{ $data->sugar_service_name }}, 
          @endforeach
        </div>
      </div>

    </div>




    {{-- Body --}}
    <div class="row">

      <div class="col-sm-12 std_font_size" style="text-indent: 5%;">
        <p>Please pay to Sugar Regulatory Administration at our Treasury Division, Singcang, Bacolod City, the amount of </p>
      </div>

      <div class="col-sm-12 std_div" style="margin-bottom: 20px; text-align: center;">
        {{ $sugar_oop->total_price > 0 ? __dataType::num_to_words(150) . ' PESOS' : ''}}      
      </div>

      <div class="col-sm-12 std_font_size" style="margin-bottom: 10px;">
        <p style="font-weight: bold;">
          Pesos (PhP <span style="text-decoration: underline;">{{ number_format($sugar_oop->total_price, 2) }}</span>)
        </p>
      </div>

      <div class="col-sm-12 std_font_size" style="margin-bottom: 20px;">
        Note: No report of analysis will be release unless the amount due has been paid in advance, either on the time of sample submission, or before the report of the analysis is claimed. 
      </div>

    </div>




    {{-- Footer --}}
    <div class="row">


      <div class="col-sm-6" style="margin-bottom: 20px;">
        &nbsp;
      </div>


      <div class="col-sm-6" style="margin-bottom: 20px;">
        <div class="col-sm-4 std_font_size">
          Received by:
        </div>
        <div class="col-sm-8 std_div">
          {{ $sugar_oop->received_by }}
        </div>
      </div>


      <div class="col-sm-12 no-padding">
        <div class="col-sm-5" >
          <div class="col-sm-4 std_font_size">
            OR. No.
          </div>
          <div class="col-sm-8 std_div">
            &nbsp;
          </div>
        </div>
      </div>


      <div class="col-sm-12 no-padding">
        <div class="col-sm-5" >
          <div class="col-sm-4 std_font_size">
            Date:
          </div>
          <div class="col-sm-8 std_div">
            &nbsp;
          </div>
        </div>
      </div>


    </div>





  </div>


</body>
</html>

