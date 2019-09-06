<?php
  
  $raw_sugar_services = $global_sugar_sample_parameter_raw_sugar->pluck('sugar_service_id')->toArray();
  $muscovado_services = $global_sugar_sample_parameter_muscovado->pluck('sugar_service_id')->toArray();
  $molasses_services = $global_sugar_sample_parameter_molasses->pluck('sugar_service_id')->toArray();
  $cja_services = $global_sugar_sample_parameter_cja->pluck('sugar_service_id')->toArray();

  $sugar_samples = __static::sugar_samples();

?>



@extends('layouts.admin-master')



@section('css')

  <link type="text/css" rel="stylesheet" href="{{ asset('template/plugins/jquery-ui/jquery-ui.css') }}">

@endsection



@section('content')

<section class="content-header">
    <h1>Add Order Of Payment</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" action="{{ route('dashboard.sugar_order_of_payment.store') }}" autocomplete="off">

        <div class="box-body">

          <div class="col-md-5">
                    
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Fields</h3>
              </div>
              <div class="box-body">

                @csrf

                {!! __form::select_dynamic(
                  '12', 'sugar_sample_id', 'Kind of Sample *', old('sugar_sample_id'), $global_sugar_samples_all, 'sugar_sample_id', 'name', $errors->has('sugar_sample_id'), $errors->first('sugar_sample_id'), '', ''
                ) !!}

                {!! __form::select_static(
                  '12', 'customer_type', 'Customer Type *', old('customer_type'), ['Walk in / Trader' => 'CT1001', 'Milling Company' => 'CT1002'], $errors->has('customer_type'), $errors->first('customer_type'), '', ''
                ) !!}

                {{-- IF WALK IN --}}
                <div class="col-md-12 no-padding" id="recieved_from_div">

                  {!! __form::textbox(
                    '12', 'received_from', 'text', 'Received From *', 'Recieved From', old('received_from'), $errors->has('received_from'), $errors->first('received_from'), 'data-transform="uppercase"'
                  ) !!}

                  <input type="hidden" name="sugar_client_id" id="sugar_client_id" value="{{ old('sugar_client_id') }}">

                </div>

                {{-- IF MILL --}}
                <div class="col-md-12 no-padding" id="mill_div">
                  {!! __form::select_dynamic(
                    '12', 'mill_id', 'Milling Company *', old('mill_id'), $global_mills_all, 'mill_id', 'name', $errors->has('mill_id'), $errors->first('mill_id'), 'select2', ''
                  ) !!}
                </div>

                {!! __form::textbox(
                  '12', 'address', 'text', 'Address ', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
                ) !!}

                {!! __form::datepicker(
                  '12', 'date',  'Date Received *', old('date') ? old('date') : Carbon::now()->format('m/d/Y'), $errors->has('date'), $errors->first('date')
                ) !!}

                <div class="col-md-12 no-padding" id="cja_num_of_samples_div">
                  {!! __form::textbox(
                    '12', 'cja_num_of_samples', 'text', 'Number of Cane Juice Samples *', 'Number of Cane Juice Samples', old('cja_num_of_samples'), $errors->has('cja_num_of_samples'), $errors->first('cja_num_of_samples'), ''
                  ) !!}
                </div>

                {!! __form::textbox(
                  '12', 'received_by', 'text', 'Received By', 'Received By', old('received_by'), $errors->has('received_by'), $errors->first('received_by'), 'data-transform="uppercase"'
                ) !!}


              </div>
            </div>

          </div>



          {{-- Sugar Services --}}

          <div class="col-md-7">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Services</h3>
              </div>
              
              <div class="box-body no-padding">


                {{-- OLD VALUE --}}      
                @if(is_array(old('sugar_service_id')))         
                  <table class="table table-bordered" id="old_table">
                    <tr>
                      <th>Kind of Analysis</th>
                      <th>Price</th>
                    </tr>
                    @foreach ($global_sugar_service_all as $data)
                      <tr>  
                        <td>
                          <label>
                            <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                            {{ in_array($data->sugar_service_id, old('sugar_service_id')) ? 'checked' : '' }}>
                            &nbsp; {{ $data->name }}
                          </label>
                        </td>
                        <td>Php {{ number_format($data->price, 2) }}</td>
                      </tr>
                    @endforeach
                  </table>
                @endif 


                {{-- DEFAULT --}}
                <table class="table table-bordered" id="default">
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
                      <td>Php {{ number_format($data->price, 2) }}</td>
                    </tr>
                  @endforeach
                </table>


                {{-- RAW SUGAR SERVICES --}}
                <table class="table table-bordered" id="raw_sugar">
                  <tr>
                    <th>Kind of Analysis</th>
                    <th>Price</th>
                  </tr>
                  @foreach ($global_sugar_service_all as $data)
                    <tr>  
                      <td>
                        <label>
                          <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                          {{ in_array($data->sugar_service_id, $raw_sugar_services) ? 'checked' : '' }}>
                          &nbsp; {{ $data->name }}
                        </label>
                      </td>
                      <td>Php {{ number_format($data->price, 2) }}</td>
                    </tr>
                  @endforeach
                </table>


                {{-- MUSCOVADO SERVICES --}}
                <table class="table table-bordered" id="muscovado">
                  <tr>
                    <th>Kind of Analysis</th>
                    <th>Price</th>
                  </tr>
                  @foreach ($global_sugar_service_all as $data)
                    <tr>  
                      <td>
                        <label>
                          <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                          {{ in_array($data->sugar_service_id, $muscovado_services) ? 'checked' : '' }}>
                          &nbsp; {{ $data->name }}
                        </label>
                      </td>
                      <td>Php {{ number_format($data->price, 2) }}</td>
                    </tr>
                  @endforeach
                </table>


                {{-- MOLASSES SERVICES --}}
                <table class="table table-bordered" id="molasses">
                  <tr>
                    <th>Kind of Analysis</th>
                    <th>Price</th>
                  </tr>
                  @foreach ($global_sugar_service_all as $data)
                    <tr>  
                      <td>
                        <label>
                          <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                          {{ in_array($data->sugar_service_id, $molasses_services) ? 'checked' : '' }}>
                          &nbsp; {{ $data->name }}
                        </label>
                      </td>
                      <td>Php {{ number_format($data->price, 2) }}</td>
                    </tr>
                  @endforeach
                </table>


                {{-- CANE JUICE SERVICES --}}
                <table class="table table-bordered" id="cja">
                  <tr>
                    <th>Kind of Analysis</th>
                    <th>Price</th>
                  </tr>
                  @foreach ($global_sugar_service_all as $data)
                    <tr>  
                      <td>
                        <label>
                          <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                          {{ in_array($data->sugar_service_id, $cja_services) ? 'checked' : '' }}>
                          &nbsp; {{ $data->name }}
                        </label>
                      </td>
                      <td>Php {{ number_format($data->price, 2) }}</td>
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
  
  <script type="text/javascript" src="{{ asset('template/plugins/jquery-ui/jquery-ui.js') }}"></script>

  <script type="text/javascript">


    @if(Session::has('SUGAR_OOP_CREATE_SUCCESS'))
      $('#soop_create').modal('show');
    @endif



    {{-- CUSTOMER TYPE --}}
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
        $('#sugar_client_id').attr("disabled", true);
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
          $('#sugar_client_id').removeAttr("disabled");
          $('#mill_div').hide();
          $('#mill_id').attr("disabled", true);
        }else if(val == "CT1002"){
          $('#mill_div').show();
          $('#mill_id').removeAttr("disabled");
          $('#recieved_from_div').hide();
          $('#sugar_client_id').attr("disabled", true);
        }else{
          $('#recieved_from_div').show();
          $('#mill_div').hide();
        }
    });


    

    {{-- SUGAR SAMPLE SERVICES --}}
    @if (is_array(old('sugar_service_id')))

      $( document ).ready(function() {
        
        $('#default').hide();
        $("#default input").attr("disabled", true);
        $('#raw_sugar').hide();
        $("#raw_sugar input").attr("disabled", true);
        $('#muscovado').hide();
        $("#muscovado input").attr("disabled", true);
        $('#molasses').hide();
        $("#molasses input").attr("disabled", true);
        $('#cja').hide();
        $("#cja input").attr("disabled", true);

      });

    @elseif(old('sugar_sample_id') == "SS1006")

      $( document ).ready(function() {
        
        $('#default').hide();
        $("#default input").attr("disabled", true);
        $('#raw_sugar').hide();
        $("#raw_sugar input").attr("disabled", true);
        $('#muscovado').hide();
        $("#muscovado input").attr("disabled", true);
        $('#molasses').hide();
        $("#molasses input").attr("disabled", true);
        $('#cja').show();
        $("#cja input").removeAttr("disabled");

      });

    @else

      $( document ).ready(function() {

        $('#default').show();
        $("#default input").attr("disabled", true);
        $('#raw_sugar').hide();
        $("#raw_sugar input").attr("disabled", true);
        $('#muscovado').hide();
        $("#muscovado input").attr("disabled", true);
        $('#molasses').hide();
        $("#molasses input").attr("disabled", true);
        $('#cja').hide();
        $("#cja input").attr("disabled", true);

      });

    @endif



    $(document).on("change", "#sugar_sample_id", function () {

      var val = $(this).val();

        if(val == "SS1001"){ 

          $('#raw_sugar').show();
          $("#raw_sugar input").removeAttr('disabled');
          $('#old_table').hide();
          $("#old_table input").attr("disabled", true);
          $('#default').hide();
          $("#default input").attr("disabled", true);
          $('#muscovado').hide();
          $("#muscovado input").attr("disabled", true);
          $('#molasses').hide();
          $("#molasses input").attr("disabled", true);
          $('#cja').hide();
          $("#cja input").attr("disabled", true);

          {{-- Number of Cane Juice Samples --}}
          $('#cja_num_of_samples_div').hide();
          $('#cja_num_of_samples').attr("disabled", true);

        }else if(val == "SS1003"){

          $('#muscovado').show();
          $("#muscovado input").removeAttr('disabled');
          $('#old_table').hide();
          $("#old_table input").attr("disabled", true);
          $('#default').hide();
          $("#default input").attr("disabled", true);
          $('#raw_sugar').hide();
          $("#raw_sugar input").attr("disabled", true); $('#molasses').hide();
          $("#molasses input").attr("disabled", true);
          $('#cja').hide();
          $("#cja input").attr("disabled", true);

          {{-- Number of Cane Juice Samples --}}
          $('#cja_num_of_samples_div').hide();
          $('#cja_num_of_samples').attr("disabled", true);

        }else if(val == "SS1004"){ 

          $('#molasses').show();
          $("#molasses input").removeAttr('disabled');
          $('#old_table').hide();
          $("#old_table input").attr("disabled", true);
          $('#default').hide();
          $("#default input").attr("disabled", true);
          $('#raw_sugar').hide();
          $("#raw_sugar input").attr("disabled", true);
          $('#muscovado').hide();
          $("#muscovado input").attr("disabled", true);
          $('#cja').hide();
          $("#cja input").attr("disabled", true);

          {{-- Number of Cane Juice Samples --}}
          $('#cja_num_of_samples_div').hide();
          $('#cja_num_of_samples').attr("disabled", true);

        }else if(val == "SS1006"){ 

          $('#cja').show();
          $("#cja input").removeAttr('disabled');
          $('#old_table').hide();
          $("#old_table input").attr("disabled", true);
          $('#default').hide();
          $("#default input").attr("disabled", true);
          $('#raw_sugar').hide();
          $("#raw_sugar input").attr("disabled", true);
          $('#muscovado').hide();
          $("#muscovado input").attr("disabled", true);
          $('#molasses').hide();
          $("#molasses input").attr("disabled", true);

          {{-- Number of Cane Juice Samples --}}
          $('#cja_num_of_samples_div').show();
          $('#cja_num_of_samples').removeAttr("disabled");

        }else{

          $('#default').show();
          $("#default input").attr("disabled", true);
          $('#old_table').hide();
          $("#old_table input").attr("disabled", true);
          $('#raw_sugar').hide();
          $("#raw_sugar input").attr("disabled", true);
          $('#muscovado').hide();
          $("#muscovado input").attr("disabled", true);
          $('#molasses').hide();
          $("#molasses input").attr("disabled", true);
          $('#cja').hide();
          $("#cja input").attr("disabled", true);

        }

    });

    



    {{-- Number of Cane Juice Samples --}}
    $( document ).ready(function() {
      $('#cja_num_of_samples_div').hide();
      $('#cja_num_of_samples').attr("disabled", true);
    });

    @if (old('sugar_sample_id') == "SS1006")
      $( document ).ready(function() {
        $('#cja_num_of_samples_div').show();
        $('#cja_num_of_samples').removeAttr('disabled');
      });
    @endif




    {{-- MILL --}}
    {!! __js::ajax_select_to_input(
      'mill_id', 'address', '/api/mill/input_mill_byMillId/', 'address'
    ) !!}

    {!! __js::ajax_select_to_input(
      'mill_id', 'received_from', '/api/mill/input_mill_byMillId/', 'name'
    ) !!}




    {{-- RECEIVED FROM AUTOCOMPLETE --}}
    var sugar_clients = {!! $global_sugar_clients_all_json !!};

    $('#received_from').autocomplete({ 
      source: sugar_clients,
      change: function (event, ui){
        $('#sugar_client_id').val(ui.item.id);
        $('#address').val(ui.item.address);
      }
    });



  </script>
    
@endsection