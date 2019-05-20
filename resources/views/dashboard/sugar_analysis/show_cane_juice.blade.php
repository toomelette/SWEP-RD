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
        <a href="#" id="print_cja" data-url="{{ route('dashboard.sugar_analysis.cane_juice_analysis_print', $sa->slug) }}" class="btn btn-sm btn-default">
          <i class="fa fa-print"></i> Print
        </a>&nbsp;
        <a href="{{ route('dashboard.sugar_analysis.edit', $sa->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
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






@section('modals')

  {{-- Print Modal --}}
  <div class="modal fade" id="print_cja_modal" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Signatories:</h4>
        </div>
        <form id="print_cja_form" method="GET" target="_blank">
          <div class="modal-body">

            {!! __form::textbox(
               '12', 'nb', 'text', 'Noted By:', 'Noted By', old('nb'), $errors->has('nb'), $errors->first('nb'), 'data-transform="uppercase"'
            ) !!}

            {!! __form::textbox(
               '12', 'p', 'text', 'Position:', 'Position', old('p'), $errors->has('p'), $errors->first('p'), 'data-transform="uppercase"'
            ) !!}

            {!! __form::textbox(
               '12', 'd', 'text', 'Department/Division:', 'Department/Division', old('d'), $errors->has('d'), $errors->first('d'), 'data-transform="uppercase"'
            ) !!}

          </div>
          <div class="modal-footer" style="overflow: hidden;">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Print</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection






@section('scripts')

  <script type="text/javascript">

    // CALL PRINT SR MODAL
    $(document).on("click", "#print_cja", function () {

        $("#print_cja_modal").modal("show");
        $("#print_cja_form").attr("action", $(this).data("url"));
        
    });

  </script>

@endsection
