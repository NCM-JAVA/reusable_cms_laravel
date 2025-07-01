@extends('layouts.themes') @section('content') @include("../themes.th3.includes.breadcrumb") @php $pageurl = clean_single_input(request()->segment(2)); $langid1 = session()->get('locale')??1; @endphp

<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->


<div class="row inner_page">
    <div class="sidebar flex-shrink-0 col-md-2 col-xs-12 p-3">
        @include("../themes.th3.includes.sidebar")
    </div>

    <div class="col-lg-9 col-md-9">
        <div class="content-div px-3"></div>
        <div class="d-flex gap-2">
            <div class="card">
            <img
        src="https://cdn.hasselblad.com/hasselblad-com/6cb604081ef3086569319ddb5adcae66298a28c5_x1d-ii-sample-01-web.jpg?auto=format&q=97"
        alt="Image 1"
        class="image"
        onclick="openModal('https://cdn.hasselblad.com/hasselblad-com/6cb604081ef3086569319ddb5adcae66298a28c5_x1d-ii-sample-01-web.jpg?auto=format&q=97', ['https://images.unsplash.com/photo-1612441804231-77a36b284856?auto=format&fit=crop&q=80&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bW91bnRhaW4lMjBsYW5kc2NhcGV8ZW58MHx8MHx8fDA%3D', 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg', 'https://petapixel.com/assets/uploads/2022/08/fdfs19-800x533.jpg'])"
    />
                <div class="category">Illustration</div>
                <h5>A heading that must span over two lines</h5>
            </div>
            <div class="card">
            <img
        src="https://cdn.hasselblad.com/hasselblad-com/6cb604081ef3086569319ddb5adcae66298a28c5_x1d-ii-sample-01-web.jpg?auto=format&q=97"
        alt="Image 1"
        class="image"
        onclick="openModal('https://cdn.hasselblad.com/hasselblad-com/6cb604081ef3086569319ddb5adcae66298a28c5_x1d-ii-sample-01-web.jpg?auto=format&q=97', ['https://images.unsplash.com/photo-1612441804231-77a36b284856?auto=format&fit=crop&q=80&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bW91bnRhaW4lMjBsYW5kc2NhcGV8ZW58MHx8MHx8fDA%3D', 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg', 'https://petapixel.com/assets/uploads/2022/08/fdfs19-800x533.jpg'])"
    />
                <div class="category">Illustration</div>
                <h5>A heading that must span over two lines</h5>
            </div>
            <div class="card">
            <img
        src="https://cdn.hasselblad.com/hasselblad-com/6cb604081ef3086569319ddb5adcae66298a28c5_x1d-ii-sample-01-web.jpg?auto=format&q=97"
        alt="Image 1"
        class="image"
        onclick="openModal('https://cdn.hasselblad.com/hasselblad-com/6cb604081ef3086569319ddb5adcae66298a28c5_x1d-ii-sample-01-web.jpg?auto=format&q=97', ['https://images.unsplash.com/photo-1612441804231-77a36b284856?auto=format&fit=crop&q=80&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bW91bnRhaW4lMjBsYW5kc2NhcGV8ZW58MHx8MHx8fDA%3D', 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg', 'https://petapixel.com/assets/uploads/2022/08/fdfs19-800x533.jpg'])"
    />
                <div class="category">Illustration</div>
                <h5>A heading that must span over two lines</h5>
            </div>
        </div>

        <span class="page-updated-date px-3 text-align-right">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
    </div>
</div>
<div>


<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <p style="position: absolute; width: 100%; display: flex; justify-content: center; color: #fff;">sample test</p>
    <img class="modal-content" id="img01" />
    <button class="slideshow-button" onclick="nextSlide()">Next</button>
</div>


@endsection
