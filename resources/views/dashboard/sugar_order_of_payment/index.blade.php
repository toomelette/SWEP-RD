<?php

  $table_sessions = [];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),

                        'ss' => Request::get('ss'),
                        'df' => Request::get('df'),
                        'dt' => Request::get('dt'),
                      ];
                      
?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Manage Order of Payments</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_order_of_payment.index') }}">


      {{-- Advance Filters --}}
      {!! __html::filter_open() !!}

        {!! __form::select_dynamic_for_filter(
          '3', 'ss', 'Kind Of Sample', old('ss'), $global_sugar_samples_all, 'sugar_sample_id', 'name', 'submit_soop_filter', '', ''
        ) !!}

        <div class="col-md-12 no-padding">
          
          <h5>Date Filter : </h5>

          {!! __form::datepicker('3', 'df',  'From', old('df'), '', '') !!}

          {!! __form::datepicker('3', 'dt',  'To', old('dt'), '', '') !!}

          <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

        </div>

      {!! __html::filter_close('submit_soop_filter') !!}



    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.sugar_order_of_payment.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('sample_no', 'Sample No.')</th>
            <th>@sortablelink('sugarSample.name', 'Kind of Sample')</th>
            <th>@sortablelink('received_from', 'Received From')</th>
            <th>@sortablelink('date', 'Date')</th>
            <th>@sortablelink('received_by', 'Received By')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($sugar_oops as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td>{{ $data->sample_no }}</td>
              <td>{{ optional($data->sugarSample)->name }}</td>
              <td>{{ $data->received_from }}</td>
              <td>{{ __dataType::date_parse($data->date, 'F d,Y') }}</td>
              <td>{{ $data->received_by }}</td>
              <td> 
                <select id="action" class="form-control input-md" style="font-size:15px;">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.sugar_order_of_payment.show', $data->slug) }}">Print</option>
                  <option data-type="1" data-url="{{ route('dashboard.sugar_order_of_payment.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.sugar_order_of_payment.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($sugar_oops->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($sugar_oops) !!}
        {!! $sugar_oops->appends($appended_requests)!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('sugar_oop_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('sugar_oop_delete') !!}

    {{-- DELETE TOAST --}}
    @if(Session::has('SUGAR_OOP_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('SUGAR_OOP_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection