<?php

  $table_sessions = [ Session::get('SUGAR_ANALYSIS_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                      ];

?>




@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Sugar Analysis List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_analysis.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.sugar_analysis.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('sample_no', 'Sample No.')</th>
            <th>@sortablelink('origin', 'Origin')</th>
            <th>@sortablelink('week_ending', 'Week Ending')</th>
            <th>@sortablelink('status', 'Status')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($sugar_analysis as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td>{{ $data->sample_no }}</td>
              <td>{{ $data->origin }}</td>
              <td>{{ __dataType::date_parse($data->week_ending, 'F d,Y') }}</td>
              <td>
                @if($data->status == "PENDING")
                  <span class="label label-warning">PENDING</span>
                @elseif($data->status == "ANALYZED")
                  <span class="label label-success">ANALYZED</span> 
                @endif
              </td>
              <td>
                <a href="{{ route('dashboard.sugar_analysis.edit', $data->slug) }}" type="button" class="btn btn-default btn-sm">Fill Results</a>
                <a href="{{ route('dashboard.sugar_analysis.show', $data->slug) }}" type="button" class="btn btn-default btn-sm">Print</a>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($sugar_analysis->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($sugar_analysis) !!}
        {!! $sugar_analysis->appends($appended_requests)!!}
      </div>

    </div>

  </section>

@endsection




@section('scripts')

  <script type="text/javascript">

    {{-- UPDATE TOAST --}}
    @if(Session::has('SUGAR_ANALYSIS_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('SUGAR_ANALYSIS_UPDATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection