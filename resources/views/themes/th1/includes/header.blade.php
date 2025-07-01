<body id="fontSize">
    <noscript>
        <div class="nos">
            <p>
            {{ __('messages.noscript') }}
            </p>
        </div>
    </noscript>
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
        $langid1 = session()->get('locale')??1;
        ?>
    <header>
        <div class="header_top header_top2 header_top3 header_topblack">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-xs-6 head-top-left-cor">
                        <ul class="common_feature head-top-left pull-left">
                            <li><a href="#" title="{{ __('messages.screen') }}">{{ __('messages.screen') }}</a></li>
                            <li class="hidden-xs"><a href="#skip" title="{{ __('messages.skip') }}">{{ __('messages.skip') }}</a></li>
                        </ul>
                    </div>
                    <!-- Common Features -->
                    <div class="col-md-6 col-xs-6">
                        <ul id="access" class="common_feature pull-right">
                            <li>
                            <div class="row">
                                
                                <div class="col-md-12 col-xs-12">
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
                            </li>
                            <li>
                                <a href="{{ url('/pages/site-map')}}" title="{{ __('messages.sitemap') }}"><img src="{{ URL::asset('/public/themes/th1/images/site-map.png')}}" class="img_width" alt="{{ __('messages.sitemap') }}" title="{{ __('messages.sitemap') }}" /></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" title="Theme"><img src="{{ URL::asset('/public/themes/th1/images/theme.png')}}" class="img_width" alt="Themes" title="Themes" /></a>
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="javascript:void(0)" onclick="setActiveStyleSheet('outrageous_orange'); return false;">
                                            <img src="{{ URL::asset('/public/themes/th1/images/outrageous_orange.png')}}" class="img_width" alt="Outrageous Orange" title="Outrageous Orange" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" onclick="setActiveStyleSheet('green'); return false;">
                                            <img src="{{ URL::asset('/public/themes/th1/images/green.png')}}" alt="Green Theme" title="Green Theme" />
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0)" onclick="setActiveStyleSheet('blue'); return false;">
                                            <img src="{{ URL::asset('/public/themes/th1/images/blue.png')}}" alt="Blue Theme" title="Blue Theme" />
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" title="Accessibility Option"> <img src="{{ URL::asset('/public/themes/th1/images/text-inde.png')}}" class="img_width" alt="Accessibility Option" title="Accessibility-option" /></a>

                                <ul class="dropdown-content">
                                    <li>
                                        <a id="fontdecrease" href="javascript:void(0)"><img src="{{ URL::asset('/public/themes/th1/images/decrease-font-size.png')}}" alt="Decrease" title="Decrease Font Size" /></a>
                                    </li>
                                    <li>
                                        <a id="fontreset" href="javascript:void(0)"><img src="{{ URL::asset('/public/themes/th1/images/standard-view.png')}}" alt="Normal" title="Normal Font Size" /></a>
                                    </li>
                                    <li>
                                        <a id="fontincrease" href="javascript:void(0)"><img src="{{ URL::asset('/public/themes/th1/images/increase-text-size.png')}}" alt="Increase" title="Increase Font Size" /></a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0)" onclick="setActiveStyleSheet('change'); return false;"> <img src="{{ URL::asset('/public/themes/th1/images/high-contrast.png')}}" alt="High Contrast" title="High Contrast" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" onclick="setActiveStyleSheet('style'); return false;"><img src="{{ URL::asset('/public/themes/th1/images/standard-view.png')}}" alt="Default" title="Default" /></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <form action="#" method="get" id="cse-search-box" class="searchbox searchbox-open searchbox-open2" accept-charset="utf-8">
                            <input type="hidden" name="cx" value="013280925726808751639:juvtcf6w1h4" />
                            <input type="hidden" name="cof" value="FORID:10" />
                            <input type="hidden" name="ie" value="UTF-8" />
                            <label for="searchq" style="display: none; margin: 0;">Search</label>
                            <div class="search-container">
                                <input type="text" name="q" id="searchq" placeholder="Search.." required value="" />
                                <button type="submit" value="submit" name="search" title="submit-bottom" aria-label="submit" class="searchButton"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="header_mid header_mid2">
            <div class="container">
                <div class="row">
                    <div class="head-profile left">
                        <a href="{{ url('/')}}"><img src="{{ URL::asset('public/upload/admin/setting/')}}/{{!empty(get_setting($langid1)->logo)?get_setting($langid1)->logo:''}}" alt="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" class="img-responsive" title="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" /></a>
                    </div>

                    <div class="logo-text">
                        <span><a href="{{ url('/')}}">{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}</a></span>
                    </div>
                    <div class="head-profile right">
                        <img src="{{ URL::asset('/public/themes/th1/images/satyamev.png')}}" alt="key_people" class="img-responsive" title="key_people" />
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 head-search">
                        <div class="pull-right mt30 sear">
                            <form action="#" method="get" id="cse-search-box" class="searchbox searchbox-open searchbox-open2" accept-charset="utf-8">
                                <input type="hidden" name="cx" value="013280925726808751639:juvtcf6w1h4" />
                                <input type="hidden" name="cof" value="FORID:10" />
                                <input type="hidden" name="ie" value="UTF-8" />
                                <label for="searchq" style="display: none; margin: 0;">Search</label>

                                <div class="search-container">
                                    <input type="text" name="q" id="searchq" placeholder="Search.." required value="" />
                                    <button type="submit" value="submit" name="search" title="submit-bottom" aria-label="submit" class="searchButton"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--navbar-->
    <div class="mean-container"></div>
    <section>
        <div id="main-nav" class="navigation-bg">
            <nav>
                <div id="skip"></div>
                <div class="container">
                    <ul class="clearfix sf-menu" id="navaccess" style="margin-left: 6px;">
                    <?php
                        $pos=[1,4];
                        $langid=session()->get('locale')??1;
                        $res= get_menu($langid,$pos,0) ; $i=1; 
                        $pageurl = clean_single_input(request()->segment(2));
                        ?>
                         
                          @foreach($res as $mod)
                        <li class="<?php if($mod->m_url== $pageurl || $mod->m_url== 'home') echo "current" ?> has-sub a" style="margin-left: -7px;">
                            @if($mod->m_type==2)
                                <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
                            @elseif($mod->m_type==3)
                            <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
                        
                            @else
                            <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
                           
                            @endif
                            <?php  
                                    if(has_child($mod->id, $mod->language_id) > 0){
                                        ?>
                                            <ul>
                                               
                                                <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ; 
                                                
                                                ?>
                                               
                                                    @foreach($ress as $mods)
                                                        <li class=" <?php if($mods->m_url== $pageurl) echo "current" ?>  b">
                                                            @if($mods->m_type==2)
                                                                <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}" > <span>{{$mods->m_name}} </span></a>
                                                            @elseif($mods->m_type==3)
                                                                <a target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}" > <span>{{$mods->m_name}} </span></a>
                                                            
                                                            @else
                                                            <a href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}" > <span>{{$mods->m_name}} </span></a>
                                                        
                                                            @endif  
                                                        </li>
                                                    @endforeach
                                            </ul>
                                   <?php } ?>
                        </li>
                        <?php $i++ ; ?>
                        @endforeach
                        
                    </ul>
                </div>
            </nav>
        </div>
    </section>
