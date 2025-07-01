
@extends('layouts.themes')

@section('content')

<section class="banner-bg">
<div class="container">				



<div class="row">
<div class="col-md-12 col-xs-12 radiusleftbottm2">
    <div class="radiusleftbottm">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
            @if(!empty($banner))
                @php
                    $i = 0;
                @endphp

                @foreach($banner as $val)
                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="@if($i==0) active @endif"></li>
               
                @php
                    $i++;
                    @endphp

                @endforeach 
                @else
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                @endif
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
             @if(!empty($banner))
                @php
                    $i = 0;
                @endphp

                @foreach($banner as $val)
                    <div class="item @if($i==0) active @endif ">
                        <img src="{{ URL::asset('public/upload/admin/cmsfiles/banner/thumbnail/')}}/{{$val->txtuplode}}" alt="{{$val->title}}" title="{{$val->title}}" />
                        <div class="carousel-caption d-none d-md-block">
                            <h4>{{$val->title}}</h4>
                        </div>
                    </div>

                    @php
                    $i++;
                    @endphp

                @endforeach   
            @else
                <div class="item active">
                    <img src="{{ URL::asset('/public/themes/images/NASM-SR-Missile1.jpg')}}" alt="Banner" title="Banner Name" />
                    <div class="carousel-caption d-none d-md-block">
                        <h4>Banner Name</h4>
                    </div>
                </div>
            @endif
            </div>

            <div id="carouselButtons">
                <button id="playButton" type="button" class="btn btn-default btn-xs">
                    <span class=""> <img src="{{ URL::asset('/public/themes/th1/images/play-button.png')}}" alt="Play Button" title="Play Button" /></span>
                </button>
                <button id="pauseButton" type="button" class="btn btn-default btn-xs">
                    <span class=""> <img src="{{ URL::asset('/public/themes/th1/images/pause-button.png')}}" alt="Play Button" title="Pause Button" /></span>
                </button>
            </div>
        </div>
    </div>
</div>



<div class="news-section">
    <div class="news-head">
        <span> {{ __('messages.whatnew') }}</span>
    </div>
    <div class="news-body">
        <marquee class="marquee" behavior="scroll" direction="left"  onMouseOver="this.stop()" onMouseout="this.start()">
                                                                                                                                 </marquee>
    </div>
</div>


<div class="col-md-3 col-xs-12 pt-lf banner-right">
<div class="radiusrightBottom">
        </div>
    </div>

</div>

</div>
</section>
<!--end of banner area-->
<!--public notice-->
<section class="banner-bg">
<div class="container">

            

        <div class="row">
            <div class="col-lg-12 col-xs-12 col-md-9">
                <div class="main-section home-main-section">
                    <div class="top-section">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="column">
                                    <div class="head">
                                        <h3>{{ __('messages.department') }}</h3>
                                    </div>
                                    <div class="body">
                                        <ul>
                                            <li><a href="login.html">CMS Login For Admin</a></li>
											
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="column">
                                    <div class="head">
                                        <h3>{{ __('messages.Certifications') }}</h3>
                                    </div>
                                    <div class="body">
                                        <ul>
                                                                                        
                                            <li><a href="about_ecp.html"  title="About ECP">About ECP</a></li>
                                            
                                                                                    
                                            <li><a href="drdo.html"  title="DA Registration">DRDO</a></li>
                                                                               
                                                                                </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="column">
                                    <div class="head">
                                        <h3> {{ __('messages.Orders/Circulars') }} <span class="ft_rt"></span></h3>
                                    </div>
                                    <div class="body">
                                        <marquee id="mymarquee" class="marquee" behavior="scroll" direction="up" Scrollamount="3">
                                        <ul>
                                                                                                                                                            
                                        </ul>
                                    </marquee>
                                    
                                    </div>
                                    <div class="view-all mt-20">
                            <span class="playpause">
                                
								<a href="JavaScript:Void(0);" class="start-button" title="Play"  onClick="document.getElementById('mymarquee').start();" aria-label="Play">
                                <i class="fa fa-play"></i></a>
								
                               <a href="JavaScript:Void(0);" class="stop-button" title="Pause" onClick="document.getElementById('mymarquee').stop();" aria-label="Pause">
                                <i class="fa fa-pause"></i></a>
                            </span>
							
							
							
							
                            <span class="pull-right">
                                <span class=""><a href="#" title="View All">{{ __('messages.viewall') }}</a></span>
                            </span>
                        </div>
                                </div>
                            </div>
							
                            <div class="col-lg-3">
                                <div class="column">
                                    <div class="head">
                                        <h3>{{ __('messages.PublicNotice') }}                       
										<span class="ft_rt">
                                          </span>
                                        </h3>
                                    </div>
                                    <div class="body">
                                         <marquee id="mymarquee2" class="marquee" behavior="scroll" direction="up" Scrollamount="3">
                                        <ul>
                                        <ul>
                                                                       
                            
                                        </ul>
                                        </marquee>
                                        
                                    </div>
                                    <div class="view-all mt-20">
                                
								
								
								
								<span class="playpause">
								
								
								
                                <a href="JavaScript:Void(0);" class="start-button" title="Play"  onClick="document.getElementById('mymarquee2').start();" aria-label="Play">
                                <i class="fa fa-play"></i></a>
                                <a href="JavaScript:Void(0);" class="stop-button" title="Pause" onClick="document.getElementById('mymarquee2').stop();" aria-label="Pause">
                                <i class="fa fa-pause"></i></a>
                            </span>
								
								
								
                                <span class="pull-right">
                                    <span class=""><a href="#"
                                            title="View All">{{ __('messages.viewall') }}</a></span>
                                </span>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <a href="" class="tiles">
                                <div class="practise-3-item about_img">
                                    <div class="icon-box">
                                        <img src="th1/images/e-services.png" title="Services-Banner" alt="E-Services"></div>
                                    <h5>E Certification</h5>
                                </div>
                            </a>
                        </div>
                        <!--<div class="col-lg-4 col-md-4 col-xs-12">
                            <a href="" class="tiles">
                                <div class="practise-3-item dev_progress_img">
                                    <div class="icon-box">
                                        <img src="http://45.115.99.197/cemilacnew/assets/images/home/housing.png" alt="Housing" title="Housing-Banner"></div>
                                    <h5>ALH with Weapon Configuaration</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <a href=""  class="tiles">
                                <div class="practise-3-item contribute_img">
                                    <div class="icon-box"><img
                                            src="http://45.115.99.197/cemilacnew/assets/images/home/land.png" title="Land-Banner" alt="Land"></div>
                                    <h5>LCA NAVY</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <a href="" class="tiles">
                                <div class="practise-3-item dashboard_img">
                                    <div class="icon-box"><img
                                            src="http://45.115.99.197/cemilacnew/assets/images/home/Planning.png" title="Planning-Banner" alt="Planning"></div>
                                    <h5>LCH</h5>
                                </div>
                            </a>
                        </div>-->
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <a href="" class="tiles">
                                <div class="practise-3-item devper_img">
                                    <div class="icon-box"><img
                                            src="th1/images/master-plan2.png" title="MasterPlan-Banner" alt="Master Plan"></div>
                                    <h5>Policy Documents : DDPMAS-2002</h5>
                                </div>
                            </a>
                        </div>
                        <!--<div class="col-lg-4 col-md-4 col-xs-12">
                            <a href="" class="tiles">
                                <div class="practise-3-item economic_img">
                                    <div class="icon-box"><img
                                            src="http://45.115.99.197/cemilacnew/assets/images/home/project.png" title="Project-Banner" alt="Project"></div>
                                    <h5>SARAS</h5>
                                </div>
                            </a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <a href="" class="tiles">
                                <div class="practise-3-item environment_img">
                                    <div class="icon-box"><img
                                            src="http://45.115.99.197/cemilacnew/assets/images/home/Public-Grievances.png" title="Grievances-Banner" alt="Public">
                                    </div>
                                    <h5>TAPAS - UAV</h5>
                                </div>
                            </a>
                        </div>-->
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <a href=""  class="tiles">
                                <div class="practise-3-item gis_img">
                                    <div class="icon-box"><img
                                            src="th1/images/rti.png" title="RTI-Banner" alt="RTI"></div>
                                    <h5>Type Approvals</h5>
                                </div>
                            </a>
                        </div>
                      

                    </div>


                </div>

            </div>
<div class="col-lg-3 col-xs-12 col-md-3"></div>
<div class="right_section home-right-section" id="multilines2">
<div class="noticeTicker tikerBlock">
<h6 class="top_main">
Public Notice/Advertisement<span
                                class="ft_rt">
<i class="fa fa-bell" aria-hidden="true"></i>

                               
</span>
</h6>
                        <ul class="noticeTicker-list">

                                              
                            
                       
						</ul>
						<div class="view-all mt-20">
                                <span class="play">
                                    <a href="JavaScript:Void(0);" class="start-button" title="Play" aria-label="Play">
									<i class="fa fa-play" aria-hidden="true"></i>

									</a>
                                    <a href="JavaScript:Void(0);" class="stop-button" title="Pause" aria-label="Pause"><i class="fa fa-pause" aria-hidden="true"></i></a>
                                </span>
                                <span class="pull-right">
                                    <span class=""><a href="#"
                                            title="View All">{{ __('messages.viewall') }}</a></span>
                                </span>
                            </div>
                    </div>

                    <div class="orderticker pt-20 tikerBlock">
                        <h3 class="top_main">
                            Orders/Circulars DRDO                            <span class="ft_rt">
                                <i class="fa fa-first-order" aria-hidden="true"></i>

                                
                            </span>

                        </h3>

                        <ul class="orderticker-list">

                            <li class="border-bottom border-bottom2 border-bottom3 top_main2"></li>
                                                                                                                                            

                        </ul>
                        <div class="view-all mt-20">
                            <span class="playpause">
                                <a href="JavaScript:Void(0);" class="start-button" title="Play"  aria-label="Play">
								<i class="fa fa-play"></i></a>
                                <a href="JavaScript:Void(0);" class="stop-button" title="Pause"  aria-label="Pause">
								<i class="fa fa-pause"></i></a>
                            </span>
                            <span class="pull-right">
                                <span class=""><a href="#" title="View All">{{ __('messages.viewall') }}</a></span>
                            </span>
                        </div>
                    </div>




                    <!--        NEWS START TICKER  ------------------>
                    <div class="newsTicker pt-20 tikerBlock">

                        <h3 class="top_main">
                            What's New<span
                                class="ft_rt">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               
                            </span>
                        </h3>
                        <ul class="tp-top newsTicker-list">

                           
                                                                                    							
                        </ul>

                        <div class="view-all p-10 positionunset mt-20">
                        <span class="playpause">
                         <a href="JavaScript:Void(0);" class="start-button" title="Play" aria-label="Play">
						<i class="fa fa-play"></i></a>
                        <a href="JavaScript:Void(0);" class="stop-button" title="Pause"  aria-label="Pause">
						<i class="fa fa-pause"></i></a>
                        </span>
                        <span class="pull-right">
                        <span class="">
						<a href="#" title="View All">{{ __('messages.viewall') }}</a></span>
                        </span>
                        </div>
                    </div>

                    <!--        NEWS END TICKER  ------------------>

                </div>
                
                
</div>



      
    
  </div>
</section>
<!--end of public notice-->

<!--six items-->



@endsection