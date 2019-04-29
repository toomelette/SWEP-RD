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
        <h3 class="box-title">Results</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" action="{{ route('dashboard.sugar_analysis.update', $sa->slug) }}">

        <div class="box-body">

          @csrf

          <input name="_method" value="PUT" type="hidden">

          
          <div class="col-md-4">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Form</b></h3>
              </div>
              
              <div class="box-body">

                

              </div> 

            </div>
          </div>

          
          <div class="col-md-8">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><b>List</b></h3>
              </div>
              
              <div class="box-body">

              </div> 

            </div>
          </div>



        </div>


        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

        </form>

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
