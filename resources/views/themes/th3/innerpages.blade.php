@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")
     
<style>
table tbody tr td a {
    color: #000 !important;
}
.default-text p {
    text-align: unset !important;
}
</style>

@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
             
<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->
<div class="container mx-auto">


<div class="row my-auto {{ $pageurl === 'whos-who' ? 'default-text' : 'inner_page' }}">
<!-- <div class="sidebar flex-shrink-0 col-md-2 col-xs-12 p-3"> -->

  <div class="flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
    @include("../themes.th3.includes.sidebar")
    
  </div>

  <div class="col-lg-9">
    <div class="content-div px-0 px-lg-3 inner_page_start">
        <h4 class="">{{$data->m_name}}</h4>
        <p>
		<div class="overflow-auto table-div">
		<?php echo !empty($data->content)?$data->content:$data->description; ?></p>
		</div>
    </div>

    <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
  </div>

</div>
</div>

<script>
document.body.innerHTML = document.body.innerHTML.replace(
    /([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,})/g,
    function(match, p1, p2, p3) {
        return p1.replace(/\./g, '[dot]') + '[at]' + p2.replace(/\./g, '[dot]') + '[dot]' + p3;
    }
);
</script>

@endsection
