@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Sugar Analysis Reports</h1>
  </section>

  <section class="content">



    {{-- Annual Accomplishment Report --}}
    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Annual Revenue Accomplishment Report</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_analysis.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="t" value="ARAR">

          {!! __form::textbox(
            '3', 'arar_year', 'text', 'Year', 'Year', old('arar_year'), $errors->has('arar_year'), $errors->first('arar_year'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>




    {{-- Statement of Account Per mill --}}
    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Statement of Account per Mill / Company</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_analysis.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="t" value="SOAM">

          {!! __form::select_dynamic(
            '3', 'soam_mill_id', 'Milling Company *', old('soam_mill_id'), $global_mills_all, 'mill_id', 'name', $errors->has('soam_mill_id'), $errors->first('soam_mill_id'), 'select2', ''
          ) !!}

          {!! __form::select_dynamic(
            '3', 'soam_sugar_sample_id', 'Kind of Sample *', old('soam_sugar_sample_id'), $global_sugar_samples_all, 'sugar_sample_id', 'name', $errors->has('soam_sugar_sample_id'), $errors->first('soam_sugar_sample_id'), 'select2', ''
          ) !!}

          {!! __form::datepicker(
            '3', 'soam_we_from',  'Week Ending from *', old('soam_we_from'), $errors->has('soam_we_from'), $errors->first('soam_we_from')
          ) !!}

          {!! __form::datepicker(
            '3', 'soam_we_to',  'Week Ending to *', old('soam_we_to'), $errors->has('soam_we_to'), $errors->first('soam_we_to')
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>




    {{-- Summary Of Raw Sugar Analyses --}}
    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Summary Of Raw Sugar Analyses</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_analysis.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="t" value="SOSA">

          {!! __form::datepicker(
            '3', 'sosa_we_from',  'Week Ending from *', old('sosa_we_from'), $errors->has('sosa_we_from'), $errors->first('sosa_we_from')
          ) !!}

          {!! __form::datepicker(
            '3', 'sosa_we_to',  'Week Ending to *', old('sosa_we_to'), $errors->has('sosa_we_to'), $errors->first('sosa_we_to')
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>





  </section>

@endsection