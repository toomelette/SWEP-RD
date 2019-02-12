@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Edit Mill</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.mill.update', $mill->slug) }}">

        <div class="box-body">

          <input name="_method" value="PUT" type="hidden">
                
          @csrf    

          {!! __form::textbox(
            '2', 'mill_id', 'text', 'Mill Id *', 'Mill Id', old('mill_id') ? old('mill_id') : $mill->mill_id, $errors->has('mill_id'), $errors->first('mill_id'), ''
          ) !!}

          {!! __form::textbox(
            '5', 'name', 'text', 'Company Name *', 'Company Name', old('name') ? old('name') : $mill->name, $errors->has('name'), $errors->first('name'), ''
          ) !!}    

          {!! __form::textbox(
            '5', 'address', 'text', 'Address *', 'Address', old('address') ? old('address') : $mill->address, $errors->has('address'), $errors->first('address'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection