@extends('layouts.admin-master')


@section('css')
  
  <style type="text/css">

    table, td {
      border: 1px solid black;
    }

    thead{
      -webkit-print-color-adjust: exact; 
      background-color: #78B681 !important;
    }

    .data-row-head{
      text-align: center;
      padding:5px;
      font-size:14px;
      font-weight: bold;
    }

    .data-row-body{
      text-align: center;
      padding:5px;
      font-size:14px;
    }

  </style>

@endsection


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
        <h3 class="box-title">Order of Payment Info</h3>
      </div>
      <div class="box-body">
        <dl class="dl-horizontal">
          <dt>Type:</dt>
            @if($sa->customer_type == "CT1001")
              <dd>Walk in</dd>
            @elseif($sa->customer_type == "CT1002")
              <dd>Mill Company</dd>
            @endif
          <dt>Sample No:</dt>
          <dd>{{ $sa->sample_no }}</dd>
          <dt>Kind of Sample:</dt>
          <dd>{{ optional($sa->sugarSample)->name }}</dd>
          <dt>Origin:</dt>
          <dd>{{ $sa->origin }}</dd>
          <dt>Address:</dt>
          <dd>{{ $sa->address }}</dd>

          @if($sa)
            
          @endif

          <dt>Charge:</dt>
          <dd>Php {{ number_format($sa->total_price, 2) }}</dd>
        </dl>
      </div>
    </div>
  </div>




  <div class="col-md-12">
    <div class="box">
      
      <div class="box-header with-border">
        <h3 class="box-title">Results</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" action="{{ route('dashboard.sugar_analysis.update', $sa->slug) }}">

        <div class="box-body">

          @csrf

          <input name="_method" value="PUT" type="hidden">

          
          <div class="col-md-5">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Form</b></h3>
              </div>
              
              <div class="box-body">

                {!! __form::datepicker(
                  '12', 'week_ending',  'Week Ending *', old('week_ending') ? old('week_ending') : __dataType::date_parse($sa->week_ending), $errors->has('week_ending'), $errors->first('week_ending')
                ) !!}

                <div class="col-md-12"></div>

                {!! __form::datepicker(
                  '12', 'date_sampled',  'Date Sampled *', old('date_sampled') ? old('date_sampled') : __dataType::date_parse($sa->date_sampled), $errors->has('date_sampled'), $errors->first('date_sampled')
                ) !!}

                <div class="col-md-12"></div>

                {!! __form::datepicker(
                  '12', 'date_submitted',  'Date Submitted *', old('date_submitted') ? old('date_submitted') : __dataType::date_parse($sa->date_submitted), $errors->has('date_submitted'), $errors->first('date_submitted')
                ) !!}

                <div class="col-md-12"></div>

                {!! __form::datepicker(
                  '12', 'date_analyzed',  'Date Analyzed *', old('date_analyzed') ? old('date_analyzed') : __dataType::date_parse($sa->date_analyzed), $errors->has('date_analyzed'), $errors->first('date_analyzed')
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
                  '12', 'description', 'text', 'Description', 'Description', old('description') ? old('description') : $sa->description, $errors->has('description'), $errors->first('description'), 'data-transform="uppercase"'
                ) !!}

              </div> 

            </div>
          </div>

          
          <div class="col-md-7">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Parameters</b></h3>
              </div>
              
              <div class="box-body">

                @foreach ($sa->sugarAnalysisParameter as $data)

                  <?php
                    $assessment_name = $data->sugar_service_id .'_assessment';
                  ?>

                  {!! __form::textbox(
                    '6', $data->sugar_service_id, 'text', strtoupper($data->name) .' &nbsp;&nbsp;('. $data->standard.')', $data->name, old($data->sugar_service_id) ? old($data->sugar_service_id) : $data->result, $errors->has($data->sugar_service_id), $errors->first($data->sugar_service_id), 'data-transform="uppercase"'
                  ) !!}

                  <div class="col-md-1" style="margin-top:30px;"><span> &nbsp;&nbsp;&nbsp;&nbsp;=</span></div>

                  {!! __form::select_static(
                    '5', $assessment_name, 'Assessment', old($assessment_name) ? old($assessment_name) : $data->assessment, ['Within Std.' => 'Within Std.', 'Below Std.' => 'Below Std.'], $errors->has($assessment_name), $errors->first($assessment_name), '', ''
                  ) !!}
                            
                @endforeach

              </div> 

            </div>
          </div>



        </div>


        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

        </form>

      </div>
    </div>



</section>

@endsection