<?php
  
  $sugar_samples_static = __static::sugar_samples();
  $sugar_services_static = __static::sugar_services();

?>

@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Fill Up Results</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.sugar_analysis.index', 'dashboard.sugar_analysis.show']) !!}
    </div>
</section>

<section class="content">


  <div class="col-md-12">

    <div class="box">
      
      <div class="box-header with-border">
        <h3 class="box-title">Results</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>


      <div class="box-body">


        {{-- Set OR No. Form --}}
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Set OR No.</b></h3>
            </div>
            
            <form method="POST" action="{{ route('dashboard.sugar_analysis.set_or_no', $sugar_analysis->slug) }}">

            @csrf

              <div class="box-body">

                @csrf
                
                {!! __form::textbox(
                   '3', 'or_no', 'or_no', 'OR No. *', 'OR No.', old('or_no') ? old('or_no') : $sugar_analysis->or_no, $errors->has('or_no'), $errors->first('or_no'), ''
                ) !!}

                <div class="col-md-2" style="margin-top: 25px;">
                  <button type="submit" class="btn btn-default">Submit <i class="fa fa-fw fa-save"></i></button>
                </div>

              </div> 
              
            </form>
          </div>
        </div>



        @if(!empty($sugar_analysis->or_no))

          <form method="POST" action="{{ route('dashboard.sugar_analysis.update', $sugar_analysis->slug) }}">

              @csrf

              <input name="_method" value="PUT" type="hidden">
              
              <div class="col-md-5">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Form</b></h3>
                  </div>
                  
                  <div class="box-body">

                    <div class="col-md-12"></div>

                    {!! __form::datepicker(
                      '12', 'week_ending',  'Week Ending *', old('week_ending') ? old('week_ending') : $sugar_analysis->week_ending, $errors->has('week_ending'), $errors->first('week_ending')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::datepicker(
                      '12', 'date_submitted',  'Date Submitted *', old('date_submitted') ? old('date_submitted') : $sugar_analysis->date_submitted, $errors->has('date_submitted'), $errors->first('date_submitted')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::datepicker(
                      '12', 'date_sampled',  'Date Sampled *', old('date_sampled') ? old('date_sampled') : $sugar_analysis->date_sampled, $errors->has('date_sampled'), $errors->first('date_sampled')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::textbox(
                      '12', 'date_analyzed', 'text', 'Date Analyzed *', 'Date Analyzed', old('date_analyzed') ? old('code') : $sugar_analysis->date_analyzed, $errors->has('date_analyzed'), $errors->first('date_analyzed'), ''
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::textbox(
                      '12', 'quantity_mt', 'text', 'Quantity <code>(Metric Tons)</code>', 'Quantity', old('quantity_mt') ? old('quantity_mt') : $sugar_analysis->quantity_mt, $errors->has('quantity_mt'), $errors->first('quantity_mt'), ''
                    ) !!}

                    <div class="col-md-12"></div>

                    @if($sugar_analysis->sugar_sample_id == $sugar_samples_static['muscovado'])

                      {!! __form::textbox(
                        '12', 'code', 'text', 'Code', 'Code', old('code') ? old('code') : $sugar_analysis->code, $errors->has('code'), $errors->first('code'), ''
                      ) !!}

                      <div class="col-md-12"></div>

                    @endif

                    @if($sugar_analysis->sugar_sample_id == $sugar_samples_static['molasses'])

                      {!! __form::textbox(
                        '12', 'report_no', 'text', 'Report No.', 'Report No.', old('report_no') ? old('report_no') : $sugar_analysis->report_no, $errors->has('report_no'), $errors->first('report_no'), ''
                      ) !!}

                      <div class="col-md-12"></div>

                      {!! __form::textbox(
                        '12', 'source', 'text', 'Source', 'Source', old('source') ? old('source') : $sugar_analysis->source, $errors->has('source'), $errors->first('source'), ''
                      ) !!}

                      <div class="col-md-12"></div>

                    @endif

                    {!! __form::textbox(
                      '12', 'description', 'text', 'Description', 'Description', old('description') ? old('description') : $sugar_analysis->description, $errors->has('description'), $errors->first('description'), ''
                    ) !!}

                  </div> 

                </div>
              </div>

              
              <div class="col-md-7">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Parameters</b></h3>
                  </div>
                  
                  <div class="box-body">

                    @foreach ($sugar_analysis->sugarAnalysisParameter as $data)

                      @if ($data->sugar_service_id == $sugar_services_static['mois'])
                      
                        {!! __form::textbox(
                          '4', $data->sugar_service_id .'_moisture', 'text', "MOISTURE", '0.00', old($data->sugar_service_id .'_moisture') ? old($data->sugar_service_id .'_moisture') : $data->moisture_result_dec, $errors->has($data->sugar_service_id .'_moisture'), $errors->first($data->sugar_service_id .'_moisture'), 'data-transform="uppercase"'
                        ) !!}
                      
                        {!! __form::textbox(
                          '4', $data->sugar_service_id .'_sf', 'text', "SAFETY FACTOR", '0.00', old($data->sugar_service_id .'_sf') ? old($data->sugar_service_id .'_sf') : $data->moisture_sf_dec, $errors->has($data->sugar_service_id .'_sf'), $errors->first($data->sugar_service_id .'_sf'), 'data-transform="uppercase"'
                        ) !!}
                        
                      @else

                        {!! __form::textbox(
                          '8', $data->sugar_service_id, 'text', strtoupper($data->name), '0.00', old($data->sugar_service_id) ? old($data->sugar_service_id) : $data->result_dec, $errors->has($data->sugar_service_id), $errors->first($data->sugar_service_id), 'data-transform="uppercase"'
                        ) !!}

                      @endif

                      <div class="col-md-4" style="margin-top:30px;">
                          <code>{{ $data->standard_str }}</code>
                      </div>

                      <div class="col-md-12"></div>
                                
                    @endforeach

                  </div> 

                </div>
              </div>



            </div>


          <div class="box-footer">
            <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
          </div>

          </form>


        @endif


      </div>

    </div>



</section>

@endsection






@section('modals')

  @if(Session::has('SUGAR_ANALYSIS_UPDATE_SUCCESS'))

    {!! __html::modal_print(
      'sa_update', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SUGAR_ANALYSIS_UPDATE_SUCCESS'), route('dashboard.sugar_analysis.show', Session::get('SUGAR_ANALYSIS_UPDATE_SUCCESS_SLUG'))
    ) !!}
  
  @endif

@endsection 







@section('scripts')

  <script type="text/javascript">


    @if(Session::has('SUGAR_ANALYSIS_UPDATE_SUCCESS'))
      $('#sa_update').modal('show');
    @endif


    {{-- Set Or No Toast --}}
    @if(Session::has('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS'))
      {!! __js::toast(Session::get('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS')) !!}
    @endif

    {{-- Moisture Textbox --}}
    $(document).ready(function(){
      $("#SS1017_moisture").keyup(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });


    $(document).ready(function(){
      $("#SS1017_moisture").keydown(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });

    {{-- Pol Textbox--}}
    $(document).ready(function(){
      $("#SS1001").keyup(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });


    $(document).ready(function(){
      $("#SS1001").keydown(function(){
        var denominator = 100 - $("#SS1001").val();
        var numerator = $("#SS1017_moisture").val();
        var sf = numerator / denominator;
        $("#SS1017_sf").val(sf.toFixed(2));
      });
    });


  </script>

@endsection
