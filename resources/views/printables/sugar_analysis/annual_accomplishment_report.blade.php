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
/*
      -webkit-print-color-adjust: exact; 
      background-color: #78B681 !important;*/

    }

    .data-row-head{

      text-align: center;
      padding:5px;
      font-size:14px;
      font-weight: bold;
      
    }

    .data-row-body{

      padding:5px;
      font-size:12px;
      
    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  <div class="wrapper">




    {{-- HEADER --}}
    <div class="row">
      <div class="col-sm-12" style="text-align: center;">
        <span style="font-size:12px; font-weight:bold;">HIGHLIGHTS OF ACCOMPLISHMENT REPORT</span><br>
        <span style="font-size:12px; font-weight:bold;">{{ __dataType::date_parse(Request::get('date_from'), 'Y') }}</span>
      </div>
    </div>




    {{-- Body --}}
    <div class="row" style="margin-top:20px;">
      
      <div class="col-sm-12">

        <p style="font-size:12px; text-indent: 40px;">
          The Sugar Reference Unit was in the supervision of Research Development and Extention Department and by the implementation of SRA's Organizational Strenthening was transferred to the supervision of Regulation Department as Laboratory Services on the fourth quarter of 2018.
        </p>

        <p style="font-size:12px; text-indent: 40px;">
          Maintenance and operations of the Laboratory Services for the quality of weekly raw sugar composite samples and quarterly molasses compositer samples from mills in the Visayas. The samples of raw sugar, muscovado, molasses and cane juice for export and domestic market received and analyzed from millers, planters, traders, surveyors, distillers and other walk-in clients for {{ __dataType::date_parse(Request::get('date_from'), 'Y') }} are as follows:
        </p>

      </div>

      <div class="col-sm-12" style="text-align: center;">
          
          <span style="font-size:12;">ANNUAL REPORT</span><br>
          <span style="font-size:12;">
            JANUARY - DECEMBER {{ __dataType::date_parse(Request::get('date_from'), 'Y') }}
          </span>

      </div>

    </div>

    {{-- TABLE --}}
    <table style="margin-left:10px; margin-top:20px; margin-right:10px; border:solid 1px;">
      
      <thead>

          <td class="data-row-head">Programs / Activities</td>
          <td class="data-row-head">1st <br>Quarter</td>
          <td class="data-row-head">2nd <br>Quarter</td>
          <td class="data-row-head">3rd <br>Quarter</td>
          <td class="data-row-head">4th <br>Quarter</td>
          <td class="data-row-head">Total</td>

      </thead>
            
      {{-- @foreach ($sa->sugarAnalysisParameter as $data) --}}

        <tbody>


          <tr>

            <td class="data-row-body">
              Samples received and analyzed<br>
              RAW SUGAR
              <ul>
                <li>a. Mills</li>
                <li>b. Traders/walk-in clients</li>
              </ul> 
            </td>

          </tr>


          <tr>
            <td class="data-row-body">
              MOLASSES
              <ul>
                <li>a. Mills</li>
                <li>b. Traders/walk-in clients</li>
              </ul> 
            </td>
          </tr>


          <tr>
            <td class="data-row-body">
              MUSCOVADO
            </td>
          </tr>


          <tr>
            <td class="data-row-body">
              CANE JUICE
            </td>
          </tr>


          <tr>
            <td class="data-row-body">
              Total Samples
            </td>
          </tr>


          <tr>
            <td class="data-row-body">
              REVENUE GENERATED
              <ul>
                <li>a. Mills</li>
                <li>b. Traders/walk-in clients</li>
              </ul> 
            </td>
          </tr>


          <tr>
            <td class="data-row-body">
              Total Revenue
            </td>
          </tr>


          <tr>
            <td class="data-row-body">
              No. of Regulatory Documents Issued
            </td>
          </tr>



        </tbody>

      {{-- @endforeach --}}

    </table>


  </div>

</body>

</html>

