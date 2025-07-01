
<!--footer scrollbar-->
<section class="footer-scroller">
    <div class="container">
        <div class="row">
            <ul id="flexiselDemo5">
                @if(!empty(get_logolist()))
                    @foreach(get_logolist() as $logo)
                        <li>
                            <a href="{{$logo->logo_url}}" target="_blank" onclick="return sitevisit()" title="{{$logo->title}}"><img src="{{ URL::asset('public/upload/admin/cmsfiles/logo/thumbnail/')}}/{{$logo->txtuplode}}" alt="{{$logo->title}}" class="img" /></a>
                        </li>
                    @endforeach
                
                @endif
              
            </ul>
        </div>
    </div>
</section>

<!--end of footer scrollbar-->

<footer>
<div class="footer_top">
<div class="container text-center">
<ul>
<?php   $pos=[3,4];
        $langid=session()->get('locale')??1;
        $res= get_menu($langid,$pos,0) ; $i=1; 
        $pageurl = clean_single_input(request()->segment(2));
        ?>
            
            @foreach($res as $mod)
        <li>
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
                                        <li class="">
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
</ul>
    </div>
    </div>

    <div class="footer_btm">
    <div class="container">
    <div class="col-xs-6 col-md-6"> {{ __('messages.lastupdate') }} : {{get_last_updated_date()}}	</div>
    <div class="col-xs-6 col-md-6 right-text">{{ __('messages.Visitors') }}:{{get_visitor_count()}}	</div>
   </div>
   <div class="container">
   <div class="col-md-12">
   <div class="col-xs-12 col-md-9 text-center text-center2">
   <p class="left-text2">{{ __('messages.footercontained') }}</p>
   <p class="left-text2">Solution Developed by: Net Creative Mind Solution PVT Ltd.</p></br>
   <a href="http://www.netcreativemind.com/">
   </div>
   </div>

   </div>
   </div>
   </footer>
   
   
   <script src="{{ URL::asset('/public/themes/th1/js/jquery-3.4.1.min.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/news-update.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/bootstrap.min.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/superfish.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/font-size-new.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/styleswitcher.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/custom.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/bootstrap-datepicker.min.js')}}">   </script>
   <script src="{{ URL::asset('/public/themes/th1/js/clientside.validation.js')}}"></script>
   <script src="{{ URL::asset('/public/themes/th1/js/bootbox.min.js')}}"></script>
   <script>
   jQuery(document).ready(function () {
   jQuery('#main-nav nav').meanmenu();
   
   /*ministory logo slider button's tooltip*/
        jQuery('.nbs-flexisel-nav-left').attr('title', 'Prev');
        jQuery('.nbs-flexisel-nav-right').attr('title', 'Next');
    });

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