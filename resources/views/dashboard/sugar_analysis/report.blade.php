@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Sugar Analysis Reports</h1>
  </section>

  <section class="content">




    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Annual Accomplishment Report</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_analysis.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="t" value="aar">

          {!! __form::textbox(
            '3', 'year', 'text', 'Year', 'Year', old('year'), $errors->has('year'), $errors->first('year'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>


  </section>

@endsection