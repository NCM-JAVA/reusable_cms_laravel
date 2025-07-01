@extends('layouts.themes') @section('content') @include("../themes.th3.includes.breadcrumb") @php $pageurl = clean_single_input(request()->segment(2)); $langid1 = session()->get('locale')??1; @endphp

<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->


<div class="container mx-auto">
<div class="row my-auto inner_page">
    <div class="flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
        @include("../themes.th3.includes.sidebar")
    </div>
        <!-- Name: Kesh Kumar
        Date: 02-11-23
        Reason: This modal is dymically change the image.  -->

    <div class="col-lg-9"> 
     
        <form action="{{ url('pages', 'rap-songs') }}" method="get" name="filterForm" accept-charset="utf-8" class="mb-3">
            @csrf
            <input type="hidden" name="_token" value="c0FFzRSJlCtN845ftmOAXwfpZIeNTD2MkRQoH2Zg" autocomplete="off">            
            <div class="row gap-2">
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
        <div class="d-flex rapsong gap-2">
            @foreach($data as $val)
            <div class="card">
                <audio controls>
                    <source src="{{ URL::asset('public/upload/admin/cmsfiles/podcast/')}}/{{$val->txtuplode}}" type="audio/mpeg"> 
                </audio>
                <div class="category">{{ $val->title??''}}</div>
            </div>
            @endforeach
            
        </div>

        <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
    </div>
</div>
</div>
<div>


<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="img01" />
    <button class="slideshow-button" onclick="nextSlide()">Next</button>
</div>


@endsection
