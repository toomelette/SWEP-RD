<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('images/avatar.jpeg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        
        @if(Auth::check())
          <p>{{ Auth::user()->firstname }}</p>
        @endif

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      

      @if(Auth::check())



      {{-- User --}}
      @if(!$global_user_menus_u->isEmpty())

          <li class="header">NAVIGATION</li>
          @foreach($global_user_menus_u as $user_menu)

            @if($user_menu->is_menu == true)

              @if($user_menu->is_dropdown == false)

              <li class="{!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                <a href="{{ route($user_menu->route) }}">
                  <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                </a>
              </li>

              @else

                <li class="treeview {!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                  <a href="#">
                    <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      @foreach($user_menu->userSubMenu as $user_nav)

                        @if($user_nav->is_nav == true)

                          <li class="{!! Route::currentRouteNamed($user_nav->route) ? 'active' : '' !!}">
                            <a href="{{ route($user_nav->route) }}"><i class="fa fa-caret-right"></i> {{ $user_nav->name }}</a>
                          </li>

                        @endif

                      @endforeach

                    </ul>

                </li>

              @endif

            @endif

          @endforeach

        @endif




        {{-- SU --}}
        @if(!$global_user_menus_su->isEmpty())

          <li class="header">SUPER USER</li>
          @foreach($global_user_menus_su as $user_menu)

            @if($user_menu->is_menu == true)

              @if($user_menu->is_dropdown == false)

              <li class="{!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                <a href="{{ route($user_menu->route) }}">
                  <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                </a>
              </li>

              @else

                <li class="treeview {!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                  <a href="#">
                    <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      @foreach($user_menu->userSubMenu as $user_nav)

                        @if($user_nav->is_nav == true)

                          <li class="{!! Route::currentRouteNamed($user_nav->route) ? 'active' : '' !!}">
                            <a href="{{ route($user_nav->route) }}"><i class="fa fa-caret-right"></i> {{ $user_nav->name }}</a>
                          </li>

                        @endif

                      @endforeach

                    </ul>

                </li>

              @endif

            @endif

          @endforeach

        @endif




        {{-- SGRLAB --}}
        @if(!$global_user_menus_sgrlab->isEmpty())

          <li class="header">SUGAR LABORATORY</li>
          @foreach($global_user_menus_sgrlab as $user_menu)

            @if($user_menu->is_menu == true)

              @if($user_menu->is_dropdown == false)

              <li class="{!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                <a href="{{ route($user_menu->route) }}">
                  <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                </a>
              </li>

              @else

                <li class="treeview {!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                  <a href="#">
                    <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      @foreach($user_menu->userSubMenu as $user_nav)

                        @if($user_nav->is_nav == true)

                          <li class="{!! Route::currentRouteNamed($user_nav->route) ? 'active' : '' !!}">
                            <a href="{{ route($user_nav->route) }}"><i class="fa fa-caret-right"></i> {{ $user_nav->name }}</a>
                          </li>

                        @endif

                      @endforeach

                    </ul>

                </li>

              @endif

            @endif

          @endforeach

        @endif




        {{-- REGU --}}
        @if(!$global_user_menus_regu->isEmpty())

          <li class="header">REGULATION</li>
          @foreach($global_user_menus_regu as $user_menu)

            @if($user_menu->is_menu == true)

              @if($user_menu->is_dropdown == false)

              <li class="{!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                <a href="{{ route($user_menu->route) }}">
                  <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                </a>
              </li>

              @else

                <li class="treeview {!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
                  <a href="#">
                    <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>

                    <ul class="treeview-menu">

                      @foreach($user_menu->userSubMenu as $user_nav)

                        @if($user_nav->is_nav == true)

                          <li class="{!! Route::currentRouteNamed($user_nav->route) ? 'active' : '' !!}">
                            <a href="{{ route($user_nav->route) }}"><i class="fa fa-caret-right"></i> {{ $user_nav->name }}</a>
                          </li>

                        @endif

                      @endforeach

                    </ul>

                </li>

              @endif

            @endif

          @endforeach

        @endif


          
      @endif

    </ul>
  </section>
</aside>