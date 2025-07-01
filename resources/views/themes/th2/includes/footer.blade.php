
    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @if(!empty(get_logolist()))
                    @foreach(get_logolist() as $logo)   
                <div class="testimonial-item text-center">
                   <a href="{{$logo->logo_url}}" target="_blank" onclick="return sitevisit()" title="{{$logo->title}}"><img style="width: 100px; height: 100px;" src="{{ URL::asset('public/upload/admin/cmsfiles/logo/thumbnail/')}}/{{$logo->txtuplode}}" alt="{{$logo->title}}" class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" /></a>
                </div>
            @endforeach
            
            @endif
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
            <?php   $pos=[3,4];
            $langid=session()->get('locale')??1;
            $res= get_menu($langid,$pos,0) ; $i=1; 
            $pageurl = clean_single_input(request()->segment(2));
            ?>
                
                @foreach($res as $mod)
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">
                @if($mod->m_type==2)
                <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
            @elseif($mod->m_type==3)
            <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
        
            @else
            <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
            
            @endif
            </h5>
            <?php  
                    if(has_child($mod->id, $mod->language_id) > 0){
                       
                        ?>
                         <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ; 
                                
                                ?>
                          @foreach($ress as $mods)
                                    
                                            @if($mods->m_type==2)
                                                <a class="btn btn-link" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}" > {{$mods->m_name}}</a>
                                            @elseif($mods->m_type==3)
                                                <a class="btn btn-link" target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}" >{{$mods->m_name}}</a>
                                            
                                            @else
                                            <a class="btn btn-link" href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}" > {{$mods->m_name}}</a>
                                        
                                            @endif  
                               
                                    @endforeach
                  
                    <?php } ?>
                </div>
                <?php $i++ ; ?>
               @endforeach
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Solution Developed by:   <a href="http://www.netcreativemind.com/"> Net Creative Mind Solution PVT Ltd.</a></p></br>

      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/wow/wow.min.js')}}"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/easing/easing.min.js')}}"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ URL::asset('/public/themes/th2/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ URL::asset('/public/themes/th2/js/main.js')}}"></script>
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
    function change_language(data){
		//alert(data.value);
		if(data.value==1)
		{
            var ret_val = confirm("Switch To English");
			return true;
		}
		else
		{
            var ret_val = confirm("Switch To Hind");
			return false;
		}
	}

    function myFunction() {
        window.print();
    }
  </script>
  <script type="text/javascript">
  
    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val()??1;
    });
  
  </script>
</body>

</html>