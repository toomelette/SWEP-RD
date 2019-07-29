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
            '3', 'year', 'text', 'Year', 'Year', old('year'), $errors->has('year'), $errors->first('year'), ''
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
            '3', 'mill_id', 'Milling Company *', old('mill_id'), $global_mills_all, 'mill_id', 'name', $errors->has('mill_id'), $errors->first('mill_id'), 'select2', ''
          ) !!}

          {!! __form::select_dynamic(
            '3', 'sugar_sample_id', 'Kind of Sample *', old('sugar_sample_id'), $global_sugar_samples_all, 'sugar_sample_id', 'name', $errors->has('sugar_sample_id'), $errors->first('sugar_sample_id'), 'select2', ''
          ) !!}

          {!! __form::datepicker(
            '3', 'we_from',  'Week Ending from *', old('we_from'), $errors->has('we_from'), $errors->first('we_from')
          ) !!}

          {!! __form::datepicker(
            '3', 'we_to',  'Week Ending to *', old('we_to'), $errors->has('we_to'), $errors->first('we_to')
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>




    {{-- Summary Of Sugar Analyses --}}
    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Summary Of Sugar Analyses</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_analysis.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="t" value="SOSA">

          {!! __form::select_dynamic(
            '3', 'sugar_sample_id', 'Kind of Sample *', old('sugar_sample_id'), $global_sugar_samples_all, 'sugar_sample_id', 'name', $errors->has('sugar_sample_id'), $errors->first('sugar_sample_id'), 'select2', ''
          ) !!}

          {!! __form::datepicker(
            '3', 'we_from',  'Week Ending from *', old('we_from'), $errors->has('we_from'), $errors->first('we_from')
          ) !!}

          {!! __form::datepicker(
            '3', 'we_to',  'Week Ending to *', old('we_to'), $errors->has('we_to'), $errors->first('we_to')
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>





  </section>

@endsection