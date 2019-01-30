@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create Order Of Payment</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sugar_order_of_payment.store') }}">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf

            {!! __form::select_static(
              '4', 'customer_type', 'Customer Type *', old('customer_type'), ['Walk in / Trader' => 'CT1001', 'Mill' => 'CT1002'], $errors->has('customer_type'), $errors->first('customer_type'), '', ''
            ) !!}

            {!! __form::textbox(
              '4', 'received_from', 'text', 'Received From *', 'Recieved From', old('received_from'), $errors->has('received_from'), $errors->first('received_from'), ''
            ) !!}

            {!! __form::textbox(
              '4', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
            ) !!}

            <div class="col-md-12"></div>

            {!! __form::textbox(
              '4', 'sample_no', 'text', 'Sample No. *', 'Sample No.', old('sample_no'), $errors->has('sample_no'), $errors->first('sample_no'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date',  'Date Received *', old('date'), $errors->has('date'), $errors->first('date')
            ) !!}

            {!! __form::textbox(
              '4', 'sugar_sample', 'text', 'Kind of Sample *', 'Kind of Sample', old('sugar_sample'), $errors->has('sugar_sample'), $errors->first('sugar_sample'), ''
            ) !!}

            <div class="col-md-12"></div>

          </div>


          {{-- USER MENU DYNAMIC TABLE GRID --}}
          <div class="col-md-12" style="padding-top:50px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Kind of Analysis</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">
                
                <table class="table table-bordered">

                  <tr>
                    <th>Services *</th>
                    <th>Price *</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="table_body">


                    @if(old('row'))

                      @foreach(old('row') as $key => $value)

                        <tr>

                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sugar_service_name]" class="form-control" placeholder="Name" value="{{ $value['sugar_service_name'] }}">
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sugar_service_id') }}</small>
                            </div>
                          </td>


                          <td></td>


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

  @if(Session::has('SOOP_CREATE_SUCCESS'))

    {!! __html::modal(
      'soop_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SOOP_CREATE_SUCCESS')
    ) !!}
  
  @endif

@endsection 






@section('scripts')

  <script type="text/javascript">

    @if(Session::has('SOOP_CREATE_SUCCESS'))
      $('#soop_create').modal('show');
    @endif


    {{-- ADD ROW --}}
    $(document).ready(function() {
      $("#add_row").on("click", function() {
        var i = $("#table_body").children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][sugar_service_id]" class="form-control" placeholder="Service">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                        '</td>' +

                        '<td>' +
                            '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                        '</td>' +

                      '</tr>';
        $("#table_body").append($(content));
      });
    });



  </script>
    
@endsection