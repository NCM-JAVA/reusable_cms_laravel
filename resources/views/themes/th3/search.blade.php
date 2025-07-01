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
            @php 
                $pageurl = clean_single_input(request()->segment(2));
                $pos=[1,4,2,3]; $langid=session()->get('locale')??1; 
            @endphp
                                     
            <ul>
                @foreach($results as $res) 
                    <li class="<?php if($res->m_url== $pageurl) echo "active" ?> has-sub b my-2"> 
                        @if($res->m_type==2)
                            <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$res->doc_uplode}}" title="{{$res->m_name}}"> 
                                <span><b>{{$res->m_name}} :</b> Department of consumer affairs </span>
                            </a>
                        @elseif($res->m_type==3)
                            <a target="_blank" href="{{$res->linkstatus}}" title="{{$res->m_name}}"> 
                                <span><b>{{$res->m_name}} : </b>Department of consumer affairs </span>
                            </a>
                        @else
                            <a href="@if($res->m_url=='#') '' @else {{ url('/pages') }}/{{$res->m_url}} @endif" title="{{$res->m_name}}"> 
                                <span><b>{{$res->m_name}} : </b> Department of consumer affairs </span>
                            </a><br>
                            <div class="text-success google_font">
                                <span>https://consumeraffairs.gov.in/ ></span>
                                <span>{{$res->m_url}}</span>
                            </div>
                            <?php 
                                $content= strip_tags($res->content);
                                $limittext = Str::limit($content, 120, '...');
                            ?>
                            <p class="google_font">{{$limittext}}</p>
                        @endif
                    </li>
                @endforeach
            </ul>

            @php 
                $pageurl = $title; 
            @endphp

            <span class="page-updated-date px-3 text-end">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($pageurl) }} </span>
        </div>
    </div>
</section>

@endsection
