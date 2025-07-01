@extends('layouts.themes') 
@section('content') 
@include("../themes.th3.includes.breadcrumb") 

@php 
    $pageurl = clean_single_input(request()->segment(2)); 
    $langid1 = session()->get('locale')??1; 
@endphp

<div class="row inner_page">
    <div class="flex-shrink-0 col-md-2 col-xs-12 pb-3">
        @include("../themes.th3.includes.sidebar")
    </div>


    <div class="col-lg-9 col-md-9"> 
        <div class="content-div px-3"></div>
            <div class=" border-red border-4 border-maroon mt-3 mt-md-0">
                <h2 class="ms-2 text-dark text-center text-capitalize">Social Media</h2>
            </div>
            <div class="mt-2 px-2">
                <a class="twitter-timeline" data-height="530" data-theme="light" href="https://twitter.com/jagograhakjago?ref_src=twsrc%5Etfw">Tweets by jagograhakjago</a> 
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
        </div>
    </div>
<div>

<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="img01" />
    <button class="slideshow-button" onclick="nextSlide()">Next</button>
</div>

@endsection
