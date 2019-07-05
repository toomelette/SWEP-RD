<?php

  $table_sessions = [ 
                      Session::get('CJ_ANALYSIS_CREATE_SUCCESS_SLUG'),
                      Session::get('CJ_ANALYSIS_UPDATE_SUCCESS_SLUG'),
                    ];

?>

@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Fill Up Results</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.sugar_analysis.index', 'dashboard.sugar_analysis.show']) !!}
    </div>
</section>

<section class="content" id="pjax-container">


  <div class="col-md-12">
    <div class="box">
      
      <div class="box-header with-border">
        <h3 class="box-title">Cane Juice Analysis</h3>
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
            
            {{-- Cane Juice Analysis Form --}}
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
                      '3', 'date_submitted',  'Date Submitted', old('date_submitted'), $errors->has('date_submitted'), $errors->first('date_submitted')
                    ) !!}


                    {!! __form::datepicker(
                      '3', 'date_sampled',  'Date Sampled', old('date_sampled'), $errors->has('date_sampled'), $errors->first('date_sampled')
                    ) !!}


                    {!! __form::datepicker(
                      '3', 'date_analyzed_from',  'Date Analyzed From', old('date_analyzed_from'), $errors->has('date_analyzed_from'), $errors->first('date_analyzed_from')
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::datepicker(
                      '3', 'date_analyzed_to',  'Date Analyzed To', old('date_analyzed_to'), $errors->has('date_analyzed_to'), $errors->first('date_analyzed_to')
                    ) !!}


                    {!! __form::textbox(
                       '3', 'variety', 'variety', 'Variety', 'Variety', old('variety'), $errors->has('variety'), $errors->first('variety'), ''
                    ) !!}


                    {!! __form::textbox(
                       '3', 'hacienda', 'hacienda', 'Hacienda', 'Hacienda', old('hacienda'), $errors->has('hacienda'), $errors->first('hacienda'), ''
                    ) !!}


                    {!! __form::textbox(
                       '3', 'corrected_brix', 'corrected_brix', 'Corrected Brix ', 'Corrected Brix', old('corrected_brix'), $errors->has('corrected_brix'), $errors->first('corrected_brix'), ''
                    ) !!}

                    <div class="col-md-12"></div>

                    {!! __form::textbox(
                       '3', 'polarization', 'polarization', '% Pol', '% Pol', old('polarization'), $errors->has('polarization'), $errors->first('polarization'), ''
                    ) !!}

                    {!! __form::textbox(
                       '3', 'purity', 'purity', 'Purity', 'Purity', old('purity'), $errors->has('purity'), $errors->first('purity'), ''
                    ) !!}

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


            {{-- Cane Juice Analysis List --}}
            <div class="col-md-12" style="margin-top:25px;">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><b>List</b></h3>
                  <div class="box-tools">
                    <a href="{{ route('dashboard.sugar_analysis.cane_juice_analysis_print', $sa->slug) }}" class="btn btn-sm btn-default" target="_blank">
                      <i class="fa fa-print"></i> Print
                    </a>
                  </div>
                </div>
                
                <div class="box-body">
                  @if($errors->all())
                    <ul style="line-height: 10px;">
                      @foreach ($errors->all() as $data)
                        <li><p class="text-danger">{{ $data }}</p></li>
                      @endforeach
                    </ul>
                  @endif
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
                      <th>Action</th>
                    </tr>
                    @foreach($sa->caneJuiceAnalysis->sortBy('entry_no') as $data) 
                      <tr 
                        {!! __html::table_highlighter( $data->slug, $table_sessions) !!} 
                        {!! old('e_slug') == $data->slug ? 'style="background-color: #F5B7B1;"' : '' !!}
                      >
                        <td>{{ $data->entry_no }}</td>
                        <td>{{ __dataType::date_parse($data->date_submitted, 'm/d/Y') }}</td>
                        <td>{{ __dataType::date_parse($data->date_sampled, 'm/d/Y') }}</td>
                        <td>{{ __dataType::date_scope($data->date_analyzed_from, $data->date_analyzed_to) }}</td>
                        <td>{{ $data->variety }}</td>
                        <td>{{ $data->hacienda }}</td>
                        <td>{{ $data->corrected_brix }}</td>
                        <td>{{ $data->polarization }}</td>
                        <td>{{ $data->purity }}</td>
                        <td>{{ $data->remarks }}</td>
                        <td>
                          <div class="btn-group">
                            <a href="#" id="cja_update_btn" es="{{ $data->slug }}" data-url="{{ route('dashboard.sugar_analysis.cane_juice_analysis_update', [$sa->slug, $data->slug]) }}" class="btn btn-sm btn-default">
                              <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a href="#" id="cja_delete_btn" data-url="{{ route('dashboard.sugar_analysis.cane_juice_analysis_destroy', [$sa->slug, $data->slug]) }}" class="btn btn-sm btn-default">
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

          @endif
          



        </div>

      </div>
    </div>


</section>

@endsection






@section('modals')


  {{-- Update CJA --}}
  <div class="modal fade bs-example-modal-lg" id="cja_update" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="cja_update_body">
          <form data-pjax id="cja_update_form" method="POST" autocomplete="off">

            <div class="row">
                
              @csrf

              <input name="_method" value="PUT" type="hidden">

              <input name="e_slug" id="e_slug"  type="hidden">

              {!! __form::textbox(
                 '3', 'e_entry_no', 'e_entry_no', 'Entry No. ', 'Entry No.', old('e_entry_no'), $errors->has('e_entry_no'), $errors->first('e_entry_no'), ''
              ) !!}


              {!! __form::datepicker(
                '3', 'e_date_submitted',  'Date Submitted', old('e_date_submitted'), $errors->has('e_date_submitted'), $errors->first('e_date_submitted')
              ) !!}


              {!! __form::datepicker(
                '3', 'e_date_sampled',  'Date Sampled', old('e_date_sampled'), $errors->has('e_date_sampled'), $errors->first('e_date_sampled')
              ) !!}


              {!! __form::datepicker(
                '3', 'e_date_analyzed_from',  'Date Analyzed From', old('e_date_analyzed_from'), $errors->has('e_date_analyzed_from'), $errors->first('e_date_analyzed_from')
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::datepicker(
                '3', 'e_date_analyzed_to',  'Date Analyzed To', old('e_date_analyzed_to'), $errors->has('e_date_analyzed_to'), $errors->first('e_date_analyzed_to')
              ) !!}


              {!! __form::textbox(
                 '3', 'e_variety', 'e_variety', 'Variety', 'Variety', old('e_variety'), $errors->has('e_variety'), $errors->first('e_variety'), ''
              ) !!}


              {!! __form::textbox(
                 '3', 'e_hacienda', 'e_hacienda', 'Hacienda', 'Hacienda', old('e_hacienda'), $errors->has('e_hacienda'), $errors->first('e_hacienda'), ''
              ) !!}


              {!! __form::textbox(
                 '3', 'e_corrected_brix', 'e_corrected_brix', 'Corrected Brix ', 'Corrected Brix', old('e_corrected_brix'), $errors->has('e_corrected_brix'), $errors->first('e_corrected_brix'), ''
              ) !!}

              <div class="col-md-12"></div>


              {!! __form::textbox(
                 '3', 'e_polarization', 'e_polarization', '% Pol', '% Pol', old('e_polarization'), $errors->has('e_polarization'), $errors->first('e_polarization'), ''
              ) !!}

              {!! __form::textbox(
                 '3', 'e_purity', 'e_purity', 'Purity', 'Purity', old('e_purity'), $errors->has('e_purity'), $errors->first('e_purity'), ''
              ) !!}


              {!! __form::textbox(
                 '6', 'e_remarks', 'e_remarks', 'Remarks PSTC/LkgTC', 'Remarks PSTC/LkgTC', old('e_remarks'), $errors->has('e_remarks'), $errors->first('e_remarks'), ''
              ) !!}


            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>



  {{-- Delete CJA --}}
  {!! __html::modal_delete('cja_delete') !!}


@endsection 







@section('scripts')

  <script type="text/javascript">


    // Update Button Action
    $(document).on("click", "#cja_update_btn", function () {

      var slug = $(this).attr("es");

      $("#cja_update").modal("show");
      $("#cja_update_body #cja_update_form").attr("action", $(this).data("url"));

      // Datepicker
      $('.datepicker').each(function(){
          $(this).datepicker({
              autoclose: true,
              dateFormat: "mm/dd/yy",
              orientation: "bottom"
          })
      });

      $.ajax({
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        url: "/api/sugar_analysis/cane_juice_analysis/"+slug+"/edit",
        type: "GET",
        dataType: "json",
        success:function(data) {       
            
          $.each(data, function(key, value) {
            $("#cja_update_form #e_slug").val(value.slug);
            $("#cja_update_form #e_entry_no").val(value.entry_no);
            if(value.date_sampled != null){
              $("#cja_update_form #e_date_sampled").datepicker("setDate", new Date(value.date_sampled));
            }
            if(value.date_analyzed_from != null){
              $("#cja_update_form #e_date_analyzed_from").datepicker("setDate", new Date(value.date_analyzed_from));
            }
            if(value.date_analyzed_to != null){
              $("#cja_update_form #e_date_analyzed_to").datepicker("setDate", new Date(value.date_analyzed_to));
            }
            if(value.date_submitted != null){
              $("#cja_update_form #e_date_submitted").datepicker("setDate", new Date(value.date_submitted));
            }
            $("#cja_update_form #e_variety").val(value.variety);
            $("#cja_update_form #e_variety").val(value.variety);
            $("#cja_update_form #e_hacienda").val(value.hacienda);
            $("#cja_update_form #e_corrected_brix").val(value.corrected_brix);
            $("#cja_update_form #e_polarization").val(value.polarization);
            $("#cja_update_form #e_purity").val(value.purity);
            $("#cja_update_form #e_remarks").val(value.remarks);
          });

        }
      });

    });



    // Update Form Action
    $(document).on("submit", "#cja_update_body #cja_update_form", function () {
      $('#cja_update').delay(50).fadeOut(50);
      setTimeout(function(){
        $('#cja_update').modal("hide");  
      }, 100);
    });



    // Delete Button Action
    $(document).on("click", "#cja_delete_btn", function () {
      $("#cja_delete").modal("show");
      $("#delete_body #form").attr("action", $(this).data("url"));
      $("#delete_body #form").attr("data-pjax", '');
      $(this).val("");
    });



    // Delete Form Action
    $(document).on("submit", "#delete_body #form", function () {
        $('#cja_delete').delay(100).fadeOut(100);
       setTimeout(function(){
          $('#cja_delete').modal("hide");
       }, 200);
    });


    {{-- Set Or No Toast --}}
    @if(Session::has('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS'))
      {!! __js::toast(Session::get('SUGAR_ANALYSIS_SET_OR_NO_SUCCESS')) !!}
    @endif



  </script>

@endsection
