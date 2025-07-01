@extends('layouts.themes') 

@section('content') 
    @include("../themes.th3.includes.breadcrumb") 
    @php 
        $pageurl = clean_single_input(request()->segment(2)); 
        $langid1 = session()->get('locale')??1; 
    @endphp

 <div class="container mx-auto">
 <div class="row inner_page">
        <div class="flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
            @include("../themes.th3.includes.sidebar")
        </div>
        <div class="col-lg-9"> 
            <form action="{{ url('pages', 'video-gallery') }}" method="get" name="filterForm" accept-charset="utf-8" class="mb-3">
                @csrf
                <input type="hidden" name="_token" value="c0FFzRSJlCtN845ftmOAXwfpZIeNTD2MkRQoH2Zg" autocomplete="off">            
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <div class="form-group">
                            <input type="text" name="keywords" value="{{ $keywords }}" id="keywords" class="input_class form-control alphNumDasSpcDotCommaBcsc" placeholder="Title">
                        </div> 
                    </div>
                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <div class="form-group error-startdate">
                            <input type="date" name="startdate" id="startdate1" class="input_class form-control validDate1" value="{{ $startdate }}" placeholder="From Date">
                        </div>
                    </div>   
                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <button name="cmdsubmit_search_gallery" type="submit" class="btn btn-primary" id="cmdsubmit" value="Search"> Search </button>
                    </div>
                </div>
            </form>
            <div class="content-div px-3"></div>
            <div class="row m-0">
				@php $i = 1; @endphp
                @if(count($data) > 0)
                    @foreach($data as $val)
                    <div class="card col-6 col-lg-4 px-1 py-2">
                        <div class="media">
                            <div class="media-body">
                                <iframe id="video{{ $i }}" width="300" height="200" src="https://www.youtube.com/embed/{{ $val->video_id }}?enablejsapi=1" frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                        <div class="category">{{ $val->title??''}}</div>
                    </div>
                    @endforeach
                @else
                    <h4> No records found..... </h4>
                @endif
            </div>
                <div class="my-3 d-flex justify-content-end">
                        <a target="_blank" href="https://www.youtube.com/@departmentofconsumeraffair2693" class="bg-maroon btn btn-xs">View All</a>
                </div>
				
			<span class="px-3 text-align-left position-sticky top-100">
                <a target="_blank" href="https://jagograhakjago.gov.in/ConsumerAwareness/new/video/index.html" style="color:blue">Videos</a>
            </span>
			
            <span class="page-updated-date px-3 text-align-right position-sticky top-100">
                {{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} 
            </span>
        </div>
    </div>
 </div>

    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01" />
        <button class="slideshow-button" onclick="nextSlide()">Next</button>
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

@endsection
