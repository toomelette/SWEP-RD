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
        <a href="{{ route('dashboard.sugar_analysis.print', $sa->slug) }}" class="btn btn-sm btn-default" target="_blank">
          <i class="fa fa-print"></i> Print
        </a>&nbsp;
        <a href="{{ route('dashboard.sugar_analysis.edit', $sa->slug) }}" class="btn btn-sm btn-default">
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
              <dd>{{ $sa->or_no }}</dd>
              <dt>Date:</dt>
              <dd>{{ __dataType::date_parse($sa->date, 'F d,Y') }}</dd>
              <dt>Sample No:</dt>
              <dd>{{ $sa->sample_no }}</dd>
              <dt>Origin/Mill Company:</dt>
              <dd>{{ $sa->origin }}</dd>
              <dt>Address:</dt>
              <dd>{{ $sa->address }}</dd>
              <dt>Kind of Sample:</dt>
              <dd>{{ optional($sa->sugarSample)->name }}</dd>

              @if ($sa->sugar_sample_id == "SS1003") 
                <dt>Code:</dt>
                <dd>{{ $sa->code }}</dd>
              @endif

              @if ($sa->sugar_sample_id == "SS1004") 
                <dt>Report No:</dt>
                <dd>{{ $sa->report_no }}</dd>
                <dt>Source:</dt>
                <dd>{{ $sa->source }}</dd>
              @endif

              <dt>Quantity:</dt>
              <dd>{{ $sa->quantity }}</dd>
              <dt>Week Ending:</dt>
              <dd>{{ __dataType::date_parse($sa->week_ending, 'F d,Y') }}</dd>
              <dt>Date Sampled:</dt>
              <dd>{{ __dataType::date_parse($sa->date_sampled, 'F d,Y') }}</dd>
              <dt>Date Submitted:</dt>
              <dd>{{ __dataType::date_parse($sa->date_submitted, 'F d,Y') }}</dd>
              <dt>Date Analyzed:</dt>
              <dd>{{ __dataType::date_scope($sa->date_analyzed_from, $sa->date_analyzed_to) }}</dd>
              <dt>Description of Sample:</dt>
              <dd>{{ $sa->description }}</dd>
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

              @foreach($sa->sugarAnalysisParameter as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->result }}</td>
                    <td>{{ $data->standard }}</td>
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
