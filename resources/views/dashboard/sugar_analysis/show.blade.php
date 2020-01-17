<?php
  
  $sugar_samples_static = __static::sugar_samples();
  $sugar_services_static = __static::sugar_services();
  
?>

@extends('layouts.admin-master')

@section('content')

<section class="content-header">
  <h1>Sugar Analysis Details</h1>
  <div class="pull-right" style="margin-top: -25px;">
    {!! __html::back_button(['dashboard.sugar_analysis.index']) !!}
  </div>
</section>

<section class="content">
  
  <div class="box">
        
    <div class="box-header with-border">
      <h3 class="box-title">Details</h3>
      <div class="box-tools">
        <a href="{{ route('dashboard.sugar_analysis.print', $sugar_analysis->slug) }}" class="btn btn-sm btn-default" target="_blank">
          <i class="fa fa-print"></i> Print
        </a>&nbsp;
        <a href="{{ route('dashboard.sugar_analysis.edit', $sugar_analysis->slug) }}" class="btn btn-sm btn-default">
          <i class="fa fa-pencil"></i> Edit
        </a>
      </div>
    </div>

    <div class="box-body">

      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Order of Payment Info</h3>
          </div>
          <div class="box-body">
            <dl class="dl-horizontal">
              <dt>OR #:</dt>
              <dd>{{ $sugar_analysis->or_no }}</dd>
              <dt>Date:</dt>
              <dd>{{ __dataType::date_parse($sugar_analysis->date, 'F d,Y') }}</dd>
              <dt>Sample No:</dt>
              <dd>{{ $sugar_analysis->sample_no }}</dd>
              <dt>Origin/Mill Company:</dt>
              <dd>{{ $sugar_analysis->origin }}</dd>
              <dt>Address:</dt>
              <dd>{{ $sugar_analysis->address }}</dd>
              <dt>Kind of Sample:</dt>
              <dd>{{ optional($sugar_analysis->sugarSample)->name }}</dd>

              @if ($sugar_analysis->sugar_sample_id == $sugar_samples_static['muscovado']) 
                <dt>Code:</dt>
                <dd>{{ $sugar_analysis->code }}</dd>
              @endif

              @if ($sugar_analysis->sugar_sample_id == $sugar_samples_static['molasses']) 
                <dt>Source:</dt>
                <dd>{{ $sugar_analysis->source }}</dd>
              @endif

              <dt>Quantity:</dt>
              <dd>{{ number_format($sugar_analysis->quantity_mt, 3) }} MT</dd>
              <dt>Week Ending:</dt>
              <dd>{{ __dataType::date_parse($sugar_analysis->week_ending, 'F d,Y') }}</dd>
              <dt>Date Submitted:</dt>
              <dd>{{ __dataType::date_parse($sugar_analysis->date_submitted, 'F d,Y') }}</dd>
              <dt>Date Sampled:</dt>
              <dd>{{ __dataType::date_parse($sugar_analysis->date_sampled, 'F d,Y') }}</dd>
              <dt>Date Analyzed:</dt>
              <dd>{{ $sugar_analysis->date_analyzed }}</dd>
              <dt>Description of Sample:</dt>
              <dd>{{ $sugar_analysis->description }}</dd>
            </dl>
          </div>
        </div>
      </div> 



      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Services</h3>
          </div>
          <div class="box-body">

            <table class="table table-bordered">
              
              <tr>
                  <th>Parameters</th>
                  <th>Results</th>
                  <th>Standards</th>
              </tr>  

              @foreach($sugar_analysis->sugarAnalysisParameter->sortBy('seq_no') as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>
                      @if ($data->sugar_service_id == $sugar_services_static['mois'])
                        {{ number_format($data->moisture_result_dec, 2) .' / '. number_format($data->moisture_sf_dec, 2)}}
                      @else
                        {{ number_format($data->result_dec, 2) }}
                      @endif
                    </td>
                    <td>{{ $data->standard_str }}</td>
                </tr> 
              @endforeach

            </table>

          </div>
        </div>
      </div>



    </div>
  </div>
</section>

@endsection
