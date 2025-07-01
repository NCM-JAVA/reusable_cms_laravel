@extends('layouts.themes') @section('content') @include("../themes.th3.includes.breadcrumb")
<!--************************breadcrumb********************-->
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
<!--**********************************mid part******************-->
<section>
    <div class="container">
        <div class="row">
          
        <div class="col-xs-12 col-sm-12">
<div class="content-div">
<h2>Visitor Analytics</h2>
<table  class="table table-bordered table-striped mt-3 mb-5" title="Screen Reader Access">
  <thead>
	  <tr>
		<th>Visitor IP Hindi</th>
		<th>Visitor IP English</th>
		<th>Device</th>
		<th>Browser</th>
	  </tr>
   </thead>
   <tbody>
		@foreach($visitorsData as $val)
			<tr>
				<td> {{ $visitorsCountHindi }} </td>
				<td> {{ $visitorsCountEnglish }} </td>
				<td> {{ $val->device }} </td>
				<td> {{ $val->browser }} </td>
			</tr>
		@endforeach
   </tbody>
</table>
</div>
</div>


        </div>
    </div>
</section>

@endsection
