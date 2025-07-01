@extends('layouts.themes') @section('content') @include("../themes.th3.includes.breadcrumb")
<!--************************breadcrumb********************-->
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
<!--**********************************mid part******************-->
<section>
    <div class="container sitemap">
        <div class="row">
            @php $pageurl = clean_single_input(request()->segment(2)); $pos=[1,4,2,3]; $langid=session()->get('locale')??1; @endphp

            <div class="col-sm-12">
                <div class="content-div">
                    <h1 class="">{{$title}}</h1>

                    <ul class="nav navbar-nav">
                        @php 
                            $res2 =get_sitemap($langid,$pos,0); 
                        @endphp 
                        @foreach($res2 as $mod) 
                            <li class="<?php if($mod->m_url== $pageurl) echo "active" ?> has-sub a"> 
                                @if($mod->m_type==2)
                                    <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}"> 
                                        <span>{{$mod->m_name}} </span>
                                    </a>
                                @elseif($mod->m_type==3)
                                    <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}"> 
                                        <span>{{$mod->m_name}} </span>
                                    </a>
                                @else
                                    <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}"> 
                                        <span>{{$mod->m_name}} </span>
                                    </a>
                                @endif
                            </li>

                            <?php  
                                if(has_child($mod->id, $mod->language_id) > 0){ 
                            ?>
                                <ul>
                                    <?php  
                                        $ress= get_sitemap($mod->language_id,$pos,$mod->id) ; 
                                    ?> 
                                    @foreach($ress as $mods) 
                                        <li class="<?php if($mods->m_url== $pageurl) echo 'active' ?> has-sub b"> 
                                            @if($mods->m_type==2)
                                                <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}"> 
                                                    <span>{{$mods->m_name}} </span>
                                                </a>
                                            @elseif($mods->m_type==3)
                                                <a target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}"> 
                                                    <span>{{$mods->m_name}} </span>
                                                </a>
                                            @else
                                                <a href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}"> 
                                                    <span>{{$mods->m_name}} </span>
                                                </a>
                                            @endif
                                        </li>

                                        <?php  
                                            if(has_child($mods->id, $mods->language_id) > 0){ 
                                        ?>
                                            <ul>
                                                <?php  
                                                    $resss= get_sitemap($mods->language_id,$pos,$mods->id); 
                                                ?> 
                                                @foreach($resss as $modss) 
                                                    <li class="<?php if($modss->m_url== $pageurl) echo 'active' ?> has-sub b"> 
                                                        @if($modss->m_type==2)
                                                            <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$modss->doc_uplode}}" title="{{$modss->m_name}}"> 
                                                                <span>{{$modss->m_name}} </span>
                                                            </a>
                                                        @elseif($modss->m_type==3)
                                                            <a target="_blank" href="{{$modss->linkstatus}}" title="{{$modss->m_name}}"> 
                                                                <span>{{$modss->m_name}} </span>
                                                            </a>
                                                        @else
                                                            <a href="@if($modss->m_url=='#') '' @else {{ url('/pages') }}/{{$modss->m_url}} @endif" title="{{$modss->m_name}}"> 
                                                                <span>{{$modss->m_name}} </span>
                                                            </a>
                                                        @endif 
                                                    </li>
                                                @endforeach
                                            </ul>
                                        <?php } ?>
                                    @endforeach
                                </ul>
                            <?php } ?>

                        @endforeach
                    </ul>
                </div>
                @php $pageurl = $title; @endphp

                <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($pageurl) }} </span>
            </div>
        </div>
    </div>
</section>

@endsection
