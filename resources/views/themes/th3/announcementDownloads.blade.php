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
             
<!--************************breadcrumb********************-->

<div class="row inner_page">
<div class="flex-shrink-0 col-md-2 col-xs-12 pb-3">
   @include("../themes.th3.includes.sidebar")
</div>

  <div class="col-lg-10 col-md-10">
    <div class="content-div px-3">
        <h3 class="">{{$data->m_name}}</h3>
       
        <form action="" method="post" name="filterForm" accept-charset="utf-8">
            @csrf
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group">
                        <input type="text" name="keywords" id="keywords" class="input_class form-control alphNumDasSpcDotCommaBcsc" autocomplete="off"  value="{{old('keywords')}}" placeholder="Title" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group error-startdate">
                        <input type="date" name="startdate" id="startdate1" class="input_class form-control validDate1" autocomplete="off" value="" placeholder="From Date" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group error-enddate">
                        <input type="date" name="enddate" id="enddate1" class="input_class form-control validDate1" autocomplete="off" value="" placeholder="To Date" />
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
                        <th> {{get_title('tttitle',$langid1)->title??शीर्षक }}</th>
                        <th> {{$langid1 == 1 ? 'Description' : 'विवरण' }}</th>
                        <th> {{get_title('download',$langid1)->title??डाउनलोड }}</th>
                        <th> {{get_title('published-on',$langid1)->title??'ऑनलाइन प्रकाशित किया गया' }}</th>
                        <th> {{get_title('archive-date',$langid1)->title??'पुरालेख दिनांक' }}</th>
                    </tr>
                </thead>
                <tbody id="list">
                    @if(count($vacancy) > 0)
                    <?php
                        $count = 1;
                        foreach($vacancy as $row):
                    ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td title="{{$row->title}}"> {{$row->title}} </td>
                            <td title="{{$row->description}}">{{$row->description}}</td>
                            <td> 
                                @if(!empty($row->txtuplode))
                                    <a target="_blank" class="btn btn-sm btn-primary" href="{{ URL::asset('public/upload/admin/cmsfiles/tenders/')}}/{{$row->txtuplode}}" title="{{ URL::asset('public/upload/admin/cmsfiles/tenders/')}}/{{$row->txtuplode}}" > Downoad
                                @elseif(!empty($row->txtweblink))
                                    <a target="_blank" class="tender_link" href="{{$row->txtweblink}}" title="{{$row->txtweblink}}"  > {{$row->tender_title}}
                                @else
                                    <a target="_blank" class="tender_link" href="{{ url('/tenderivew') }}/{{$row->url}}" title="{{ url('/tenderivew') }}/{{$row->url}}" > {{$row->tender_title}}
                                @endif
                                </a>
                            </td>
                            <td><?php echo $row->startdate; ?></td>
                            <td><?php echo $row->enddate; ?></td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    @else
                        <tr>
                            <td colspan="6">
                                No data found....
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


        {!! $vacancy->withQueryString()->links('pagination::bootstrap-5') !!} @php $pageurl = substr(clean_single_input(request()->segment(2)),0,4); @endphp

    </div>

    <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
  </div>
</div>


@endsection
