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
            <form action="{{ url('pages', 'photo-gallery') }}" method="get" name="filterForm" accept-charset="utf-8"
                class="mb-3">
                @csrf
                <input type="hidden" name="_token" value="c0FFzRSJlCtN845ftmOAXwfpZIeNTD2MkRQoH2Zg" autocomplete="off">
                <div class="row gap-2">
                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <div class="form-group">
                            <input type="text" name="keywords" value="{{ $keywords }}" id="keywords"
                                class="input_class form-control alphNumDasSpcDotCommaBcsc" placeholder="Title">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <div class="form-group error-startdate">
                            <input type="date" name="startdate" id="startdate1" class="input_class form-control validDate1"
                                value="{{ $startdate }}" placeholder="From Date">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <button name="cmdsubmit_search_gallery" type="submit" class="btn btn-primary" id="cmdsubmit"
                            value="Search"> Search </button>
                    </div>
                </div>
            </form>

            <div class="content-div px-3"></div>

            <table border="1">
                <thead>
                    <tr>
                        <th class="text-nowrap">Sr No</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($data) > 0)
                        <?php 
                        $srNo = ($data->currentPage() - 1) * $data->perPage() + 1;
                        foreach ($data as $val) { 
                            $images = explode(",", $val->txtuplode);
                        ?>
                        <tr>
                            <td><?php echo $srNo++; ?></td>
                            <td><?php echo $val->title ?? ''; ?></td>
                            <td>{{ $val->eventdate ? date('d-m-Y', strtotime($val->eventdate)) : date('d-m-Y', strtotime($val->created_at)) }}</td>
                            <td>
                                <?php if (!empty($images[0])) { ?>
                                    <div class="position-relative">
                                        <img src="{{ URL::asset('public/upload/admin/cmsfiles/photos/') }}/<?php echo $images[0]; ?>" alt="{{ $val->title ?? 'Photo' }}" title="{{ $val->title ?? 'Photo' }}" style="width: 100px; height: auto;" />
                                        <div class="transparent-box" onclick="openModal('{{ URL::asset('public/upload/admin/cmsfiles/photos/')}}/<?php echo $images[0] ; ?>', [<?php for ($i=0; $i <count($images) ; $i++) { ?>'{{ URL::asset('public/upload/admin/cmsfiles/photos/')}}/<?php echo $images[$i] ; ?>',<?php } ?>])">
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    No image available
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    @else
                        <tr>
                            <td colspan="4">No records found.....</td>
                        </tr>
                    @endif
                </tbody>
            </table><br>
			
			{!! $data->withQueryString()->links('pagination::bootstrap-5') !!} @php $pageurl = substr(clean_single_input(request()->segment(2)),0,4); @endphp

            <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}:{{ get_last_updated_date($title) }} </span>
        </div>
    </div>
  </div>

    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01" alt="model-photo"/>
        <div class="d-flex justify-content-between slideshow-button w-100">
            <button class="slideshow-butto" onclick="prevSlide()">Previous</button>
            <button class="slideshow-butto" onclick="nextSlide()">Next</button>
        </div>
    </div>


@endsection