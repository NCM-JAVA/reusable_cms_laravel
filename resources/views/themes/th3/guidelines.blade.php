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

        <div class="col-lg-9 col-md-9">
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
                            <input name="cmdsubmit" type="submit" class="btn btn-primary" id="cmdsubmit" value="Search" />
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table-striped table-bordered mt-3">
                        <thead class="table-danger">
                            <tr>
                                <th width="80%"> {{get_title('tttitle',$langid1)->title??शीर्षक }}</th>
                                <th width="20%"> {{get_title('download',$langid1)->title??डाउनलोड }}</th>
                            </tr>
                        </thead>
                        <tbody id="list">
                            @if(count($guideline) > 0)
                            <?php
                                $count = 1;
                                foreach($guideline as $row):
                            ?>
                                <tr>
                                    <td title="{{$row->menu_title}}"> {{$row->menu_title}} </td>
                                    <td> 
                                        <a target="_blank" class="btn btn-sm btn-primary" href="{{ URL::asset('public/upload/admin/cmsfiles/guidelines/')}}/{{$row->txtuplode}}" title="{{ URL::asset('public/upload/admin/cmsfiles/circulars/')}}/{{$row->txtuplode}}" > Downoad </a>
                                    </td>
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


                {!! $guideline->withQueryString()->links('pagination::bootstrap-5') !!} @php $pageurl = substr(clean_single_input(request()->segment(2)),0,4); @endphp

            </div>

            <span class="page-updated-date px-3 text-align-right">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
        </div>
    </div>
</div>


@endsection
