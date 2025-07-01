        
    
        <footer class="footer">
            <div class="container">
                <div class="row border-top">
                    <div class="col-12 col-md-8 mt-2">
                        <h5>
                            @if(session()->get('locale', 1)  == 1) 
                                Useful Links 
                            @else 
                                उपयोगी कड़ियां 
                            @endif
                        </h5>
                        <div class="row useful-links d-flex">
                            <div class="col-12 col-md-3">

                                <?php   
                                    $pos=[3,4];
                                    $langid=session()->get('locale')??1;

                                    $res= get_menu($langid,$pos,0) ; $i=1; 
                                    // $menucount = count($res);
                                    // $halfIndex = ceil($menucount / 2);
                                    // $firstHalf = array_slice($res, 0, $halfIndex);
                                    // dd($firstHalf);
                                    // $secondHalf = array_slice($res, $halfIndex);

                                    $chunks = array_chunk($res->toArray(), ceil(count($res) / 2));
                                    $firstHalf = $chunks[0];
                                    $secondHalf = isset($chunks[1]) ? $chunks[1] : [];
                                    
                                    $pageurl = clean_single_input(request()->segment(2));
                                ?>

                                @if($firstHalf)
                                @foreach($firstHalf as $mod)
                                    @if($mod->m_type==2)
                                    <div class="links d-flex gap-2 my-auto">
                                        <i class="fa-solid fa-arrow-right my-auto"></i>
                                        <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                                    </div>
                                    @elseif($mod->m_type==3)
                                    <div class="links d-flex gap-2 my-auto">
                                        <i class="fa-solid fa-arrow-right my-auto"></i>
                                        <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                                    </div>
                                    @else
                                    <div class="links d-flex gap-2 my-auto">
                                        <i class="fa-solid fa-arrow-right my-auto"></i>
                                        <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > {{$mod->m_name}}</a> 
                                    </div>
                                    @endif
                                    <?php $i++ ; ?>
                                @endforeach 
                                @endif
                            </div>
                            <div class="col-12 col-md-3">
                                @if($secondHalf)
                                @foreach($secondHalf as $mod)
                                    @if($mod->m_type==2)
                                    <div class="links d-flex gap-2 my-auto">
                                        <i class="fa-solid fa-arrow-right my-auto"></i>
                                        <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                                    </div>
                                    @elseif($mod->m_type==3)
                                    <div class="links d-flex gap-2 my-auto">
                                        <i class="fa-solid fa-arrow-right my-auto"></i>
                                        <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                                    </div>
                                    @else
                                    <div class="links d-flex gap-2 my-auto">
                                        <i class="fa-solid fa-arrow-right my-auto"></i>
                                        <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > {{$mod->m_name}}</a> 
                                    </div>
                                    @endif
                                    <?php $i++ ; ?>
                                @endforeach
                                @endif
                            </div>
                       
                            <!-- <img src="{{ asset('public/themes/th3/assets/images/footer-logo.png') }}" height="100"  alt srcset> -->
                             @php
                                $data = get_socialMedia($langid);
                             @endphp
                            
                            <div class="col-12 col-md-6">
                                <p class="my-auto">{{get_title('Visitors',$langid)->title}} :- <b>{{number_format(get_visitor_count())}}</b></p>
                                <p>Last Updated:- <b>{{date('jS F Y', strtotime(get_last_updated_date()))}} </b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mt-2">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <img src="{{ asset('public/themes/th3/assets/images/footer-logo.png') }}" height="100"  alt srcset class="footer_logo">
                            </div>
                            <div class="social-logo d-flex ">
                                    @foreach($data as $val)
                                        <a href="{{ $val->page_url }}" target="_blank" class="{{ $val->title == 'Facebook' ? 'icons_div fb_icon' : ($val->title == 'Youtube' ? 'icons_div youtube_icon' : ( $val->title == 'Twitter' ? 'icons_div twitter_icon' : ($val->title == 'Linkedin' ? 'icons_div linkedin_icon' : 'icons_div insta_icon' ))) }}">
                                            <i class="{{ $val->icons }} mx-2" ></i>
                                        </a>
                                    @endforeach
                                    <!-- <a href="#" target="_blank" class="icons_div fb_icon">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="#" target="_blank" class="icons_div twitter_icon">
                                    <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                    <a href="#" target="_blank" class="icons_div youtube_icon">
                                    <i class="fa-brands fa-youtube"></i>
                                    </a>
                                    <a href="#" target="_blank" class="icons_div insta_icon">
                                    <i class="fa-brands fa-instagram"></i>
                                    </a> -->
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <p class="mt-2 py-1 bg-megenta text-center text-white copyright">Copyright © 2025 All
                Rights Reserved</p>
            </div>
        </footer> 

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
        <script href="{{ URL::asset('/public/themes/th3/assets/js/main.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" ></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!-- <script>
        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": "{{ asset('public/themes/th3/assets/images/itn_banner_03.jpg') }}",  
            "autoLoad": true,               // Automatically loads the panorama
            "autoRotate": -2,               // Enables auto-rotation
            "autoRotateInactivityDelay": 3000 // Resumes auto-rotation after 3 seconds of inactivity
        });
    </script> -->
    
        <script>
            function change_language(data){
                if(data.value==1)
                {
                    var ret_val = confirm("Switch To English");
                    return true;
                }
                else
                {
                    var ret_val = confirm("Switch To Hindi");
                    return false;
                }
            }
        </script>
        <script>
            var url = "{{ route('changeLang') }}";
            $(".changeLang").change(function(){
                window.location.href = url + "?lang="+ $(this).val()??1;
            });
        </script>

        <script>
           function toggleCustomDropdown(event) {
  const menuId = event.target.getAttribute("data-menu");
  const targetMenu = document.getElementById(menuId);

  // Check if the clicked dropdown is already open
  const isOpen = targetMenu.style.display === "block";

  // Close all dropdowns
  document.querySelectorAll(".custom-menu").forEach((menu) => {
    menu.style.display = "none";
  });

  // Toggle the clicked dropdown
  if (!isOpen) {
    targetMenu.style.display = "block";
  }
}

// Close the dropdown if the user clicks outside
window.onclick = function (event) {
  if (!event.target.matches('.custom-btn')) {
    document.querySelectorAll(".custom-menu").forEach((menu) => {
      menu.style.display = "none";
    });
  }
};

        </script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
    // Get all dropdowns with submenus
    const dropdownItems = document.querySelectorAll('.dropdown-item');

    dropdownItems.forEach(item => {
        // Add a hover event listener
        item.addEventListener('mouseenter', () => {
            const submenu = item.querySelector('.dropdown-menu');
            if (submenu) {
                // Reset any previously set styles
                submenu.style.left = '100%';
                submenu.style.right = 'auto';

                // Get the bounding box of the submenu
                const submenuRect = submenu.getBoundingClientRect();
                const viewportWidth = window.innerWidth;

                // Check if the submenu overflows the right edge
                if (submenuRect.right > viewportWidth) {
                    submenu.style.left = 'auto';
                    submenu.style.right = '100%'; // Open to the left
                }
            }
        });
    });
});

        </script>

    </body>
</html>