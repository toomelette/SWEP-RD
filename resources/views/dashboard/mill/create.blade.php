@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create Mill</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.mill.store') }}">

        <div class="box-body">
                  
          @csrf    

          {!! __form::textbox(
            '2', 'mill_id', 'text', 'Mill Id *', 'Mill Id', old('mill_id'), $errors->has('mill_id'), $errors->first('mill_id'), ''
          ) !!}

          {!! __form::textbox(
            '5', 'name', 'text', 'Company Name *', 'Company Name', old('name'), $errors->has('name'), $errors->first('name'), ''
          ) !!}    

          {!! __form::textbox(
            '5', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection





@section('modals')

  @if(Session::has('MILL_CREATE_SUCCESS'))

    {!! __html::modal(
      'mill_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('MILL_CREATE_SUCCESS')
    ) !!}
  
  @endif

@endsection 






@section('scripts')

  <script type="text/javascript">

    @if(Session::has('MILL_CREATE_SUCCESS'))
      $('#mill_create').modal('show');
    @endif

  </script>
    
@endsection