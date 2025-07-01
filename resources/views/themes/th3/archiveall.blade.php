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
             
<?php
    $archive_type = [];
    if($langid1 == 1){
        $archive_type = array(
            'tender' => "Tender",
            'circular' => "Circular",
            'vacancy' => "Vacancy",
            'press_release' => "Press Release",
            'latest_news' => "Latest News"
        );
    }else{
        $archive_type = array(
            'tender' => "निविदा",
            'circular' => "परिपत्र",
            'vacancy' => "रिक्ति",
            'press_release' => "प्रेस विज्ञप्ति",
            'latest_news' => "ताजा खबर"
        );
    }
?>

<div class="container mx-auto">
<div class="row inner_page">
    <div class="flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
    @include("../themes.th3.includes.sidebar")
    </div>

    <div class="col-lg-9">
        <div class="content-div px-3">
            <h3 class="">{{$data->m_name}} ({{$archiveType ? $archive_type[$archiveType] : ($langid1 == 1 ? 'Tender' : 'निविदा')}})</h3>
        
            <form action="" method="post" name="filterForm" accept-charset="utf-8">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <div class="form-group">
                            <select name="archiveType" id="archiveType" class="input_class form-control" autocomplete="off">
                                <option value="">{{ $langid1 == 1 ? 'Select Archive Type' : 'आर्काइव प्रकार चुनें' }}</option>
                                @foreach($archive_type as $key => $val)
                                    <option value="{{ $key }}" {{ old('archiveType', $archiveType ?? 'tender') == $key ? 'selected' : '' }}>
                                        {{ $val }}
                                    </option>
                                    <!-- <option value="{{ $key }}" {{ old('archiveType', $archiveType ?? '') == $key ? 'selected' : '' }}> {{ $val }}</option> -->
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xm-12">
                        <div class="form-group">
                            <input type="text" name="keywords" id="keywords" class="input_class form-control alphNumDasSpcDotCommaBcsc" autocomplete="off"  value="{{old('keywords')}}" placeholder="Title" />
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-xm-12">
                        <div class="form-group error-startdate">
                            <input type="date" name="startdate" id="startdate1" class="input_class form-control validDate1" autocomplete="off" value="" placeholder="From Date" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xm-12">
                        <div class="form-group error-enddate">
                            <input type="date" name="enddate" id="enddate1" class="input_class form-control validDate1" autocomplete="off" value="" placeholder="To Date" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-xm-12">
                        <input name="cmdsubmit" type="submit" class="btn btn-primary" id="cmdsubmit" value="Search" />
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table-striped table-bordered mt-3">
                    <thead class="table-danger">
                        <tr class="table_color">
                            <th> {{get_title('sl',$langid1)->title??क्रमांक }}</th>
                            <th> {{get_title('tttitle',$langid1)->title??शीर्षक }}</th>
                            <th width="13%"> {{$langid1 == 1 ? 'Archive Type' : 'पुरालेख प्रकार' }} </th>
                            <th> {{get_title('download',$langid1)->title??डाउनलोड }}</th>
                            <th width="15%"> {{get_title('published-on',$langid1)->title??'ऑनलाइन प्रकाशित किया गया' }}</th>
                            <th width="15%"> {{get_title('archive-date',$langid1)->title??'पुरालेख दिनांक' }}</th>
								
							@php
                                $archiveType = $archiveType ?? 'tender';
                            @endphp
                            @if(isset($archive_type[$archiveType]) && ($archive_type[$archiveType] == "Tender" || $archive_type[$archiveType] == "Vacancy"))
							<th> {{$langid1 == 1 ? 'Corrigendum Doc' : 'शुद्धिपत्र दस्तावेज़'}} </th>
							@endif
						
                        </tr>
                    </thead>
                    <tbody id="list">
                        @if(count($archive_data) > 0)
                        <?php
                            $count = ($archive_data->currentPage() - 1) * $archive_data->perPage() + 1;
                            foreach($archive_data as $row):
                        ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td title="{{$row->title ?? $row->tender_title}}"> {{$row->title ?? $row->tender_title}} </td>
                                <td title="{{ $row->circularstype == '1' ? 'Circular' : ($row->circularstype == '2' ? 'Vacancy' : ($row->tendertype ? 'Tender' : ($row->title ? 'Latest News' : 'Press Release'))) }}">{{ $row->circularstype == '1' ? 'Circular' : ($row->circularstype == '2' ? 'Vacancy' : ($row->tendertype ? 'Tender' : ($row->title ? 'Latest News' : 'Press Release'))) }} </td>
                                <td> 
                                    @if(!empty($row->txtuplode))
                                        <a target="_blank" class="btn btn-sm btn-primary" href="{{ $row->circularstype ? URL::asset('public/upload/admin/cmsfiles/circulars/'.$row->txtuplode) : ($row->tendertype ? URL::asset('public/upload/admin/cmsfiles/tenders/'.$row->txtuplode) : ($row->title ? URL::asset('public/upload/admin/cmsfiles/whatsnews/'.$row->txtuplode) : URL::asset('public/upload/admin/cmsfiles/pressRelease/'.$row->txtuplode))) }}" title="{{$row->txtuplode}}" > Download
                                    @elseif(!empty($row->txtweblink))
                                        <a target="_blank" class="tender_link" href="{{$row->txtweblink}}" title="{{$row->txtweblink}}"  > Link
                                    @else
                                        <a target="_blank" class="tender_link" href="{{ url('/tenderivew') }}/{{$row->url}}" title="{{ url('/tenderivew') }}/{{$row->url}}" > {{$row->title}}
                                    @endif
                                    <!-- {{$row->tender_title}} -->
                                    </a>
                                </td>
                                <td>{{ $row->start_date ? date('d-m-Y', strtotime($row->start_date)) : date('d-m-Y', strtotime($row->startdate)) }}</td>
                                <td>{{ $row->end_date ? date('d-m-Y', strtotime($row->end_date)) : date('d-m-Y', strtotime($row->enddate)) }}</td>
								
								@if(isset($archive_type[$archiveType]) && ($archive_type[$archiveType] == 'Tender' || $archive_type[$archiveType] == 'Vacancy'))
									<td>
										@php 
											$sn = 1;
										@endphp
										@if ($row->corrigendums && $row->corrigendums->count() > 0)
											@foreach($row->corrigendums as $val)
												<a class="link-primary" href="{{ URL::asset('public/upload/admin/cmsfiles/corrigendum/')}}/{{$val->txtuplode}}" target="_blank">{{$sn++ . '. ' .$val->title}}</a>
											@endforeach
										@endif
									</td>
								@endif
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

			{!! $archive_data->appends(request()->except('page'))->links('pagination::bootstrap-5') !!}
 @php $pageurl = substr(clean_single_input(request()->segment(2)),0,4); @endphp

        </div>

        <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
    </div>
</div>
</div>


@endsection
