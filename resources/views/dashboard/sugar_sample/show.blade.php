@extends('layouts.admin-master')

@section('content')

<section class="content-header">
  <h1>Sugar Sample Details</h1>
  <div class="pull-right" style="margin-top: -25px;">
    {!! __html::back_button(['dashboard.sugar_sample.index']) !!}
  </div>
</section>

<section class="content">
  
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Sugar Sample Info</h3>
    </div>

    <div class="box-body">


      <dl class="dl-horizontal" style="margin-left:-55px;">
        <dt>Name of Sample:</dt>
        <dd>{{ $sugar_sample->name }}</dd>
      </dl>

      <h5><b>PARAMETERS:</b></h5>

      <table class="table table-bordered">
        <tr>
            <th>Kind Of Analysis</th>
        </tr>  
        @foreach($sugar_sample->sugarSampleParameter as $data)
          <tr>
              <td>{{ $data->name }}</td>
          </tr> 
        @endforeach
      </table>


    </div>

  </div>

</section>

@endsection
