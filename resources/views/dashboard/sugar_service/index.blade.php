<?php

  $table_sessions = [ Session::get('SUGAR_SERVICE_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                      ];

?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Manage Laboratory Services</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.sugar_service.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.sugar_service.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('seq_no', 'Sequence No.')</th>
            <th>@sortablelink('name', 'Name')</th>
            <th>@sortablelink('standard', 'Standards')</th>
            <th>@sortablelink('price', 'Price')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($sugar_services as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td>{{ $data->seq_no }}</td>
              <td>{{ $data->name }}</td>
              <td>{{ $data->standard_str }}</td>
              <td>{{ number_format($data->price, 2) }}</td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.sugar_service.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.sugar_service.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($sugar_services->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($sugar_services) !!}
        {!! $sugar_services->appends($appended_requests)!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('ss_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('ss_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('SUGAR_SERVICE_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('SUGAR_SERVICE_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('SUGAR_SERVICE_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('SUGAR_SERVICE_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection