@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create Cane Juice Analysis</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.cane_juice_analysis.store') }}">

        <div class="box-body">
                  
          @csrf    

          {!! __form::textbox(
            '4', 'origin', 'text', 'Origin *', 'Origin', old('origin'), $errors->has('origin'), $errors->first('origin'), ''
          ) !!}

          {!! __form::datepicker(
            '4', 'date',  'Date *', old('date') ? old('date') : Carbon::now()->format('m/d/Y'), $errors->has('date'), $errors->first('date')
          ) !!}

          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Children</h3>
                <button id="children_add_row" type="button" class="btn btn-sm bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">

                <table class="table table-bordered">

                  <tr>
                    <th>Fullname *</th>
                    <th>Date of Birth *</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="children_table_body">

                    @if(old('row_children'))

                      @foreach(old('row_children') as $key => $value)

                        <tr>

                          <td>
                            {!! __form::textbox_for_dt(
                              'row_children['. $key .'][fullname]', 'Fullname', $value['fullname'], $errors->first('row_children.'. $key .'.fullname')
                            ) !!}
                          </td>

                          <td> 
                            {!! __form::datepicker_for_dt(
                              'row_children['. $key .'][date_of_birth]', $value['date_of_birth'], $errors->first('row_children.'. $key .'.date_of_birth')
                            ) !!}
                          </td>

                          <td>
                              <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                          </td>

                        </tr>

                      @endforeach

                    @endif

                    </tbody>

                </table>

              </div>
            </div>
          </div>



        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection





@section('modals')

  @if(Session::has('SUGAR_SERVICE_CREATE_SUCCESS'))

    {!! __html::modal(
      'ss_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SUGAR_SERVICE_CREATE_SUCCESS')
    ) !!}
  
  @endif

@endsection 






@section('scripts')

  <script type="text/javascript">

    @if(Session::has('SUGAR_SERVICE_CREATE_SUCCESS'))
      $('#ss_create').modal('show');
    @endif

    {{-- Children ADD ROW --}}
    $(document).ready(function() {

      $("#children_add_row").on("click", function() {
      var i = $("#children_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_children[' + i + '][fullname]" class="form-control" placeholder="Fullname">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_children[' + i + '][date_of_birth]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#children_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });
      
      $(this).removeClass('datepicker');

      });

    });
    
  </script>
    
@endsection