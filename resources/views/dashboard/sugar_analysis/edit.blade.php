@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Fill Up Results</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.sugar_analysis.index']) !!}
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
            
            <form method="POST" action="{{ route('dashboard.sugar_analysis.set_or_no', $sa->slug) }}">

            @csrf

              <div class="box-body">

                @csrf
                
                {!! __form::textbox(
                   '3', 'or_no', 'or_no', 'OR No. *', 'OR No.', old('or_no') ? old('or_no') : $sa->or_no, $errors->has('or_no'), $errors->first('or_no'), ''
                ) !!}

                <div class="col-md-2" style="margin-top: 25px;">
                  <button type="submit" class="btn btn-default">Submit <i class="fa fa-fw fa-save"></i></button>
                </div>

              </div> 
              
            </form>
          </div>
        </div>



        @if(!empty($sa->or_no))


          <form method="POST" action="{{ route('dashboard.sugar_analysis.update', $sa->slug) }}">

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
                      '12', 'week_ending',  'Week Ending *', old('week_ending') ? old('week_ending') : __dataType::date_parse($sa->week_ending), $errors->has('week_ending'), $errors->first('week_ending')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::datepicker(
                      '12', 'date_submitted',  'Date Submitted *', old('date_submitted') ? old('date_submitted') : __dataType::date_parse($sa->date_submitted), $errors->has('date_submitted'), $errors->first('date_submitted')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::datepicker(
                      '12', 'date_sampled',  'Date Sampled *', old('date_sampled') ? old('date_sampled') : __dataType::date_parse($sa->date_sampled), $errors->has('date_sampled'), $errors->first('date_sampled')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::datepicker(
                      '6', 'date_analyzed_from',  'Date Analyzed From *', old('date_analyzed_from') ? old('date_analyzed_from') : __dataType::date_parse($sa->date_analyzed_from), $errors->has('date_analyzed_from'), $errors->first('date_analyzed_from')
                    ) !!}

                    {!! __form::datepicker(
                      '6', 'date_analyzed_to',  'Date Analyzed To *', old('date_analyzed_to') ? old('date_analyzed_to') : __dataType::date_parse($sa->date_analyzed_to), $errors->has('date_analyzed_to'), $errors->first('date_analyzed_to')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::textbox(
                      '12', 'quantity', 'text', 'Quantity', 'Quantity', old('quantity') ? old('quantity') : $sa->quantity, $errors->has('quantity'), $errors->first('quantity'), ''
                    ) !!}

                    <div class="col-md-12"></div>

                    @if($sa->sugar_sample_id == "SS1003")

                      {!! __form::textbox(
                        '12', 'code', 'text', 'Code', 'Code', old('code') ? old('code') : $sa->code, $errors->has('code'), $errors->first('code'), ''
                      ) !!}

                      <div class="col-md-12"></div>

                    @endif

                    @if($sa->sugar_sample_id == "SS1004")

                      {!! __form::textbox(
                        '12', 'report_no', 'text', 'Report No.', 'Report No.', old('report_no') ? old('report_no') : $sa->report_no, $errors->has('report_no'), $errors->first('report_no'), ''
                      ) !!}

                      <div class="col-md-12"></div>

                      {!! __form::textbox(
                        '12', 'source', 'text', 'Source', 'Source', old('source') ? old('source') : $sa->source, $errors->has('source'), $errors->first('source'), ''
                      ) !!}

                      <div class="col-md-12"></div>

                    @endif

                    {!! __form::textbox(
                      '12', 'description', 'text', 'Description', 'Description', old('description') ? old('description') : $sa->description, $errors->has('description'), $errors->first('description'), ''
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

                    @foreach ($sa->sugarAnalysisParameter as $data)

                      <?php
                        $assessment_name = $data->sugar_service_id .'_assessment';
                      ?>

                      @if ($data->sugar_service_id == "SS1017")
                      
                        {!! __form::textbox(
                          '3', $data->sugar_service_id .'_moisture', 'text', "MOISTURE", '0.00', old($data->sugar_service_id .'_moisture') ? old($data->sugar_service_id .'_moisture') : number_format($data->moisture_result_dec, 2), $errors->has($data->sugar_service_id .'_moisture'), $errors->first($data->sugar_service_id .'_moisture'), 'data-transform="uppercase"'
                        ) !!}
                      
                        {!! __form::textbox(
                          '3', $data->sugar_service_id .'_sf', 'text', "SAFETY FACTOR", '0.00', old($data->sugar_service_id .'_sf') ? old($data->sugar_service_id .'_sf') : number_format($data->moisture_sf_dec, 2), $errors->has($data->sugar_service_id .'_sf'), $errors->first($data->sugar_service_id .'_sf'), 'data-transform="uppercase"'
                        ) !!}
                        
                      @else

                        {!! __form::textbox(
                          '6', $data->sugar_service_id, 'text', strtoupper($data->name), '0.00', old($data->sugar_service_id) ? old($data->sugar_service_id) : number_format($data->result_dec, 2), $errors->has($data->sugar_service_id), $errors->first($data->sugar_service_id), 'data-transform="uppercase"'
                        ) !!}

                      @endif

                      <div class="col-md-1" style="margin-top:30px;"><span> &nbsp;&nbsp;&nbsp;&nbsp;=</span></div>

                      {!! __form::select_static(
                        '5', $assessment_name, 'Assessment', old($assessment_name) ? old($assessment_name) : $data->assessment, ['Below Std.' => 'Below Std.', 'Within Std.' => 'Within Std.', 'Above Std.' => 'Above Std.'], $errors->has($assessment_name), $errors->first($assessment_name), '', ''
                      ) !!}

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

  </script>

@endsection
