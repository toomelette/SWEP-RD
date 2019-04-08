<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRA Web Portal - RD</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.css-plugins')

    @yield('css')

  </head>
  <body class="hold-transition {!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}">

    <div id="loader"></div>

    <div class="wrapper">

      @include('layouts.admin-topnav')

      @include('layouts.admin-sidenav') 

      <div class="content-wrapper" style="height:500em;"> 

        @yield('content')

      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="#">MIS-VISAYAS</a>.</strong> All rights
        reserved.
      </footer>

    </div>

    @include('layouts.js-plugins')
    
    @yield('modals')

    @yield('scripts')

  </body>

</html>