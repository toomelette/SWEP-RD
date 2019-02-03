@extends('layouts.admin-master')

@section('content')

<section class="content-header">
  <h1>Order Of Payment Details</h1>
  <div class="pull-right" style="margin-top: -25px;">
    {!! __html::back_button(['dashboard.sugar_order_of_payment.index']) !!}
  </div>
</section>

<section class="content">
  
  <div class="box">
        
    <div class="box-header with-border">
      <h3 class="box-title">Details</h3>
      <div class="box-tools">
        <a href="{{ route('dashboard.sugar_order_of_payment.edit', $sugar_oop->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
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
              <dt>Date:</dt>
              <dd>{{ __dataType::date_parse($sugar_oop->date, 'F d,Y') }}</dd>
              <dt>Sample No:</dt>
              <dd>{{ $sugar_oop->sample_no }}</dd>
              <dt>Received From:</dt>
              <dd>{{ $sugar_oop->received_from }}</dd>
              <dt>Address:</dt>
              <dd>{{ $sugar_oop->address }}</dd>
              <dt>Sugar Sample:</dt>
              <dd>{{ $sugar_oop->sugar_sample }}</dd>
              <dt>Received By:</dt>
              <dd>{{ $sugar_oop->received_by }}</dd>
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
                  <th>Kind Of Analysis</th>
                  <th>Price</th>
              </tr>  

              @foreach($sugar_oop->sugarAnalysisParameter as $data)
                <tr>
                    <td>{{ $data->sugar_service_name }}</td>
                    <td>{{ $data->price }}</td>
                </tr> 
              @endforeach

              <tr>
                  <td><b>Total Price</b></td>
                  <td><b>{{ $sugar_oop->total_price }}</b></td>
              </tr>

            </table>

          </div>
        </div>
      </div>



    </div>

  </div>

</section>

@endsection
