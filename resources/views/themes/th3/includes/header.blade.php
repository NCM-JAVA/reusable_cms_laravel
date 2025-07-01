<?php

		$value = bin2hex(random_bytes(16));
		setcookie("session_id", $value, [
			'expires' => time() + 3600,
			'path' => '/',
			'domain' => 'consumeraffairs.gov.in',
			'secure' => true,
			'httponly' => true,
			'samesite' => 'Lax'
		]);
		
		header("Permission-Policy: geolocation=(), microphone=(self), camera=(self), fullscreen=(self), payment=()");

	   $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        $pageurl = $_SERVER['REQUEST_URI'];

        $ip = clean_single_input($ip);
        $pageurl = clean_single_input($pageurl);
        update_visitor_count($ip, $pageurl);
        $langid1 = session()->get('locale')??1;
        ?>



<head>
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/owl.theme.default.min.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

  <!--<link rel="stylesheet" href="/dca/public/themes/th3/assets/CSS/style.css">-->
  <!-- <link rel="stylesheet" href="index.css"> -->
  <style>
        #randomImage{
            width: 200px;
            height: 100px;
            object-fit: contain;
        }

        .social_icons:hover i {
            color: #fff !important;
        }
    </style>
    

  <script>
    let originalFontSize = 16;
    let currentFontSize = originalFontSize;

    function increaseFontSize() {
      if (currentFontSize < originalFontSize + 2 * 2) { // Allow only 2 steps increase
        currentFontSize += 2;
        document.body.style.fontSize = currentFontSize + 'px';
      }
    }

    function decreaseFontSize() {
      if (currentFontSize > originalFontSize - 2 * 2) { // Allow only 2 steps decrease
        currentFontSize -= 2;
        document.body.style.fontSize = currentFontSize + 'px';
      }
    }

    function resetFontSize() {
      currentFontSize = originalFontSize;
      document.body.style.fontSize = originalFontSize + 'px';
    }
  </script>
  <script>

    function themeSwitcher(theme) {
      let orange_theme = document.getElementById('orange-css');
      let BW_theme = document.getElementById('BW-css');
      console.log(localStorage.getItem('orange'));
      if (theme === 'orange') {
        orange_theme.removeAttribute("disabled")
        BW_theme.setAttribute("disabled", true)
        localStorage.setItem('theme', 'orange')
      }
      else if (theme === 'BW') {
        BW_theme.removeAttribute("disabled")
        orange_theme.setAttribute("disabled", true)
        localStorage.setItem('theme', 'BW')

      }
      if (theme == 'default') {
        BW_theme.setAttribute("disabled", true)
        orange_theme.setAttribute("disabled", true)
        localStorage.setItem('theme', 'default')
      }
    }

    function applyStoredTheme() {
      let storedTheme = localStorage.getItem('theme');
      if (storedTheme) {
        themeSwitcher(storedTheme);
      }
      else {
        themeSwitcher('default')
      }
    }

  </script>
</head>

<body onload="applyStoredTheme()">

  <!-- header section  -->
  <header>

    <!-- Top Bar  -->
    <div class="header_top header_top2 header_top3 header_topblack">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-xs-6  head-top-left-cor my-auto">
            <aside class="link-group gap-2 d-flex">

              <a class="links links-right" href="https://www.india.gov.in/" target="_blank">
                <div class="d-flex flex-column text-right text-dark lh-1">
                  <span class="">भारत सरकार</span>
                  <span class="fw-bold header_gov_text">GOVERNMENT OF INDIA</span>
                </div>
              </a>
              <div class="border-start border-2"></div>
              <a class="links">
                <div class="d-flex flex-column text-left text-dark lh-1">
                  <span class="">उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण मंत्रालय</span>
                  <span class="fw-bold header_gov_text"> MINISTRY OF CONSUMER AFFAIRS, FOOD & PIBLIC DISTRIBUTION</span>
                </div>
              </a>
            </aside>


          </div>
          <!-- Common Features -->
          <div class="col-md-7 col-xs-6">
            <form action="{{ url('/search') }}" method="get" id="cse-search-box" class="searchbox searchbox-open searchbox-open2"
              accept-charset="utf-8">
              <input type="hidden" name="cx" value="013280925726808751639:juvtcf6w1h4">
              <input type="hidden" name="cof" value="FORID:10">
              <input type="hidden" name="ie" value="UTF-8">
              <label for="searchq" style="display: none; margin:0;">Search</label>
              <div class="search-container">
                <input class="border" type="text" name="q" id="searchq" placeholder="Search.." required="" value=""
                  spellcheck="false" data-ms-editor="true">
                <button type="submit" value="submit" name="search" title="submit-bottom" aria-label="submit"
                  class="searchButton"><i class="fa fa-search"></i></button>
              </div>
            </form>
            <ul id="access"
              class="common_feature pull-right d-flex align-item-center sf-js-enabled pt-md-2 sf-arrows1"
              style="touch-action: pan-y;">
              <li class="hidden-xs"><a class="text-dark fw-bold" href="#main_banner" title="Skip To Main Content"><i class="fa-solid fa-share my-auto"></i></a></li>
                  <li><a href="{{ route('sitemap') }}" title="Site map"><img src="{{ asset('public/themes/th3/assets/img/site-map.png') }}" class="img_width" alt="Site Map" title="Site Map"></a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside"><img
                    src="{{ asset('./public/themes/th3/assets/img/theme.png') }}" class="img_width"
                    alt="Themes" title="Themes"></a>
                <ul class="dropdown-menu shadow color_dropdown theme_drop">
                  <li><a class="dropdown-item red_box" href="#" onclick="themeSwitcher('default')"><img
                        src="{{ asset('./public/themes/th3/assets/img/red_box.jpg')}}" alt="Default" title="Default Theme"></a></li>
                  <li><a class="dropdown-item orange_box" href="#" onclick="themeSwitcher('orange')"><img
                        src="{{ asset('./public/themes/th3/assets/img/orange_box.jpg')}}" alt="Orange" title="Outrageous Orange"></a></li>
                  

                </ul>

              </li>
           
              <!--social media icons-->
              
              <?php
                $socilaMedia = get_icons($langid1);
              ?>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside"><img
                    src="{{ asset('./public/themes/th3/assets/img/social media icon.png')}}"
                    class="img_width" alt="Social Media" title="Social Media"></a>

                <ul class="dropdown-menu shadow color_dropdown theme_drop">
                  @php
                      $colors = ['#12609b', '#000', '#ee1111','#E4405F'];
                  @endphp
                  @foreach($socilaMedia as $index => $val)
                    <li>
                      <a class="dropdown-item red_box social_icons" href="{{ $val->page_url }}" title="{{ $val->title }}">
                        <i class="{{ $val->icons }}" style="font-size:20px; color: {{ $colors[$index % count($colors)] }}"></i>
                      </a>
                    </li>
                  @endforeach

                  <!-- <li><a class="dropdown-item red_box" href="https://www.facebook.com/ConsumerAdvocacy/" ><img
                        src="http://125.20.102.85/dcpw/public/themes/th3/assets/upload/icons/ico-facebook.png"
                        class="img_width" alt="Facebook" title="Facebook"></a></li>

                  <li><a class="dropdown-item orange_box" href="https://x.com/jagograhakjago" ><img src="http://125.20.102.85/dcpw/public/themes/th3/assets/upload/icons/ico-twitter.png"
                  alt="Twitter" title="Twitter"></a></li>

                  <li><a class="dropdown-item bw_box" href="https://www.youtube.com/channel/UCTyQpXH6_4xVR1CUyuPkm0Q" ><img src="http://125.20.102.85/dcpw/public/themes/th3/assets/upload/icons/ico-youtube.png"
                  alt="Youtube" title="Youtube"></a></li> -->

                </ul>

              </li>


              


          

              <!--End-->

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside"><img src="{{ asset('./public/themes/th3/assets/img/text-inde.png') }}" class="img_width"
                alt="Accessibility Option" title="Accessibility-option"></a>

                <ul class="dropdown-menu shadow color_dropdown theme_drop">

                  <li><a class="dropdown-item red_box" href="#" onclick="decreaseFontSize()"><img src="{{ asset('./public/themes/th3/assets/img/decrease-font-size.png') }}" alt="Decrease" title="Decrease Font Size"></a></li>

                  <li><a class="dropdown-item orange_box" href="#" onclick="resetFontSize()"><img src="{{ asset('./public/themes/th3/assets/img/standard-view.png') }}" alt="Normal" title="Normal Font Size"></a></li>

                  <li><a class="dropdown-item bw_box" href="#" onclick="increaseFontSize()"><img src="{{ asset('./public/themes/th3/assets/img/increase-text-size.png') }}" alt="Increase" title="Increase Font Size"></a></li>
                  <li><a class="dropdown-item bw_box" href="#" onclick="themeSwitcher('BW')"><img src="{{ asset('./public/themes/th3/assets/img/high-contrast.png') }}" alt="High Contrast" title="High Contrast"></a></li>
                  <li><a class="dropdown-item bw_box" href="#" onclick="themeSwitcher('default')"><img src="{{ asset('./public/themes/th3/assets/img/standard-view.png') }}" alt="Default" title="Default"></a></li>

                </ul>

              </li>


            
            </ul>




          </div>
          <div class="col-md-1">
            <ul class="common_feature d-flex align-item-center h-100">
              <li>
    <li>
    <select onchange="return change_language(event, this);" class="changeLang">
        <?php
            $statusArray = get_language();
            foreach($statusArray as $key => $value) {
        ?>
            <option value="<?php echo $key; ?>" {{ session()->get('locale') == $key ? 'selected' : '' }}>
                <?php echo $value; ?>
            </option>
        <?php } ?>
    </select>
</li>

</li>

            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Top Bar end -->

    <div class="container">
      <div class="d-flex flex-md-row flex-column-reverse header justify-content-between">
        <div class="website_logo my-2">
          <img class="img-fluid" src="{{ URL::asset('/public/themes/th3/assets/images/Logo.png')}}" alt="img-fluid-logo" srcset>
        </div>
      <div>
    <div>

  </div>

        @php
            $logosData = random_logo_header();
            $random_logo = $logosData['random_logo'];
            $random_link = $logosData['random_link'];
        @endphp

        <!-- @if(!empty($random_logo) && !empty($random_link))
            <div class="header_img d-md-flex d-none gap-3 my-2">
                <a id="randomImageLink" href="{{ $random_link[0] }}" target="_blank">
                    <img id="randomImage" src="{{ $random_logo[0] }}" alt="Logo 1">
                </a>
                <a href="https://jagograhakjago.gov.in/"><img class="img-fluid" src="/dca/public/themes/th3/assets/images/Jago-Grahak-Jago.png" alt srcset></a>
                <a href="https://consumerhelpline.gov.in/public/"><img class="img-fluid" src="/dca/public/themes/th3/assets/images/nch-logo.png" alt srcset></a>
            </div>
        @endif -->

        <div class="header_img d-md-flex d-none gap-3 my-2">
            <!-- <a target="_blank" href="https://swachhbharatmission.ddws.gov/" class="mt-2"><img class="img-fluid" src="/dca/public/upload/admin/cmsfiles/logo/thumbnail/Gandhi_Jayanti_logo.png" alt="{{ $langid1 == 1 ? 'Swachh Bharat Mission' : 'स्वच्छ भारत मिशन' }}" title="{{ $langid1 == 1 ? 'Swachh Bharat Mission' : 'स्वच्छ भारत मिशन' }}" srcset></a>
            <a target="_blank" href="https://amritmahotsav.nic.in/"><img class="img-fluid" src="/dca/public/upload/admin/cmsfiles/logo/thumbnail/Seventy_five_years_of_hindi_logo.png" alt="{{ $langid1 == 1 ? 'Azadi Ka Amrit Mahotsav' : 'आज़ादी का अमृत महोत्सव' }}" title="{{ $langid1 == 1 ? 'Azadi Ka Amrit Mahotsav' : 'आज़ादी का अमृत महोत्सव' }}" srcset></a> -->
            <a target="_blank" href="https://jagograhakjago.gov.in/"><img class="img-fluid" src="{{ URL::asset('/public/themes/th3/assets/images/Jago-Grahak-Jago.png')}}" alt="{{ $langid1 == 1 ? 'Jago Grahak Jago' : 'जागो ग्राहक जागो' }}" title="{{ $langid1 == 1 ? 'Jago Grahak Jago' : 'जागो ग्राहक जागो' }}" srcset></a>
            <a target="_blank" href="https://consumerhelpline.gov.in/public/"><img class="img-fluid" src="{{ URL::asset('/public/themes/th3/assets/images/nch-logo.png')}}" alt="{{ $langid1 == 1 ? 'Consumer Helpline' : 'उपभोक्ता हेल्पलाइन' }}" title="{{ $langid1 == 1 ? 'Consumer Helpline' : 'उपभोक्ता हेल्पलाइन' }}" srcset></a>
        </div>
        

        <script>
            const randomLogos = @json($random_logo);
            const randomLinks = @json($random_link);
            let currentIndex = 0;

            function reloadRandomImage() {
                currentIndex = (currentIndex + 1) % randomLogos.length;
                
                // Update image src
                document.getElementById('randomImage').src = randomLogos[currentIndex];
                
                // Update the link href
                document.getElementById('randomImageLink').href = randomLinks[currentIndex];
            }

            setInterval(reloadRandomImage, 5000);
        </script>

     
      </div>
    </div>

    </div>
  </header>
  

  <!-- ----------------------Navbar Start-------------------------- -->

  <section class="position-relative">
    <!-- <nav class="navbar navbar-expand-lg shadow position-absolute top-0 end-0 start-0 z-2 bg-megenta_tr"> -->
    <nav id="main_banner" class="navbar top-navbar navbar-expand-lg shadow bg-maroon py-0" id="skip">
      <div class="container">

        <div class>
          <button class="navbar-toggler float-end float-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-expanded="true">
            <div class="hamburger-toggle active">
              <i class="fa-solid fa-bars"></i>
            </div>
          </button>
        </div>
        <div class="collapse navbar-collapse justify-content-between" id="navbar-content">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0 w-100 justify-content-between text-dark">
            <?php
              $pos=[1,4];
              $langid=session()->get('locale')??1;
              $res= get_menu($langid,$pos,0) ; $i=1;
              // dd($res); 
            
              $pageurl = clean_single_input(request()->segment(2));
              $nameurl=get_parent_menu_name($pageurl,$langid);
              $nameurl1=!empty($nameurl->m_url)?$nameurl->m_url:'';
              
            ?>

            @foreach($res as $mod)
            <li class="nav-item dropdown <?php if($mod->m_url== $pageurl || $mod->m_url==$nameurl1 ) echo " current" ?>">
              @if($mod->m_type==2)
              <a class="nav-link" target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}"> {{$mod->m_name}}</a>
              @elseif($mod->m_type==3)
              <a class="nav-link " target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}"> {{$mod->m_name}}</a>
              @else
              <a class="nav-link @if(has_child($mod->id, $mod->language_id) > 0) {{'dropdown-toggle'}} @else {{''}} @endif " data-bs-toggle="{{ has_child($mod->id, $mod->language_id) > 0 ? 'dropdown' : ''}}" data-bs-auto-close="{{ has_child($mod->id, $mod->language_id) > 0 ? 'outside' : ''}}" href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}">{{$mod->m_name}} </a>
              @endif
              <?php  
                if(has_child($mod->id, $mod->language_id) > 0){ 
              ?>
              <!-- <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i> -->
              <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ; $k=1;  $count=count($ress); ?>
              
              <ul class="dropdown-menu shadow <?php if($count==19 || $count==18 || $count==17 || $count==16|| $count==15|| $count==14|| $count==12 || $count==11 || $count==10){ echo 'double_column ';} else{ } ?>">

                @foreach($ress as $mods)
                <?php  if(has_child($mods->id, $mods->language_id) > 0){ ?>
                <li class="left_or_right <?php if($mods->m_url== $pageurl ) echo " current" ?>">
                  
                    @if($mods->m_type==2)
                    <a class="dropdown-item dropdown-toggle" target="_blank" data-bs-toggle="dropdown" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                    @elseif($mods->m_type==3)
                    <a class="dropdown-item dropdown-toggle" target="_blank" data-bs-toggle="dropdown" target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}">{{$mods->m_name}}</a>
                    @else
                    <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                    @endif
                    <!-- <i class='bx bxs-chevron-right arrow more-arrow'></i> -->
                
                  <ul class="dropdown-menu shadow">
                    <?php  $resss= get_menu($mods->language_id,$pos,$mods->id) ;  ?>
                    @foreach($resss as $modss)
                    <li class="dropdown-item" <?php if($modss->m_url== $pageurl ) echo "current" ?>>
                      @if($modss->m_type==2)
                      <a class="dropdown-item" target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$modss->doc_uplode}}" title="{{$modss->m_name}}"> {{$modss->m_name}}</a>
                      @elseif($modss->m_type==3)
                      <a class="dropdown-item " target="_blank" href="{{$modss->linkstatus}}" title="{{$modss->m_name}}">{{$modss->m_name}}</a>
                      @else
                      <a class="dropdown-item dropdown-toggle" href="@if($modss->m_url=='#') '' @else {{ url('/pages') }}/{{$modss->m_url}} @endif" title="{{$modss->m_name}}"> {{$modss->m_name}}</a>
                      @endif
                    </li>
                    @endforeach
                  </ul>
                  <?php } else { ?>
                <li>

                  @if($mods->m_type==2)
                  <a class="dropdown-item dropdown-toggle" target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                  @elseif($mods->m_type==3)
                  <a class="dropdown-item dropdown-toggle" target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}">{{$mods->m_name}}</a>
                  @else
                  <a class="dropdown-item " href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                  @endif
                  <?php } ?>
                </li>
                <?php $k++ ; ?>
                @endforeach
              
              </ul>
              <?php } ?>
            </li>
            <?php $i++ ; ?>
            @endforeach
          </ul>
        </div>
      </div>
    </nav>
  </section>
<script>

  // Add class to last 3 li tags
document.querySelectorAll('.navbar-nav .nav-item:nth-last-child(-n+3)>.dropdown-menu .left_or_right').forEach(element => {
    element.classList.add('dropstart');
});

// Add class to all other li tags (except last 3)
document.querySelectorAll('.navbar-nav li:not(:nth-last-child(-n+3))>.dropdown-menu .left_or_right').forEach(element => {
    element.classList.add('dropend');
})[1][2]

</script>
  <script>
    const checkbox = document.getElementById('checkbox');
    const dropdownContainer = document.querySelector('.theme-popup__list-container');

    // Add a click event listener to the checkbox
    checkbox.addEventListener('click', function (event) {
      event.stopPropagation(); // Prevent the click event from propagating to the document
      dropdownContainer.style.display = dropdownContainer.style.display === 'block' ? 'none' : 'block';
    });

    // Add a click event listener to the document to close the dropdown
    document.addEventListener('click', function (event) {
      if (dropdownContainer.style.display === 'block' && event.target !== checkbox) {
        dropdownContainer.style.display = 'none';
      }
    });
  </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const captchaFooterLink = document.querySelector('a[href*="captcha.org/captcha.html?laravel"]');
        if (captchaFooterLink) {
            captchaFooterLink.style.display = 'none';
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all the anchor links in the menu (you can use a specific class to target only menu items)
        const links = document.querySelectorAll('a');

        // Get the current domain of the website (you can customize this if needed)
        const currentDomain = window.location.hostname;

        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                const href = link.getAttribute('href');
                
                // Check if the link is external (not part of the same domain or IP address)
                const isExternal = href && (href.startsWith('http') || href.startsWith('https')) &&
                                   !href.includes(currentDomain);

                // Show a confirmation message if it's an external link
                if (isExternal && !confirm('This is an external link. Are you sure you want to open it?')) {
					link.setAttribute('target', '_blank');
                    // Prevent the default action (navigation) if the user cancels
                    event.preventDefault();
                }
            });
        });
    });
</script>

