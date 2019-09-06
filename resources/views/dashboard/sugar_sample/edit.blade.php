<?php
  
  $ss_id_array = $sugar_sample->sugarSampleParameter->pluck('sugar_service_id')->toArray();

?>

@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Edit Sugar Sample</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.sugar_sample.index', 'dashboard.sugar_sample.show']) !!}
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
      
      <form method="POST" action="{{ route('dashboard.sugar_sample.update', $sugar_sample->slug) }}" autocomplete="off">

        <div class="box-body">

          <div class="col-md-12">
                    
            @csrf

            <input name="_method" value="PUT" type="hidden">

            {!! __form::textbox(
              '4', 'name', 'text', 'Name of Sample *', 'Name of Sample', old('name') ? old('name') : $sugar_sample->name, $errors->has('name'), $errors->first('name'), ''
            ) !!}

          </div>


          {{-- Sugar Services --}}

          <div class="col-md-12" style="padding:30px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Services</h3>
              </div>
              
              <div class="box-body no-padding">

                <table class="table table-bordered">
                  <tr>
                    <th>Kind of Analysis</th>
                    <th>Price</th>
                  </tr>
                  @foreach ($global_sugar_service_all as $data)
                  <tr>  

                    @if(is_array(old('sugar_service_id')))

                      <td>
                        <label>
                          <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                          {{ in_array($data->sugar_service_id, old('sugar_service_id')) ? 'checked' : '' }}>
                          &nbsp; {{ $data->name }}
                        </label>
                      </td>

                    @else

                      <td>
                        <label>
                          <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                          {{ in_array($data->sugar_service_id, $ss_id_array) ? 'checked' : '' }}>
                          &nbsp; {{ $data->name }}
                        </label>
                      </td>

                    @endif

                    <td>{{ number_format($data->price, 2) }}</td>

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