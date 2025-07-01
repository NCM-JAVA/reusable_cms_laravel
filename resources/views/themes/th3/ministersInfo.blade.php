@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")
     
<style>
    a.tender_link {
        color: rgba(var(--bs-link-color-rgb), 1) !important;
    }
    th{
        font-size:85%;
    }
    td{
        font-size:80%;
    }
    table {
        table-layout: fixed;
        width: 100%;
    }
    td, th {
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
    }
    .row_bold{
        font-weight:bold;
    }
	
 </style>  

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
            <div class="content-div px-3">
            
                <form action="{{ url('pages', 'whos-who') }}" id="myForm" method="post" name="filterForm" accept-charset="utf-8">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xm-12">
                            <div class="form-group">
							@if($langid1 == 1)
							<input type="text" name="name" id="name" class="input_class form-control" autocomplete="off"  value="{{$name ?? old('name')}}" placeholder="Name" />
							@else
								<input type="text" name="name" id="name" class="input_class form-control" autocomplete="off"  value="{{$name ?? old('name')}}" placeholder="नाम" />
							@endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xm-12">
                            <div class="form-group">
							@if($langid1 == 1)
                                <input type="text" name="email" id="email" class="input_class form-control" autocomplete="off"  value="{{$email ?? old('email')}}" placeholder="Email" />
							@else
								<input type="text" name="email" id="email" class="input_class form-control" autocomplete="off"  value="{{$email ?? old('email')}}" placeholder="ईमेल" />
                            @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-xm-12">
						@if($langid1 == 1)
                           <input name="cmdsubmit" type="submit" class="btn btn-primary" id="cmdsubmit" value="Search" />
					       <input name="resetsubmit" type="submit" class="btn btn-danger" value="Reset" />
					   @else
						   <input name="cmdsubmit" type="submit" class="btn btn-primary" id="cmdsubmit" value="खोज" />
					        <input name="resetsubmit" type="submit" class="btn btn-danger" value="रीसेट" />
					   @endif
                        </div>
                    </div>
                </form>
                @if(count($data) > 0)
                @foreach ($data as $type => $rows)
                
                    <h5 class="mt-5"><b>
                    {{ ministers_info_type($type, $langid) ? ministers_info_type($type, $langid) : '' }}
                    </b></h5>
                    
					<div class="overflow-x-auto">
						<table class="table-striped table-bordered mt-3 table_whoswho min-w-max-content">
							<thead class="table-danger">
								<tr>
									<th width="18%"> @if($langid1 == 1) Name @else नाम @endif </th>
									<th width="30%"> @if($langid1 == 1) Designation @else पद का नाम @endif </th>
									<th width="15%"> @if($langid1 == 1) Office No. @else कार्यालय का नम्बर @endif </th>
									<th width="12%"> @if($langid1 == 1) Intercom @else इण्टरकॉम @endif </th>
									<th width="15%"> @if($langid1 == 1) Email ID @else ईमेल आईडी @endif</th>
									<th width="10%"> @if($langid1 == 1) Room No. @else कमरा न. @endif </th>
								</tr>
							</thead>
							<tbody>
								@if (count($rows) > 0)
									@foreach ($rows as $row)
										<tr @if($row->flag_id == 1) class="row_bold" @endif>
											<td width="15%">{{ $row->name }}</td>
											<td width="30%" style="text-align: left;">{{ $row->designation }}</td>
											<td width="15%" style="text-align: left"> 
												@foreach(explode(',', $row->office_no) as $office)
													{{ $office }} <br>
												@endforeach
											</td>
											<td width="10%" style="text-align: left">{{ $row->intercom }}</td>
											<td width="20%">{{ $row->email }}</td>
											<td width="10%">{{ $row->room_no }}</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="7" class="text-center">No data found....</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
                @endforeach
                @else
                    <p class="mt-5"> No result found....</p>
                @endif
            </div>
            <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
        </div>
    </div>
</div>

@endsection
