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
      <h3 class="box-title"><b>Details</b></h3>
      <div class="box-tools">
        <a href="{{ route('dashboard.sugar_analysis.cane_juice_analysis_print', $sa->slug) }}" class="btn btn-sm btn-default" target="_blank">
          <i class="fa fa-print"></i> Print
        </a>&nbsp;
        <a href="{{ route('dashboard.sugar_analysis.edit', $sa->slug) }}" class="btn btn-sm btn-default">
          <i class="fa fa-pencil"></i> Edit
        </a>
      </div>
    </div>

    <div class="box-body">

      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Order of Payment Info</h3>
          </div>
          <div class="box-body">
            <dl class="dl-horizontal">
              <dt>OR No.:</dt>
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
              
            </dl>
          </div>
        </div>
      </div> 



      <div class="col-md-12" style="margin-top:10px;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Cane Juice Analysis</h3>
          </div>
          
          <div class="box-body">
            <table class="table table-hover">
              <tr>
                <th>Entry No.</th>
                <th>Date Submitted</th>
                <th>Date Sampled</th>
                <th>Date Analyzed</th>
                <th>Variety</th>
                <th>Hacienda</th>
                <th>Corrected Brix</th>
                <th>% POL</th>
                <th>Purity</th>
                <th>Remarks</th>
              </tr>
              @foreach($sa->caneJuiceAnalysis->sortBy('entry_no') as $data) 
                <tr>
                  <td>{{ $data->entry_no }}</td>
                  <td>{{ __dataType::date_parse($data->date_submitted, '  m/d/Y') }}</td>
                  <td>{{ __dataType::date_parse($data->date_sampled, '  m/d/Y') }}</td>
                  <td>{{ __dataType::date_scope($data->date_analyzed_from, $data->date_analyzed_to) }}</td>
                  <td>{{ $data->variety }}</td>
                  <td>{{ $data->hacienda }}</td>
                  <td>{{ $data->corrected_brix }}</td>
                  <td>{{ $data->polarization }}</td>
                  <td>{{ $data->purity }}</td>
                  <td>{{ $data->remarks }}</td>
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
