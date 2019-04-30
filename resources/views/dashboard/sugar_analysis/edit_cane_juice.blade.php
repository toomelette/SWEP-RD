<?php

  $table_sessions = [ 
                      Session::get('CJ_ANALYSIS_CREATE_SUCCESS_SLUG'),
                    ];

?>

@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Fill Up Results</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.sugar_analysis.index']) !!}
    </div>
</section>

<section class="content" id="pjax-container">
    


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
        <h3 class="box-title">Cane Juice Analysis</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
        <div class="box-body">

          
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Form</b></h3>
              </div>
              
              <form data-pjax role="form" method="POST" action="{{ route('dashboard.sugar_analysis.cane_juice_analysis_store', $sa->slug) }}">

              @csrf

                <div class="box-body">

                  {!! __form::textbox(
                     '3', 'entry_no', 'entry_no', 'Entry No. ', 'Entry No.', old('entry_no'), $errors->has('entry_no'), $errors->first('entry_no'), ''
                  ) !!}


                  {!! __form::datepicker(
                    '3', 'date_sampled',  'Date Sampled', old('date_sampled'), $errors->has('date_sampled'), $errors->first('date_sampled')
                  ) !!}


                  {!! __form::datepicker(
                    '3', 'date_analyzed',  'Date Analyzed', old('date_analyzed'), $errors->has('date_analyzed'), $errors->first('date_analyzed')
                  ) !!}


                  {!! __form::textbox(
                     '3', 'variety', 'variety', 'Variety', 'Variety', old('variety'), $errors->has('variety'), $errors->first('variety'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! __form::textbox(
                     '3', 'hacienda', 'hacienda', 'Hacienda', 'Hacienda', old('hacienda'), $errors->has('hacienda'), $errors->first('hacienda'), ''
                  ) !!}


                  {!! __form::textbox(
                     '3', 'corrected_brix', 'corrected_brix', 'Corrected Brix ', 'Corrected Brix', old('corrected_brix'), $errors->has('corrected_brix'), $errors->first('corrected_brix'), ''
                  ) !!}


                  {!! __form::textbox(
                     '3', 'polarization', 'polarization', '% Pol', '% Pol', old('polarization'), $errors->has('polarization'), $errors->first('polarization'), ''
                  ) !!}


                  {!! __form::textbox(
                     '3', 'purity', 'purity', 'Purity', 'Purity', old('purity'), $errors->has('purity'), $errors->first('purity'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! __form::textbox(
                     '6', 'remarks', 'remarks', 'Remarks PSTC/LkgTC', 'Remarks PSTC/LkgTC', old('remarks'), $errors->has('remarks'), $errors->first('remarks'), ''
                  ) !!}

                </div> 

              <div class="box-footer">
                <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
              </div>

              </form>

            </div>

          </div>


          
          <div class="col-md-12" style="margin-top:25px;">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"><b>List</b></h3>
                <div class="box-tools">
                  <a href="#" id="print_cja" data-url="" class="btn btn-sm btn-default">
                    <i class="fa fa-print"></i> Print
                  </a>
                </div>
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
                    <th>Action</th>
                  </tr>
                  @foreach($sa->caneJuiceAnalysis as $data) 
                    <tr 
                      {!! __html::table_highlighter( $data->slug, $table_sessions) !!} 
                      {!! old('e_slug') == $data->slug ? 'style="background-color: #F5B7B1;"' : '' !!}
                    >
                      <td>{{ $data->entry_no }}</td>
                      <td>{{ __dataType::date_parse($data->date_sampled, '  m/d/Y') }}</td>
                      <td>{{ __dataType::date_parse($data->date_analyzed, 'm/d/Y') }}</td>
                      <td>{{ $data->variety }}</td>
                      <td>{{ $data->hacienda }}</td>
                      <td>{{ $data->corrected_brix }}</td>
                      <td>{{ $data->polarization }}</td>
                      <td>{{ $data->purity }}</td>
                      <td>{{ $data->remarks }}</td>
                      <td>
                        <div class="btn-group">
                          <a href="#" id="sa_update_btn" es="" data-url="" class="btn btn-sm btn-default">
                            <i class="fa fa-pencil-square-o"></i>
                          </a>
                          <a href="#" id="sa_update_btn" data-url="" class="btn btn-sm btn-default">
                            <i class="fa  fa-trash-o"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </table>

              </div> 

            </div>
          </div>



        </div>

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

  </script>

@endsection
