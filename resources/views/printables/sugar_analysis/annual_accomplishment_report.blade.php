<?php
  
  $total_mill_rawSugar = $first_quarter_mill_rawSugar->count() + $second_quarter_mill_rawSugar->count() + $third_quarter_mill_rawSugar->count() + $fourth_quarter_mill_rawSugar->count(); 
  $total_walkin_rawSugar = $first_quarter_walkin_rawSugar->count() + $second_quarter_walkin_rawSugar->count() + $third_quarter_walkin_rawSugar->count() + $fourth_quarter_walkin_rawSugar->count(); 

  $total_mill_molasses = $first_quarter_mill_molasses->count() + $second_quarter_mill_molasses->count() + $third_quarter_mill_molasses->count() + $fourth_quarter_mill_molasses->count(); 
  $total_walkin_molasses = $first_quarter_walkin_molasses->count() + $second_quarter_walkin_molasses->count() + $third_quarter_walkin_molasses->count() + $fourth_quarter_walkin_molasses->count(); 

  $total_walkin_muscovado = $first_quarter_walkin_muscovado->count() + $second_quarter_walkin_muscovado->count() + $third_quarter_walkin_muscovado->count() + $fourth_quarter_walkin_muscovado->count(); 

  $total_walkin_caneJuice = $first_quarter_walkin_caneJuice->count() + $second_quarter_walkin_caneJuice->count() + $third_quarter_walkin_caneJuice->count() + $fourth_quarter_walkin_caneJuice->count(); 


  $total_first = $first_quarter_mill_rawSugar->count() + $first_quarter_walkin_rawSugar->count() + $first_quarter_mill_molasses->count() + $first_quarter_walkin_molasses->count() + $first_quarter_walkin_muscovado->count() + $first_quarter_walkin_caneJuice->count();
  $total_second = $second_quarter_mill_rawSugar->count() + $second_quarter_walkin_rawSugar->count() + $second_quarter_mill_molasses->count() + $second_quarter_walkin_molasses->count() + $second_quarter_walkin_muscovado->count() + $second_quarter_walkin_caneJuice->count();
  $total_third = $third_quarter_mill_rawSugar->count() + $third_quarter_walkin_rawSugar->count() + $third_quarter_mill_molasses->count() + $third_quarter_walkin_molasses->count() + $third_quarter_walkin_muscovado->count() + $third_quarter_walkin_caneJuice->count();
  $total_fourth = $fourth_quarter_mill_rawSugar->count() + $fourth_quarter_walkin_rawSugar->count() + $fourth_quarter_mill_molasses->count() + $fourth_quarter_walkin_molasses->count() + $fourth_quarter_walkin_muscovado->count() + $fourth_quarter_walkin_caneJuice->count();


  $total_annual = $total_first + $total_second + $total_third + $total_fourth;


  $total_revenue_first_mill = $first_quarter_mill_rawSugar->sum('total_price') + $first_quarter_mill_molasses->sum('total_price');
  $total_revenue_first_walkin = $first_quarter_walkin_rawSugar->sum('total_price') + $first_quarter_walkin_molasses->sum('total_price') + $first_quarter_walkin_muscovado->sum('total_price') + $first_quarter_walkin_caneJuice->sum('total_price');

  $total_revenue_second_mill = $second_quarter_mill_rawSugar->sum('total_price') + $second_quarter_mill_molasses->sum('total_price');
  $total_revenue_second_walkin = $second_quarter_walkin_rawSugar->sum('total_price') + $second_quarter_walkin_molasses->sum('total_price') + $second_quarter_walkin_muscovado->sum('total_price') + $second_quarter_walkin_caneJuice->sum('total_price');

  $total_revenue_third_mill = $third_quarter_mill_rawSugar->sum('total_price') + $third_quarter_mill_molasses->sum('total_price');
  $total_revenue_third_walkin = $third_quarter_walkin_rawSugar->sum('total_price') + $third_quarter_walkin_molasses->sum('total_price') + $third_quarter_walkin_muscovado->sum('total_price') + $third_quarter_walkin_caneJuice->sum('total_price');

  $total_revenue_fourth_mill = $fourth_quarter_mill_rawSugar->sum('total_price') + $fourth_quarter_mill_molasses->sum('total_price');
  $total_revenue_fourth_walkin = $fourth_quarter_walkin_rawSugar->sum('total_price') + $fourth_quarter_walkin_molasses->sum('total_price') + $fourth_quarter_walkin_muscovado->sum('total_price') + $fourth_quarter_walkin_caneJuice->sum('total_price');
  

  $total_revenue_mill =   $total_revenue_first_mill +   $total_revenue_second_mill +   $total_revenue_third_mill + $total_revenue_fourth_mill;
  $total_revenue_walkin =   $total_revenue_first_walkin +   $total_revenue_second_walkin +   $total_revenue_third_walkin + $total_revenue_fourth_walkin;


  $total_revenue_first = $total_revenue_first_mill + $total_revenue_first_walkin;
  $total_revenue_second = $total_revenue_second_mill + $total_revenue_second_walkin;
  $total_revenue_third = $total_revenue_third_mill + $total_revenue_third_walkin;
  $total_revenue_fourth = $total_revenue_fourth_mill + $total_revenue_fourth_walkin;


  $total_annual_revenue = $total_revenue_mill + $total_revenue_walkin;

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

      <div class="col-sm-12" style="margin-top: 15px;"></div>

      <div class="col-sm-12" style="text-align: center;">
        <span style="font-size:14px; font-weight:bold;">HIGHLIGHTS OF ACCOMPLISHMENT REPORT</span><br>
        <span style="font-size:14px; font-weight:bold;">{{ Request::get('arar_year') }}</span>
      </div>
    </div>




    {{-- Body --}}
    <div class="row" style="margin-top:20px;">
      
      <div class="col-sm-12">

        <p style="font-size:14px; text-indent: 40px;">
          The Sugar Reference Unit was in the supervision of Research Development and Extention Department and by the implementation of SRA's Organizational Strenthening was transferred to the supervision of Regulation Department as Laboratory Services on the fourth quarter of {{ Request::get('arar_year') }}.
        </p>

        <p style="font-size:14px; text-indent: 40px;">
          Maintenance and operations of the Laboratory Services for the quality of weekly raw sugar composite samples and quarterly molasses compositer samples from mills in the Visayas. The samples of raw sugar, muscovado, molasses and cane juice for export and domestic market received and analyzed from millers, planters, traders, surveyors, distillers and other walk-in clients for {{ Request::get('arar_year') }} are as follows:
        </p>

      </div>

      <div class="col-sm-12" style="text-align: center;">
          
          <span style="font-size:12;">ANNUAL REPORT</span><br>
          <span style="font-size:12;">
            JANUARY - DECEMBER {{ Request::get('arar_year') }}
          </span>

      </div>

    </div>

    {{-- TABLE --}}
    <table style="margin-left:10px; margin-top:20px; margin-right:10px; border:solid 1px;">
      
      <thead>

          <td class="data-row-head">Programs / Activities</td>
          <td class="data-row-head" style="width:100px;">1st <br>Quarter</td>
          <td class="data-row-head" style="width:100px;">2nd <br>Quarter</td>
          <td class="data-row-head" style="width:100px;">3rd <br>Quarter</td>
          <td class="data-row-head" style="width:100px;">4th <br>Quarter</td>
          <td class="data-row-head" style="width:100px;">Total</td>

      </thead>
            

        <tbody>

          {{-- Raw Sugar --}}
          <tr>

            <td class="data-row-body">
              Samples received and analyzed<br>
              RAW SUGAR
              <ul>
                <li>a. Mills</li>
                <li>b. Traders/walk-in clients</li>
              </ul> 
            </td>

            <td class="data-row-body">
              &nbsp;<br>
              &nbsp; {{ $first_quarter_mill_rawSugar->count() }} <br>
              &nbsp; {{ $first_quarter_walkin_rawSugar->count() }}
            </td>

            <td class="data-row-body">
              &nbsp;<br>
              &nbsp; {{ $second_quarter_mill_rawSugar->count() }} <br>
              &nbsp; {{ $second_quarter_walkin_rawSugar->count() }}
            </td>

            <td class="data-row-body">
              &nbsp;<br>
              &nbsp; {{ $third_quarter_mill_rawSugar->count() }} <br>
              &nbsp; {{ $third_quarter_walkin_rawSugar->count() }}
            </td>

            <td class="data-row-body">
              &nbsp;<br>
              &nbsp; {{ $fourth_quarter_mill_rawSugar->count() }} <br>
              &nbsp; {{ $fourth_quarter_walkin_rawSugar->count() }}
            </td>

            <td class="data-row-body">
              &nbsp;<br>
              &nbsp; {{ $total_mill_rawSugar }} <br>
              &nbsp; {{ $total_walkin_rawSugar }}
            </td>

          </tr>


          {{-- Molasses --}}
          <tr>

            <td class="data-row-body">
              MOLASSES
              <ul>
                <li>a. Mills</li>
                <li>b. Traders/walk-in clients</li>
              </ul> 
            </td>

            <td class="data-row-body">
              &nbsp; {{ $first_quarter_mill_molasses->count() }} <br>
              &nbsp; {{ $first_quarter_walkin_molasses->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $second_quarter_mill_molasses->count() }} <br>
              &nbsp; {{ $second_quarter_walkin_molasses->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $third_quarter_mill_molasses->count() }} <br>
              &nbsp; {{ $third_quarter_walkin_molasses->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $fourth_quarter_mill_molasses->count() }} <br>
              &nbsp; {{ $fourth_quarter_walkin_molasses->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_mill_molasses }} <br>
              &nbsp; {{ $total_walkin_molasses }}
            </td>

          </tr>


          <tr>

            <td class="data-row-body">
              MUSCOVADO
            </td>

            <td class="data-row-body">
              &nbsp; {{ $first_quarter_walkin_muscovado->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $second_quarter_walkin_muscovado->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $third_quarter_walkin_muscovado->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $fourth_quarter_walkin_muscovado->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_walkin_muscovado }}
            </td>

          </tr>


          <tr>

            <td class="data-row-body">
              CANE JUICE
            </td>

            <td class="data-row-body">
              &nbsp; {{ $first_quarter_walkin_caneJuice->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $second_quarter_walkin_caneJuice->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $third_quarter_walkin_caneJuice->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $fourth_quarter_walkin_caneJuice->count() }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_walkin_caneJuice }}
            </td>

          </tr>


          <tr>

            <td class="data-row-body">
              Total Samples
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_first }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_second}}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_third }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_fourth }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_annual }}
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

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_first_mill, 2) }}<br>
              &nbsp; {{ number_format($total_revenue_first_walkin, 2) }}<br>
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_second_mill, 2) }}<br>
              &nbsp; {{ number_format($total_revenue_second_walkin, 2) }}<br>
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_third_mill, 2) }}<br>
              &nbsp; {{ number_format($total_revenue_third_walkin, 2) }}<br>
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_fourth_mill, 2) }}<br>
              &nbsp; {{ number_format($total_revenue_fourth_walkin, 2) }}<br>
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_mill, 2) }}<br>
              &nbsp; {{ number_format($total_revenue_walkin, 2) }}
            </td>

          </tr>


          <tr>

            <td class="data-row-body">
              Total Revenue
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_first, 2) }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_second, 2) }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_third, 2) }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_revenue_fourth, 2) }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ number_format($total_annual_revenue, 2) }}
            </td>

          </tr>


          <tr>

            <td class="data-row-body">
              No. of Regulatory Documents Issued
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_first }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_second}}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_third }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_fourth }}
            </td>

            <td class="data-row-body">
              &nbsp; {{ $total_annual }}
            </td>

          </tr>



        </tbody>
        

    </table>


  </div>

</body>

</html>

