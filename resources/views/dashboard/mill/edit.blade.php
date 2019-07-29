@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Edit Mill</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.mill.index']) !!}
    </div>
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
            '4', 'mill_id', 'text', 'Mill Id *', 'Mill Id', old('mill_id') ? old('mill_id') : $mill->mill_id, $errors->has('mill_id'), $errors->first('mill_id'), ''
          ) !!}

          {!! __form::textbox(
            '4', 'name', 'text', 'Company Name *', 'Company Name', old('name') ? old('name') : $mill->name, $errors->has('name'), $errors->first('name'), ''
          ) !!}    

          {!! __form::textbox(
            '4', 'short_name', 'text', 'Short Name / Acronym *', 'Short Name / Acronym', old('short_name') ? old('short_name') : $mill->short_name, $errors->has('short_name'), $errors->first('short_name'), ''
          ) !!}   

          <div class="col-md-12"></div>

          {!! __form::textbox(
            '4', 'address', 'text', 'Address *', 'Address', old('address') ? old('address') : $mill->address, $errors->has('address'), $errors->first('address'), ''
          ) !!}

          {!! __form::select_static(
            '4', 'district', 'Mill District *', old('district') ? old('district') : $mill->district, __static::lmd_mill_districts(), $errors->has('district'), $errors->first('district'), '', ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection