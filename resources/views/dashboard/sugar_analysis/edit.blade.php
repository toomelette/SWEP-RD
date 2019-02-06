
@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Fill Up Results</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.sugar_analysis.index']) !!}
    </div>
</section>

<section class="content">
    


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
          <dt>Origin:</dt>
          <dd>{{ $sa->origin }}</dd>
          <dt>Address:</dt>
          <dd>{{ $sa->address }}</dd>
          <dt>Charge:</dt>
          <dd>Php {{ number_format($sa->total_price, 2) }}</dd>
        </dl>
      </div>
    </div>
  </div>




  <div class="col-md-12">
    <div class="box">
      
      <div class="box-header with-border">
        <h3 class="box-title">Results</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" action="{{ route('dashboard.sugar_analysis.update', $sa->slug) }}">

        <div class="box-body">

          @csrf

          <input name="_method" value="PUT" type="hidden">

          {!! __form::datepicker(
            '3', 'week_ending',  'Week Ending *', old('week_ending') ? old('week_ending') : __dataType::date_parse($sa->week_ending), $errors->has('week_ending'), $errors->first('week_ending')
          ) !!}

          {!! __form::datepicker(
            '3', 'date_sampled',  'Date Sampled *', old('date_sampled') ? old('date_sampled') : __dataType::date_parse($sa->date_sampled), $errors->has('date_sampled'), $errors->first('date_sampled')
          ) !!}

          {!! __form::datepicker(
            '3', 'date_submitted',  'Date Submitted *', old('date_submitted') ? old('date_submitted') : __dataType::date_parse($sa->date_submitted), $errors->has('date_submitted'), $errors->first('date_submitted')
          ) !!}

          {!! __form::datepicker(
            '3', 'date_analyzed',  'Date Analyzed *', old('date_analyzed') ? old('date_analyzed') : __dataType::date_parse($sa->date_analyzed), $errors->has('date_analyzed'), $errors->first('date_analyzed')
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::textbox_numeric(
            '3', 'quantity', 'text', 'Quantity *', 'Quantity', old('quantity') ? old('quantity') : $sa->quantity, $errors->has('quantity'), $errors->first('quantity'), ''
          ) !!}

          {!! __form::textbox(
            '9', 'description', 'text', 'Description *', 'Description', old('description') ? old('description') : $sa->description, $errors->has('description'), $errors->first('description'), 'data-transform="uppercase"'
          ) !!}

          </div>




          <div class="col-md-12">

            @foreach ($sa->sugarAnalysisParameter as $data)


              @if($data->sugar_service_id == "SS1001")
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Polarization</h3> 
                  </div>
                  <div class="box-body">



                  </div>
                </div>



              @elseif($data->sugar_service_id == "SS1002")
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Color UI</h3> 
                  </div>
                  <div class="box-body">



                  </div>
                </div>



              @elseif($data->sugar_service_id == "SS1003")
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Moisture</h3> 
                  </div>
                  <div class="box-body">



                  </div>
                </div>



              @elseif($data->sugar_service_id == "SS1004")
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Ash</h3> 
                  </div>
                  <div class="box-body">



                  </div>
                </div>



              @elseif($data->sugar_service_id == "SS1005")
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Grain Size</h3> 
                  </div>
                  <div class="box-body">



                  </div>
                </div>


              @endif

            @endforeach
          </div>



          <div class="box-footer">
            <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
          </div>

        </form>

      </div>
    </div>



</section>

@endsection






@section('scripts')

  <script type="text/javascript">

    
  </script>
    
@endsection