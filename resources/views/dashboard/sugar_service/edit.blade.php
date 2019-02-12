@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Edit Laboratory Service</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sugar_service.update', $sugar_service->slug) }}">

        <div class="box-body">
            
          <input name="_method" value="PUT" type="hidden">

          @csrf    

          {!! __form::textbox(
            '3', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $sugar_service->name, $errors->has('name'), $errors->first('name'), ''
          ) !!}

          {!! __form::textbox_numeric(
            '3', 'price', 'text', 'Price *', 'Price', old('price') ? old('price') : $sugar_service->price, $errors->has('price'), $errors->first('price'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection