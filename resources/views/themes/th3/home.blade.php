	@extends('layouts.themes') @section('content')
@php
$langid1 = session()->get('locale')??1;
@endphp

<style>
.card {
    width: -webkit-fill-available !important;
}
</style>

<!--**************************** navbar responsive   https://codepen.io/typo3-freelancer/pen/poEvyGj ****************************-->
<!-- <form class="d-flex">
              <div class="input-group">
                <input class="form-control mr-2" type="search"
                  placeholder="Search" aria-label="Search">
                <button class="btn btn-primary border-0"
                  type="submit">Search</button>
              </div>
            </form> -->


<!--*********************** banner carousel https://codepen.io/adorade/pen/YzdEbyr*********************** -->
<!--*********************** banner carousel https://codepen.io/adorade/pen/YzdEbyr*********************** -->


<div class="owl-carousel owl-carousel1 banner_carousel owl-theme vh-50" id="main_banner">
    @if(!empty($banner))
    @foreach($banner as $key => $val)
    <div class="item" data-bs-interval="12000">
        <a href="{{$val->banner_link ? $val->banner_link : ''}}" target="_blank">
            <img src="{{ URL::asset('public/upload/admin/cmsfiles/banner/thumbnail/') }}/{{$val->txtuplode}}"
                alt="{{$val->title}}" class="banner_img vh-50">
        </a>
        <!-- <div class="carousel-caption kb-caption kb-caption-left">
            <h1 data-animation="animated">Jago Grahak Jago</h1>
            <h3 data-animation="animated">Department of Consumer Affairs</h3>
        </div> -->
    </div>
    @endforeach
    @endif
</div>







<!-- ********************about us, ministers, twitter section ******************** -->

<section class="about_detail bg-white py-3">
    <div class="container">
        <div class="row my-3">
            <!-- minister-section -->
            <div class="minister-section col-12 col-lg-4 px-md-0 rounded shadow-lg">
                <div class=" border-red border-maroon-top1">
                    <h4 class="ms-2 text-dark text-start text-capitalize pt-2 px-3 mb-2">
                        @if($langid1 == 1)
                        Hon'ble Ministers
                        @else
                        माननीय मंत्रीगण
                        @endif
                    </h4>
                </div>


                <div class="d-flex flex-column">

                    @foreach($ministers as $val)

                    @php
                    $url = '';
                    $fcaebook_url = '';
                    $twiter_url = '';
                    $insta_url = '';

                    if ($val->officers_name == 'Sh Pralhad Joshi' || $val->officers_name == 'श्री प्रल्हाद जोशी') {
                    $url = 'https://sansad.in/ls/members/biographyM/3982?from=members';
                    $fcaebook_url = 'https://www.facebook.com/pralhadvjoshi/';
                    $twiter_url = 'https://x.com/joshipralhad?lang=en';
                    $insta_url = 'https://www.instagram.com/pralhadvjoshi/';
                    } elseif ($val->officers_name == 'Sh B L Verma' || $val->officers_name == 'श्री बी.एल.वर्मा') {
                    $url = 'https://sansad.in/rs/members/biography/2491';
                    $fcaebook_url = 'https://www.facebook.com/blvermaofficial/';
                    $twiter_url = 'https://x.com/blvermaup?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor';
                    $insta_url = 'https://www.instagram.com/blvermaup/';
                    } elseif ($val->officers_name == 'Smt Nimuben Jayantibhai Bambhaniya' || $val->officers_name ==
                    'श्रीमती निमुबेन जयंतीभाई बांभणिया') {
                    $url = 'https://sansad.in/ls/members/biographyM/5614?from=members';
                    $fcaebook_url = 'https://www.facebook.com/nimubenbjp/';
                    $twiter_url = 'https://x.com/Nimu_Bambhania?t=90Bcmz1hgh_lH1iCvNEUsw&s=09';
                    $insta_url = 'https://www.instagram.com/nimuben_bambhania/';
                    }
                    @endphp

                    <div class="d-flex gap-2 p-2">
                        <img class="img-fluid shadow-lg "
                            src="{{ URL::asset('public/upload/admin/cmsfiles/officers/thumbnail/')}}/{{ $val->txtuplode }}" alt="{{$val->officers_name}}" title="{{$val->officers_name}}"
                            srcset>
                        <div class="my-auto me-auto">
                            <a href="{{$url}}" target="_blank" style="color:#000 !important">
                                <p class="fw-bold mb-0 profile_heading">{{ $val->officers_name }}</p>
                                <p class="profile_sub_head">{{ $val->designation }} </p>
                            </a>

                            <div class="profile_social_icons">
                                <ul>
                                    <li><a href="{{ $url }}" target="_blank"><i
                                    class="fa-solid fa-circle-user pt-1"></i></a></li>
                                    <li><a href="{{ $fcaebook_url }}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="{{ $twiter_url }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="{{ $insta_url }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @endforeach


                </div>
            </div>
            <!-- square image slider section  -->
            <div class="minister_image_slider col-12 col-lg-5 bg-maroon text-white p-1 d-flex">


                <div class="owl-carousel owl-carousel1 images_slider owl-theme h-fit my-auto">

                    @foreach($poster as $val)
                    <div>
                        <a href="{{$val->banner_link ? $val->banner_link : ''}}" target="_blank" title="{{$val->title}}">
                            <img src="{{ URL::asset('public/upload/admin/cmsfiles/banner/thumbnail/') }}/{{$val->txtuplode}}"
                                alt="{{$val->title}}" class="img-fluid">
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>

            <!-- news section  -->
            <div class="col-12 col-lg-3 right-section p-0">
                <div class="h-100">
                    <div class="rounded shadow-lg h-inherit">
                        <div class=" border-red border-maroon-top1 mt-3 mt-md-0">
                            <div class="d-flex justify-content-between pt-2 px-3 mb-2 align-items-center">
                                <div class="heading d-flex">
                                    <img src="{{asset('/public/themes/th3/assets/images/Reform Booklets.jpg')}}" alt="Reform Booklets" style="height:26px" />
                                    <h4 class="my-auto">
                                        @if($langid1 == 1)
                                        Latest News
                                        @else
                                        ताजा खबर
                                        @endif
                                    </h4>
                                </div>
                                <div class="px-1">
                                    <a class="btn btn-sm btn-danger" href="{{ url('pages/latest-news') }}">
                                        @if($langid1 == 1)
                                        View All
                                        @else
                                        सभी देखें
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="holder logo-slider-Y" data-v-4ef8651c="">
                            <ul class="logos-slide-Y h-100 px-1" data-v-4ef8651c="">

                                @foreach($whatsnew as $mods)
                                @if($mods->menutype==2)
                                <li>
                                    <i class="fa-solid fa-arrow-right"></i>
                                    <a class="" target="_blank"
                                        href="{{ url('/public/upload/admin/cmsfiles/whatsnews/') }}/{{$mods->txtuplode}}"
                                        title="{{$mods->title}}">
                                        {{$mods->title}} <img
                                            src="{{ asset('/public/themes/th3/assets/images/pdf_new_icon.png')}} "
                                            style="height:30px" alt="pdf_icon" />
                                    </a>

                                    <br /><span
                                        style="font-size:13px; font-weight:600">{{ date('d-m-Y', strtotime($mods->startdate)) }}
                                    </span>
                                </li>
                                <hr class="my-0">
                                @elseif($mods->menutype==3)
                                <li>
                                    <i class="fa-solid fa-arrow-right"></i>
                                    <a class="" target="_blank" href="{{$mods->txtweblink}}" title="{{$mods->title}}">
                                        {{$mods->title}} 
                                    </a>
                                    <br /><span
                                        style="font-size:13px; font-weight:600">{{ date('d-m-Y', strtotime($mods->created_at)) }}
                                    </span>
                                </li>
                                <hr class="my-0">
                                @else
                                <li>
                                    <i class="fa-solid fa-arrow-right"></i>
                                    <a class="" target="_blank"
                                        href="@if($mods->page_url=='#') '' @else {{ url('/news') }}/{{$mods->page_url}} @endif"
                                        title="{{$mods->title}}">
                                        {{$mods->title}} <img
                                            src="/dca/public/themes/th3/assets/images/pdf_new_icon.png"
                                            style="height:30px" alt="pdf_icon" />
                                    </a>
                                    <br /><span
                                        style="font-size:13px; font-weight:600">{{ date('d-m-Y', strtotime($mods->created_at)) }}
                                    </span>
                                </li>
                                <hr class="my-0">
                                @endif
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            var copy = document.querySelector(".logos-slide-Y").cloneNode(true);
            document.querySelector(".logo-slider-Y").appendChild(copy);
            </script>

        </div>
    </div>

    </div>
    </div>
</section>


<!-- ********************Important links, podast and news section ******************** -->
<section class="position-relative z-2">
    <div class="container imp-news-sec">
        <div class="row align-items-stretch">
            <div class="col-12 col-md-8 left-section ps-md-0">

                <div class="important-links border-2 rounded mb-3 bg-white">
                    <h5 class="text-center mt-3 fw-light">
                        @if($langid1 == 1)
                        IMPORTANT LINKS
                        @else
                        महत्वपूर्ण लिंक
                        @endif
                    </h5>

					<div class="row row-cols-2 row-cols-md-5 gap-md-0 g-2 py-2">	
                        @foreach($importantLink as $val)
						<div class="col">
                        <div class="card wallet p-2 p-md-3 h-100 shadow justify-content-start" title="{{ $val->title }}">
                            <a href="{{ $val->logo_url }}" target="_blank"> 
                                <img src="{{ ('public/upload/admin/cmsfiles/logo/thumbnail/') }}{{$val->txtuplode}}" alt="{{ $val->title }}">
                                <div class="overlay"></div>
                                <p>{{$val->title}}</p>
                            </a>
                        </div>
						</div>
                        @endforeach
					   <div class="col">
                        <div class="card wallet p-2 p-md-3 h-100 shadow justify-content-start" title="{{ $langid1 == 1 ? 'View All' : 'सभी देखें' }}">
                            <a href="{{ url('pages/important-link') }}">
                                <img src="{{ asset('/public/themes/th3/assets/images/view-all.webp') }}" alt="{{ $langid1 == 1 ? 'View All' : 'सभी देखें' }}">
                                <div class="overlay"></div>
                                <p>
                                    @if($langid1 == 1)
                                    View All
                                    @else
                                    सभी देखें
                                    @endif
                                </p>
                            </a>
                        </div>
						</div>
					</div>
                    </div>

                <div class="podcast-section border-2 rounded bg-white">

                    <h5 class="text-center mt-3 fw-light">
                        @if($langid1 == 1)
                        Rap Song
                        @else
                        रैप गीत
                        @endif
                    </h5>
                    <div class="podcast_start">

                        <div class="podcast_overflow">
                            @foreach($podcasts as $val)
                            <div class="d-flex">
                                <div class="w-50 my-auto">
                                    <p>{{ $val->title }}</p>
                                </div>
                                <div>
                                    <audio controls>
                                        <source
                                            src="{{ URL::asset('public/upload/admin/cmsfiles/podcast/')}}/{{$val->txtuplode}}"
                                            type="audio/mpeg">
                                    </audio>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($podcasts && $podcasts->count() > 0)
                        <div class="text-right mt-2 mb-1 me-md-5">

                            <a href="{{ url('pages/rap-songs') }}" class="btn btn-sm btn-danger">
                                @if($langid1 == 1)
                                View All
                                @else
                                सभी देखें
                                @endif
                            </a>

                        </div>
                        @else
                        <div class="text-right mt-3 mb-1">
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- social media section  -->
            <div class="col-12 col-md-4 ps-md-0 my-auto pe-md-0 mt-3 mt-md-0">
              
                <div class="pl-md-2">
                    <a class="twitter-timeline shadow-lg" data-height="430" data-theme="light"
                        href="https://twitter.com/jagograhakjago?ref_src=twsrc%5Etfw">Tweets
                        by jagograhakjago</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                <!-- </div> -->

            </div>
        </div>
</section>

<!-- ******************* Photo Gallery section ******************* -->
<section>
    <div class="container justify-content-center gallery-section mt-5 px-0">
        <div class="d-flex justify-content-center mb-3">
            <div class="gallery-section text-center heading  border-red border-3 w-25">
                <h3 class="mb-1">
                    @if($langid1 == 1)
                    Media Section
                    @else
                    मीडिया अनुभाग
                    @endif
                </h3>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!-- Photo Slider -->
                <div class="col-12 col-lg-6 p-0">
					<div class="position-relative">
						<div id="photoCarousel" class="carousel slide p-2" data-bs-ride="carousel">
							<div class="carousel-inner" height="365">
								@if(!empty($photogallery))
								@foreach($photogallery as $index => $image)
								@php
								$images = explode(',',$image->txtuplode);
								@endphp
								<div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
									<img src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/' . $images[0])}}"
										class="d-block w-100 rounded-3" alt="{{ $image->title }}" title="{{ $image->title }}" height="365"
										style="object-fit:fill !important">
								</div>
								@endforeach
								@else
								<div class="carousel-item active">
									<img src="https://consumeraffairs.nic.in/sites/default/files/4_2.jpeg"
										class="d-block w-100 rounded-3" alt="Photo 1" height="365">
								</div>
								<div class="carousel-item">
									<img src="https://consumeraffairs.nic.in/sites/default/files/2_1.jpeg"
										class="d-block w-100 rounded-3" alt="Photo 2" height="365">
								</div>
								<div class="carousel-item">
									<img src="https://consumeraffairs.nic.in/sites/default/files/1_2.jpeg"
										class="d-block w-100 rounded-3" alt="Photo 3" height="365">
								</div>
								@endif
							</div>
							<button class="carousel-control-prev" type="button" data-bs-target="#photoCarousel"
								data-bs-slide="prev">
								<i class="fa fa-angle-left" aria-hidden="true"></i>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#photoCarousel"
								data-bs-slide="next">
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</button>
						</div>
						<div class="position-absolute z-5 top-0 start-0 m-2">
							<a href="{{ url('pages/photo-gallery') }}" class="btn btn-sm btn-primary">
								{{ $langid1 == 1 ? 'See All' : 'सभी देखें' }}
							</a>
						</div>
					</div>
                </div>

                <!-- Video Slider -->
                <div class="col-12 col-lg-6 p-0">
                    <div id="videoCarousel" class="carousel slide p-2" data-bs-ride="carousel">
                        <div class="carousel-inner" height="365">
							@php $i = 1; @endphp
                            @if(!empty($videoGallery))
                            @foreach($videoGallery as $index => $val)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <iframe id="video{{ $i }}" width="100%" height="365" class="rounded-3"
                                    src="https://www.youtube.com/embed/{{ $val->video_id }}?enablejsapi=1" title="{{ $val->title }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            @endforeach
                            @endif
                           
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel"
                            data-bs-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel"
                            data-bs-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
				 <script src="https://www.youtube.com/iframe_api"></script>
                <script>
                    let players = [];

                    function onYouTubeIframeAPIReady() {
                        const iframes = document.querySelectorAll('iframe[src*="youtube.com/embed"]');

                        iframes.forEach((iframe, index) => {
                            iframe.setAttribute('id', `player${index}`); // Ensure each has unique ID
                            players[index] = new YT.Player(`player${index}`, {
                                events: {
                                    'onStateChange': onPlayerStateChange
                                }
                            });
                        });
                    }

                    function onPlayerStateChange(event) {
                        if (event.data === YT.PlayerState.PLAYING) {
                            players.forEach(player => {
                                if (player !== event.target) {
                                    player.pauseVideo();
                                }
                            });
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</section>

<section>
<div class="container mt-5 px-0">
        <div class="d-flex justify-content-center mb-3">
            <div class="text-center text-black heading border-red border-3 w-25">
                <h3 class="mb-1 ">
                    @if($langid1 == 1)
                    Success Story
                    @else
                    सफलता की कहानी
                    @endif
                   
                </h3>
            </div>
        </div>

        <div class="row">
            <!-- Left Box -->
            <div class="col-12 col-lg-6 p-3">
                <div class="border rounded-3 p-4 h-100">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center pb-2 mb-3" style="border-bottom: 2px  solid red;">

                        <h5 class="mb-0">
                            {{ $langid1 == 1 ? 'E-Jagriti' : 'ई-जागृति' }}
                        </h5>
                        <a href="{{ url('pages/e-jagriti') }}" class="btn btn-sm text-white" style="background-color: red;">
                            {{ $langid1 == 1 ? 'See All' : 'सभी देखें' }}
                        </a>
                    </div>

                    <!-- List Items -->
                    @foreach($jagrati as $story)
                    <div class="d-flex align-items-start mb-2">
                        <span class="text-danger me-2 mt-1">&#10148;</span>
                        <div>
                            <span style="color: #555; font-size: 15px;">
                                {{ preg_replace('/^p(.*?)\/p$/', '$1', $story->description) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Box -->
            <div class="col-12 col-lg-6 p-3">
                <div class="border rounded-3 p-4 h-100">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center pb-2 mb-3" style="border-bottom: 2px  solid red;">
                        <h5 class="mb-0">
                            {{ $langid1 == 1 ? 'National Consumer Helpline' : 'राष्ट्रीय उपभोक्ता हेल्पलाइन' }}
                        </h5>
                        <a href="{{ url('pages/nch-resources') }}" class="btn btn-sm text-white" style="background-color: red;">
                            {{ $langid1 == 1 ? 'See All' : 'सभी देखें' }}
                        </a>
                    </div>

                    <!-- List Items -->
                
                    @foreach($ejagrati as $story)
                    <div class="d-flex align-items-start mb-2">
                        <span class="text-danger me-2 mt-1">&#10148;</span>
                        <div>
                            <span style="color: #555; font-size: 15px;">
                                {{ preg_replace('/^p(.*?)\/p$/', '$1', $story->description) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <div class="py-3 brand-logo bg-white position-relative z-4">
    <div class="logos container">

        <div class="logo-slider" data-v-4ef8651c="">
            <div class="logos-slide" data-v-4ef8651c="">

                @foreach($logos as $val)
                <a href="{{ $val->logo_url ? $val->logo_url : '#' }}" target="_blank" class=""><img
                        src="{{ ('public/upload/admin/cmsfiles/logo/thumbnail/') }}{{$val->txtuplode}}"
                        data-v-4ef8651c="" alt="{{ $val->title }}" title="{{ $val->title }}"></a>
                @endforeach

            </div>
        </div>
        <script>
            var copy = document.querySelector(".logos-slide").cloneNode(true);
            document.querySelector(".logo-slider").appendChild(copy);
        </script>
    </div>
</div> -->

</html>
@endsection