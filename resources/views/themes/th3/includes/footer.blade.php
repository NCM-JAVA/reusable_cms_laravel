 <!-- ******************* footer section ******************* -->

        <footer>

            <?php   
                $pos=[3,4];
                $langid=session()->get('locale')??1;
                $res= get_menu($langid,$pos,0) ; $i=1; 
                $pageurl = clean_single_input(request()->segment(2));
            ?>

            <!-- Logo slider -->
            <div class="py-3 brand-logo bg-white position-relative z-4">
              <div class="logos container">

                  <div class="logo-slider" data-v-4ef8651c="">
                      <div class="logos-slide" data-v-4ef8651c="">

                          @php
                            $logos = get_logolist($langid);
                          @endphp
                          @foreach($logos as $val)
                          <a href="{{ $val->logo_url ? $val->logo_url : '#' }}" target="_blank" class=""><img
                                  src="{{ asset('public/upload/admin/cmsfiles/logo/thumbnail/') }}/{{$val->txtuplode}}"
                                  data-v-4ef8651c="" alt="{{ $val->title }}" title="{{ $val->title }}"></a>
                          @endforeach

                      </div>
                  </div>
                  <script>
                      var copy = document.querySelector(".logos-slide").cloneNode(true);
                      document.querySelector(".logo-slider").appendChild(copy);
                  </script>
              </div>
            </div>


          <div class="footer_links bg-footer-dark py-1">
            <div class="container">
              <div class="d-flex flex-column flex-md-row justify-content-between text-dark">
            
            
             @foreach($res as $mod)
                @if($mod->m_type==2)
                    <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                @elseif($mod->m_type==3)
                <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
            
                @else
                <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                
                @endif
                <?php $i++ ; ?>
               @endforeach              
			   </div>
            </div>
          </div>

          <div class="container footer_mid">

            <div class="row">

              <!-- ****** logo section ****** -->
              <div class="col-12 col-md-4">
                <div class="bg-white d-flex justify-content-center h-100">
                  <img class="my-auto py-2 footer_logo img-fluid" src="{{ URL::asset('/public/themes/th3/assets/images/Logo.png')}}" alt="logo"
                    srcset>
                </div>
              </div>

              <!-- ******useful links section  ****** -->
              <div class="col-12 col-md-4 text-white py-3">
                <h5> @if($langid == 1) Address @else पता @endif</h5>
                <!-- <a href="https://consumerhelpline.gov.in" class="fsize_btn">https://consumerhelpline.gov.in</a> -->
                <p> 
                  @if($langid == 1)
                    Department of Consumer Affairs, Krishi Bhawan <br> New Delhi 110001 
                  @else
                    उपभोक्ता मामले विभाग, कृषि भवन, नई दिल्ली 110001
                  @endif
                </p>
                <p> @if($langid == 1) Phone No @else फ़ोन नंबर @endif: 011-23386189</p>
              </div>

              <div class="col-12 col-md-4 text-white py-3">
                <h5 class=""> 
                  @if($langid == 1) Contact Information @else संपर्क जानकारी @endif
                </h5>
                <p class="footer_para">
                  @if($langid == 1)
                    National Consumer Helpline<br>
                    (Department of Consumer Affairs, Govt. of India)<br>
                    Toll Free No.
                    <span class="fw-bold">1800-11-4000 OR 1915</span> <br>
                    Register your grievance through NCH APP</p>
                  @else
                    राष्ट्रीय उपभोक्ता हेल्पलाइन <br>
                    (उपभोक्ता मामले विभाग, भारत सरकार)<br>
                    टोल फ्री नंबर <span class="fw-bold">1800-11-4000 या 1915 </span> <br>
                    एनसीएच एप्लिकेशन के माध्यम से अपनी शिकायत दर्ज करें
                  @endif
              </div>
            </div>
          </div>

          <div class="footer_end bg-footer-dark">
            <div class="container">
              <div class="d-md-flex justify-content-between text-white py-2">
                <p>
                  @if($langid == 1)
                  Content Owned by Department of Consumer Affairs
                  @else
                  सामग्री का स्वामित्व उपभोक्ता मामले विभाग
                  @endif
                </p>

                @php
                  use Carbon\Carbon;
                  $date = Carbon::parse(get_last_updated_date());
                  $date->locale('hi');
                  $formattedDate = $date->translatedFormat('jS F Y');
                @endphp
                <p>
                  @if($langid == 1) 
                    Last Updated on - {{date('jS F Y', strtotime(get_last_updated_date()))}} 
                  @else 
                    अंतिम बार अद्यतन किया गया - {{ $formattedDate }} 
                  @endif  
                </p>

                <p>{{get_title('Visitors',$langid)->title}} - {{number_format(get_visitor_count())}}	</p>
              </div>
            </div>
          </div>
        </footer>

        <!-- ***************Code ended here*************** -->
        <script
        src="{{ URL::asset('/public/themes/th3/assets/JS/bootstrap.bundle.min.js')}}"
        integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       
        <script
        src="{{ URL::asset('/public/themes/th3/assets/JS/jquery.min.js')}}"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ URL::asset('/public/themes/th3/assets/JS/owl.carousel.min.js')}}"></script>
		<script src="{{ URL::asset('/public/themes/th3/assets/JS/main.js')}}"></script>
        
        


<script>
  $(function() {
    // Owl Carousel - First Carousel (banner_carousel)
    var owl1 = $(".banner_carousel");
    owl1.owlCarousel({
      items: 1,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 6000, // First slider slide every 5 seconds
      autoplaySpeed: 2000,
      loop: true,
      nav: true
    });

    // Owl Carousel - Second Carousel (images_slider)
    var owl2 = $(".images_slider");
    
    // Sync second slider with delay
    owl1.on('changed.owl.carousel', function(event) {
      setTimeout(function() {
        owl2.trigger('next.owl.carousel');
      }, 1000); // Add 1-second delay after first slider slides
    });

    owl2.owlCarousel({
      items: 1,
      margin: 10,
      autoplay: false, // We are controlling the autoplay manually
      loop: true,
      nav: true
    });
  });
</script>

  <script src="{{ URL::asset('/public/themes/th3/JS/clientside.validation.js')}}"></script>
    <script> 
    function sitevisit()
    {
        var ret_val = confirm("This is an external link. Do you wish to open in new window.");
        if (ret_val == true)
        {
            return true;
        } else
        {
            return false;
        }
    }
   function myFunction() {
        window.print();
    }
  </script>
  <script type="text/javascript">
    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(event){
        // Show the confirmation dialog
        var lang = $(this).val(); // Get the selected language
        var confirmationMessage = lang == 1 ? "Switch To English?" : "Switch To Hindi?";

        // Show the confirmation dialog
        var ret_val = confirm(confirmationMessage);

        // If the user clicks "OK", change the language
        if (ret_val) {
            // Perform the redirection
            window.location.href = url + "?lang=" + lang;
        } else {
            // If "Cancel" is clicked, prevent the change and stop the event
            event.preventDefault();
            return false;
        }
    });
</script>

  <script>
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("img01");
    let images = [];
    let currentImageIndex = 0;

    function openModal(imageSrc, categoryImages) {
        modal.style.display = "block";
        setTimeout(() => {
            modal.classList.add("show");
            modalImg.src = imageSrc;
            images = categoryImages;
            currentImageIndex = categoryImages.indexOf(imageSrc);
        }, 10);
    }

    function closeModal() {
        modal.classList.remove("show");
        setTimeout(() => {
            modal.style.display = "none";
        }, 500);
    }


function nextSlide() {
    if (images.length === 0) return;
    currentImageIndex = (currentImageIndex + 1) % images.length;
    document.getElementById('img01').src = images[currentImageIndex];
}

function prevSlide() {
    if (images.length === 0) return;
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    document.getElementById('img01').src = images[currentImageIndex];
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}


    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    };
</script>
</body>

</html>