@extends('layouts.themes')

 

 @section('content')

 <style>
    a.tender_link {
        color: rgba(var(--bs-link-color-rgb), 1) !important;
    }
 </style>
 
 @include("../themes.th3.includes.breadcrumb")

 @php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
             

<div class=" inner_page mb-5 mt-2">
  <div class="container"> 
    <div class="content-div px-3">
       
        <form action="{{ url('pages', 'latest-news') }}" method="post" name="filterForm" accept-charset="utf-8">
            @csrf
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group">
                        <input type="text" name="keywords" id="keywords" class="input_class form-control alphNumDasSpcDotCommaBcsc" autocomplete="off"  value="{{ old('keywords', $searchInputs['keywords'] ?? '') }}" placeholder="Title" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group error-startdate">
                        <input type="date" name="startdate" id="startdate1" class="input_class form-control validDate1" autocomplete="off" value="{{ old('startdate', $searchInputs['startdate'] ?? '') }}" placeholder="From Date" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group error-enddate">
                        <input type="date" name="enddate" id="enddate1" class="input_class form-control validDate1" autocomplete="off" value="{{ old('enddate', $searchInputs['enddate'] ?? '') }}" placeholder="To Date" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <input name="cmdsubmit" type="submit" class="btn btn-primary" id="cmdsubmit" value="Search" />
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3">
                <thead class="table-danger">
                    <tr>
                        <th> {{get_title('sl',$langid1)->title??क्रमांक }}</th>
                        <th width="35%"> {{get_title('tttitle',$langid1)->title??शीर्षक }}</th>
                        <th> {{get_title('download',$langid1)->title??डाउनलोड }}</th>
                        <th> {{get_title('published-on',$langid1)->title??'ऑनलाइन प्रकाशित किया गया' }}</th>
                        <th> {{get_title('archive-date',$langid1)->title??'पुरालेख दिनांक' }}</th>
                    </tr>
                </thead>
                <tbody id="list">
                    @if(count($data) > 0)
                        <?php
                            $count = ($data->currentPage() - 1) * $data->perPage() + 1;
                            foreach($data as $key=>$row){
                        ?>
                        <tr>
                            <td>{{ $count + $key }}</td>
                            <td title="{{$row->title}}"> {{$row->title}} </td>
                            <td> 
                                @if($row->is_pdf)
                                    <img src="{{ asset('public/assets/img/icons/application-pdf.png') }}" alt="PDF Icon" /> 
                                @endif
                                @if(!empty($row->txtuplode))
                                    <a target="_blank" class="link-primary" href="{{ URL::asset('public/upload/admin/cmsfiles/whatsnews/')}}/{{$row->txtuplode}}" title="{{ URL::asset('public/upload/admin/cmsfiles/tenders/')}}/{{$row->txtuplode}}" > Download
                                @elseif(!empty($row->txtweblink))
                                    <a target="_blank" class="tender_link" href="{{$row->txtweblink}}" title="{{$row->txtweblink}}"  > View
                                @else
                                    <a target="_blank" class="tender_link" href="{{ url('/tenderivew') }}/{{$row->url}}" title="{{ url('/tenderivew') }}/{{$row->url}}" > {{$row->tender_title}}
                                @endif
                                @if($row->file_size)
                                    ({{$row->file_size}})
                                @endif
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($row->startdate)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->enddate)->format('d-m-Y') }}</td>
                        </tr>
                        <?php
                            }
                        ?>
                    @else
                        <tr>
                            <td colspan="6">No data found....</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!} @php $pageurl = substr(clean_single_input(request()->segment(2)),0,4); @endphp

    </div>

    <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
  </div>
</div>


@endsection
