<body>
  
<?php
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        $pageurl = $_SERVER['REQUEST_URI'];

        $ip 			= clean_single_input($ip);
        $pageurl 	= clean_single_input($pageurl);


        update_visitor_count($ip, $pageurl);
        $langid1 = session()->get('locale');
        ?>

    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>Patna Metro Rail Corporation Ltd. </small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                  
                    <small> 
                       
                    </small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+012 345 6789</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                       <select onchange="return change_language(this);" class="form-control changeLang">
                              <?php
                            
                            $statusArray = get_language();
                            
                            foreach($statusArray as $key=>$value) {
                                ?>
                                <option value="<?php echo $key; ?>"  {{ session()->get('locale') == $key ? 'selected' : '' }}><?php echo $value; ?></option>
                            <?php  }?>
                        </select> 
                  </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ url('/')}}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0 text-primary"><img src="{{ URL::asset('public/upload/admin/setting/')}}/{{!empty(get_setting($langid1)->logo)?get_setting($langid1)->logo:''}}" alt="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" class="img-responsive" title="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" style="width: 58px;" /></h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                       <?php
                        $pos=[1,4];
                        $langid=session()->get('locale')??1;
                        $res= get_menu($langid,$pos,0) ; $i=1; 
                        $pageurl = clean_single_input(request()->segment(2));
                        ?>
                         
                      @foreach($res as $mod)
                       
                      <?php  if(has_child($mod->id, $mod->language_id) > 0){  ?>
              
                
                      <div class="nav-item dropdown">
                         <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ;  ?>
                            @if($mod->m_type==2)
                                <a class="nav-link dropdown-toggle <?php if($mod->m_url== $pageurl || $mod->m_url== 'home') echo "active" ?>" data-bs-toggle="dropdown" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > {{$mod->m_name}} </a>
                            @elseif($mod->m_type==3)
                                <a class="nav-link dropdown-toggle <?php if($mod->m_url== $pageurl || $mod->m_url== 'home') echo "active" ?>" data-bs-toggle="dropdown" target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > {{$mod->m_name}} </a>
                            
                            @else
                            <a class="nav-link dropdown-toggle <?php if($mod->m_url== $pageurl || $mod->m_url== 'home') echo "active" ?>" data-bs-toggle="dropdown" href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > {{$mod->m_name}} </a>
                        
                            @endif  
                          <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                            @foreach($ress as $mods)
                            
                              @if($mods->m_type==2)
                                  <a class="dropdown-item <?php if($mods->m_url== $pageurl || $mods->m_url== 'home') echo "active" ?>"  href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}" > {{$mods->m_name}} </a>
                              @elseif($mods->m_type==3)
                                  <a class="dropdown-item <?php if($mods->m_url== $pageurl || $mods->m_url== 'home') echo "active" ?>" target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}" > {{$mods->m_name}} </a>
                              
                              @else
                              <a class="dropdown-item <?php if($mods->m_url== $pageurl || $mods->m_url== 'home') echo "active" ?>"  href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}" > {{$mods->m_name}} </a>
                          
                              @endif 
                            @endforeach
                          </div>
                      </div>
                  <?php } ?>
                <?php $i++ ; ?>
                @endforeach
            </div>
          </div>
          
    </nav>
    <!-- Navbar End -->


   