@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Add Sugar Sample</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" action="{{ route('dashboard.sugar_sample.store') }}" autocomplete="off">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf

            {!! __form::textbox(
              '4', 'name', 'text', 'Name of Sample *', 'Name of Sample', old('name'), $errors->has('name'), $errors->first('name'), 'data-transform="uppercase"'
            ) !!}

          </div>




          {{-- Sugar Services/Parameters --}}
          <div class="col-md-12" style="padding:30px;" id="ss_id">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><b>Parameters</b></h3>
              </div>
              
              <div class="box-body no-padding">

                <table class="table table-bordered">
                  <tr>
                    <th>Kind of Analysis</th>
                    <th>Standards</th>
                  </tr>
                  @foreach ($global_sugar_service_all as $data)
                  <tr>  
                  
                    <td>
                      <label>
                        <input type="checkbox" class="minimal" name="sugar_service_id[]" value="{{ $data->sugar_service_id }}"
                        {{ is_array(old('sugar_service_id')) && in_array($data->sugar_service_id, old('sugar_service_id')) ? 'checked' : '' }}>
                        &nbsp; {{ $data->name }}
                      </label>
                    </td>

                    <td>{{ $data->standard }}</td>

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





@section('modals')

  @if(Session::has('SUGAR_SAMPLE_CREATE_SUCCESS'))

    {!! __html::modal(
      'ss_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SUGAR_SAMPLE_CREATE_SUCCESS')
    ) !!}
  
  @endif

@endsection 






@section('scripts')

  <script type="text/javascript">

    @if(Session::has('SUGAR_SAMPLE_CREATE_SUCCESS'))
      $('#ss_create').modal('show');
    @endif

  </script>
    
@endsection