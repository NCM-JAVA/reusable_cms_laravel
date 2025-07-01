

<div class="main-sidebar sidebar-style-2 shadow-lg">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <?php
             $langid=1;
             $res= admin_sidebar($langid) ; ?>
            <a target="_blank" href="{{ url('/')}}">{{ !empty(get_setting($langid)->website_name)?substr(get_setting($langid)->website_name,0,20):'Website Name' }} </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a target="_blank" href="{{ url('/')}}">{{ !empty(get_setting($langid)->website_short_name)?get_setting($langid)->website_short_name:'W N' }} </a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a href="{{ url('/home')}}" class="nav-link"><i class="bi bi-display" aria-hidden="true"></i><span>Dashboard</span></a>
            </li>
           
             @foreach($res as $mod)
                @php 
                    $pro=module_permission(Auth()->user()->id);
                    $old=array();
                    if($pro){
                      $old= explode(',',$pro->module_id);
                    }
                @endphp
                @if(in_array($mod->id, $old))
                <li class="@if($mod->slug=='#') dropdown @endif">
                    <a href="@if($mod->slug=='#') '' @else {{ url('/') }}/{{$mod->slug}} @endif" class="nav-link @if($mod->slug=='#')  has-dropdown @endif"><i class="fa-solid fa-greater-than"></i><span>{{$mod->module_name}}</span></a>
                    @if($mod->slug=='#')
                    <ul class="dropdown-menu">
                    <?php
                        $langid=1;
                        $resch= admin_sidebar_chid($langid,$mod->id) ; ?>
                         @foreach($resch as $modch)
                         
                            <li class="@if($modch->slug=='#') dropdown @endif">
                                <a href="{{ url('/') }}/{{$modch->slug}}" class="nav-link"><i class="fa-solid fa-greater-than"></i><span>{{$modch->module_name}}</span></a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @else
                    @if(Auth::user() &&  Auth::user()->user_type == 1)

                        <?php
                            $langid=1;
                            $resch= admin_sidebar_chid($langid,$mod->id) ; 
                            $isParentActive = collect($resch)->contains(function ($modch) {
                                return Request::is($modch->slug) || Request::is($modch->slug . '/*');
                            });
                        ?>

                        <li class="@if($mod->slug=='#') dropdown @endif {{ (Request::is($mod->slug) || $isParentActive || Request::is($mod->slug . '/*')) ? 'active' : '' }}" >
                            <a href="@if($mod->slug=='#') '' @else {{ url('/') }}/{{$mod->slug}} @endif" class="rounded-3 nav-link @if($mod->slug=='#')  has-dropdown @endif {{ (Request::is($mod->slug) || $isParentActive || Request::is($mod->slug . '/*')) ? 'active' : '' }}"><i class="fa-solid fa-angles-right"></i><span>{{$mod->module_name}}</span></a>
                            @if($mod->slug=='#')

                            <ul class="dropdown-menu">
                                @foreach($resch as $modch)
                                    <li class="@if($modch->slug=='#') dropdown @endif {{ (Request::is($modch->slug) || Request::is($modch->slug . '/*')) ? 'active' : '' }}">
                                        <a href="{{ url('/') }}/{{$modch->slug}}" class="nav-link {{ (Request::is($modch->slug) || Request::is($modch->slug . '/*')) ? 'active' : '' }}"><i class="{{$modch->icons}}"></i><span>{{$modch->module_name}}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                            
                            @endif
                        </li>
                    @endif
                @endif
            @endforeach
                 
           
        </ul>
    </aside>
</div>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{$title}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="{{ url('/admin/dashboard')}}">Dashboard</a></div>
              <div class="breadcrumb-item active">{{$title}}</div>
            </div>
          </div>
          <div class="section-body">