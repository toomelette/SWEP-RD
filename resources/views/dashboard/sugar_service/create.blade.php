@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create Laboratory Service</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sugar_service.store') }}">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf    

            {!! __form::textbox(
              '3', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
            ) !!}

            {!! __form::textbox_numeric(
              '3', 'price', 'text', 'Price *', 'Price', old('price'), $errors->has('price'), $errors->first('price'), ''
            ) !!}

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

  </script>
    
@endsection