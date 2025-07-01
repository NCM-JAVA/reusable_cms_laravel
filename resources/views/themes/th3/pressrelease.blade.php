@extends('layouts.themes')

 <style>
    a.tender_link {
        color: rgba(var(--bs-link-color-rgb), 1) !important;
    }
 </style>

 @section('content')
 @include("../themes.th3.includes.breadcrumb")

 @php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
             
<!--************************breadcrumb********************-->

<div class="container mx-auto">
<div class="row my-auto inner_page">
    <div class="flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
    @include("../themes.th3.includes.sidebar")
    </div>

  <div class="col-lg-9">
    <div class="content-div px-0 px-lg-3 ">
        <h3 class="">{{$data->m_name}}</h3>
       
        <form action="{{ URL::to('pages/press-release') }}" method="post" name="filterForm" accept-charset="utf-8">
            @csrf
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group">
                        <input type="text" name="keywords" id="keywords" class="input_class form-control alphNumDasSpcDotCommaBcsc" autocomplete="off"  value="{{$keywords ?? old('keywords')}}" placeholder="Title" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group error-startdate">
                        <input type="date" name="startdate" id="startdate1" class="input_class form-control validDate1" autocomplete="off" value="{{$startdate ?? old('startdate')}}" placeholder="From Date" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group error-enddate">
                        <input type="date" name="enddate" id="enddate1" class="input_class form-control validDate1" autocomplete="off" value="{{$enddate ?? old('enddate')}}" placeholder="To Date" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <input name="cmdsubmit" type="submit" class="btn btn-primary" id="cmdsubmit" value="Search" />
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table-striped table-bordered mt-3 table_whoswho">
                <thead class="table-danger">
                    <tr>
                        <!-- <th> {{get_title('sl',$langid1)->title??क्रमांक }}</th> -->
                        <th width="15%"> {{$langid1 == 1 ? 'News Date' : 'समाचार दिनांक' }}</th>
                        <th width="75%"> {{get_title('tttitle',$langid1)->title??शीर्षक }}</th>
                        <!-- <th> {{$langid1 == 1 ? 'Description' : 'विवरण' }}</th> -->
                        <th width="10%"> {{get_title('download',$langid1)->title??डाउनलोड }}</th>
                        <!-- <th width="20%"> {{get_title('archive-date',$langid1)->title??'पुरालेख दिनांक' }}</th> -->
                    </tr>
                </thead>
                <tbody id="list">
                    @if(count($pressRelease) > 0)
                        <?php
                            $count = 1;
                            foreach($pressRelease as $row):
                        ?>
                        <tr>
                            <!-- <td> {{$count++}}</td> -->
                            <td>{{ \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') }} </td>
                            <td title="{{$row->title}}"> {{$row->title}} </td>
                            <!-- <td title="{{$row->description}}">{{$row->description}}</td> -->
                            <td class="link-invert"> 
                                @if($row->is_pdf)
                                    <img src="{{ asset('public/assets/img/icons/application-pdf.png') }}" alt="PDF Icon" /> 
                                @endif
                                @if(!empty($row->txtuplode))
                                    <a target="_blank" class="link-primary" href="{{ URL::asset('public/upload/admin/cmsfiles/pressRelease/')}}/{{$row->txtuplode}}" title="{{$row->txtuplode}}" > Download
                                @elseif(!empty($row->txtweblink))
                                    <a target="_blank" class="tender_link" href="{{$row->txtweblink}}" title="{{$row->txtweblink}}"  > {{$row->tender_title}}
                                @else
                                    <a target="_blank" class="tender_link" href="{{ url('/tenderivew') }}/{{$row->url}}" title="{{ url('/tenderivew') }}/{{$row->url}}" > {{$row->tender_title}}
                                @endif
                                @if($row->file_size)
                                    ({{$row->file_size}})
                                @endif
                                </a>
                            </td>
                            <!-- <td>{{$row->end_date}}</td> -->
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    @else
                        <tr>
                            <td colspan="6">No data found....</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


        {!! $pressRelease->withQueryString()->links('pagination::bootstrap-5') !!} @php $pageurl = substr(clean_single_input(request()->segment(2)),0,4); @endphp

    </div>

	<span class="px-3 text-align-left" style="font-weight:bold"> {{$langid1 == 1 ? 'Note' : '
टिप्पणी'}} : <a href="{{ $langid1 == 1 ? 'https://pib.gov.in/allRel.aspx?reg=3&lang=1' : 'https://pib.gov.in/allRel.aspx?reg=3&lang=2' }}" style="color:black;font-weight:bold"> {{$langid1 == 1 ? 'https://pib.gov.in/allRel.aspx?reg=3&lang=1' : 'https://pib.gov.in/allRel.aspx?reg=3&lang=2'}} </a> </span>
    <span class="page-updated-date px-3 text-align-right">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
  </div>
</div>
</div>

@endsection
