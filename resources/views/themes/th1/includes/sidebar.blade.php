

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            
            <a href="{{ url('/')}}">{{ !empty(get_setting()->website_name)?get_setting()->website_name:'Website Name' }} </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/')}}">{{ !empty(get_setting()->website_short_name)?get_setting()->website_short_name:'W N' }} </a>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ url('/home')}}" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Dashboard</span></a>
            </li>
            <?php
             $langid=1;
             $res= admin_sidebar($langid) ; ?>
             @foreach($res as $mod)
                <li class="@if($mod->slug=='#') dropdown @endif">
                    <a href="@if($mod->slug=='#') '' @else {{ url('/') }}/{{$mod->slug}} @endif" class="nav-link @if($mod->slug=='#')  has-dropdown @endif"><i class="{{$mod->icons}}"></i><span>{{$mod->module_name}}</span></a>
                    @if($mod->slug=='#')
                    <ul class="dropdown-menu">
                    <?php
                        $langid=1;
                        $resch= admin_sidebar_chid($langid,$mod->id) ; ?>
                         @foreach($resch as $modch)
                            <li class="@if($modch->slug=='#') dropdown @endif">
                                <a href="{{ url('/') }}/{{$modch->slug}}" class="nav-link"><i class="{{$modch->icons}}"></i><span>{{$modch->module_name}}</span></a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                
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