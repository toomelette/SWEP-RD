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
              '4', 'customer_type', 'Customer Type *', old('customer_type'), ['Walk in / Trader' => 'CT1001', 'Milling Company' => 'CT1002'], $errors->has('customer_type'), $errors->first('customer_type'), '', ''
            ) !!}

            {{-- IF WALK IN --}}
            <div class="col-md-4 no-padding" id="recieved_from_div">
              {!! __form::textbox(
                '12', 'received_from', 'text', 'Received From *', 'Recieved From', old('received_from'), $errors->has('received_from'), $errors->first('received_from'), ''
              ) !!}
            </div>
            
            {{-- IF MILL --}}
            <div class="col-md-4 no-padding" id="mill_div">
              {!! __form::select_dynamic(
                '12', 'mill_id', 'Milling Company *', old('mill_id'), $global_mills_all, 'mill_id', 'name', $errors->has('mill_id'), $errors->first('mill_id'), 'select2', ''
              ) !!}
            </div>

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



          {{-- Sugar Services --}}
          <div class="col-md-12" style="padding-top:20px;">
            <div class="box box-solid">

              <div class="box-header">
                <h3 class="box-title">Kind of Analysis *</h3>
              </div>

              <div class="box-body">
                
                <div class="form-group" style="margin-left: 15px;">

                  <label>
                    <input type="checkbox" class="minimal" name="test[]" value="1">
                    &nbsp; Services 1
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" class="minimal" name="test[]" value="2">
                    &nbsp; Services 2
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" class="minimal" name="test[]" value="3">
                    &nbsp; Services 3
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" class="minimal" name="test[]" value="4">
                    &nbsp; Services 4
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" class="minimal" name="test[]" value="5">
                    &nbsp; Services 5
                  </label>
                  <br>

                </div>

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


    $('#recieved_from_div').show();
    $('#mill_div').hide();


    $(document).on("change", "#customer_type", function () {
      $('#received_from').val('');
      $('#address').val('');
      var val = $(this).val();
        if(val == "CT1001"){ 
          $('#recieved_from_div').show();
          $('#mill_div').hide();
        }else if(val == "CT1002"){
          $('#recieved_from_div').hide();
          $('#mill_div').show();
        }else{
          $('#recieved_from_div').show();
          $('#mill_div').hide();
        }
    });


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