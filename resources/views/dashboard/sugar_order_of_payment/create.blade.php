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
      
      <form method="POST" action="{{ route('dashboard.sugar_order_of_payment.store') }}">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf

            {!! __form::select_static(
              '4', 'customer_type', 'Customer Type *', old('customer_type'), ['Walk in / Trader' => 'CT1001', 'Milling Company' => 'CT1002'], $errors->has('customer_type'), $errors->first('customer_type'), '', ''
            ) !!}

            {{-- IF WALK IN --}}
            <div class="col-md-4 no-padding" id="recieved_from_div">
              {!! __form::textbox(
                '12', 'received_from', 'text', 'Received From *', 'Recieved From', old('received_from'), $errors->has('received_from'), $errors->first('received_from'), 'data-transform="uppercase"'
              ) !!}
            </div>
            
            {{-- IF MILL --}}
            <div class="col-md-4 no-padding" id="mill_div">
              {!! __form::select_dynamic(
                '12', 'mill_id', 'Milling Company *', old('mill_id'), $global_mills_all, 'mill_id', 'name', $errors->has('mill_id'), $errors->first('mill_id'), 'select2', ''
              ) !!}
            </div>

            {!! __form::textbox(
              '4', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), 'data-transform="uppercase"'
            ) !!}

            <div class="col-md-12"></div>

            {!! __form::textbox(
              '4', 'sample_no', 'text', 'Sample No. *', 'Sample No.', old('sample_no'), $errors->has('sample_no'), $errors->first('sample_no'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date',  'Date Received *', old('date'), $errors->has('date'), $errors->first('date')
            ) !!}

            {!! __form::textbox(
              '4', 'sugar_sample', 'text', 'Kind of Sample *', 'Kind of Sample', old('sugar_sample'), $errors->has('sugar_sample'), $errors->first('sugar_sample'), 'data-transform="uppercase"'
            ) !!}

            <div class="col-md-12"></div>

            {!! __form::textbox(
              '4', 'received_by', 'text', 'Received By *', 'Received By', old('received_by'), $errors->has('received_by'), $errors->first('received_by'), 'data-transform="uppercase"'
            ) !!}

          </div>


          {{-- Sugar Services --}}

          <div class="col-md-12" style="padding:30px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Services</h3>
              </div>
              
              <div class="box-body no-padding">

                <table class="table table-bordered">
                  <tr>
                    <th>Kind of Analysis</th>
                    <th>Price</th>
                  </tr>
                  @foreach ($global_sugar_service_all as $data)
                  <tr>  
                  
                    <td>
                      <label>
                        <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}">
                        &nbsp; {{ $data->name }}
                      </label>
                    </td>

                    <td>Php {{ $data->price }}</td>

                  </tr>
                  @endforeach
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

  @if(Session::has('SUGAR_OOP_CREATE_SUCCESS'))

    {!! __html::modal_print(
      'soop_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SUGAR_OOP_CREATE_SUCCESS'), route('dashboard.sugar_order_of_payment.show', Session::get('SUGAR_OOP_CREATE_SUCCESS_SLUG'))
    ) !!}
  
  @endif

@endsection 






@section('scripts')

  <script type="text/javascript">

    @if(Session::has('SUGAR_OOP_CREATE_SUCCESS'))
      $('#soop_create').modal('show');
    @endif


    @if(old('customer_type') == "CT1001")
      $( document ).ready(function() {
        $('#recieved_from_div').show();
        $('#mill_div').hide();
        $('#mill_id').attr("disabled", true);
      });
    @elseif(old('customer_type') == "CT1002")
      $( document ).ready(function() {
        $('#mill_div').show();
        $('#recieved_from_div').hide();
      });
    @else
      $( document ).ready(function() {
        $('#recieved_from_div').show();
        $('#mill_div').hide();
      });
    @endif


    $(document).on("change", "#customer_type", function () {
      $('#received_from').val('');
      $('#address').val('');
      var val = $(this).val();
        if(val == "CT1001"){ 
          $('#recieved_from_div').show();
          $('#mill_div').hide();
          $('#mill_id').attr("disabled", true);
        }else if(val == "CT1002"){
          $('#mill_div').show();
          $('#mill_id').removeAttr("disabled");
          $('#recieved_from_div').hide();
        }else{
          $('#recieved_from_div').show();
          $('#mill_div').hide();
        }
    });


    {!! __js::ajax_select_to_input(
      'mill_id', 'address', '/api/mill/input_mill_byMillId/', 'address'
    ) !!}


    {!! __js::ajax_select_to_input(
      'mill_id', 'received_from', '/api/mill/input_mill_byMillId/', 'name'
    ) !!}

    
  </script>
    
@endsection