@extends('layouts.themes')
 @section('content')
 @include("../themes.th2.includes.breadcrumb")

<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->
<section>
    <div class="container">
    @php
            $pageurl = clean_single_input(request()->segment(2));
        @endphp
        <?php
            $pos=[1,4];
            $langid=session()->get('locale')??1;
            $id1=!empty($m_flag_id)?$m_flag_id:$id;
            $res= get_menu($langid,$pos,$id1) ; $i=1;  if(!empty($res)){
         ?>
            <div class="col-md-3 col-xs-12">
                <?php } else{ ?>
                    <div class="col-md-12 col-xs-12">
                 <?php }?>
                <div class="left_menu">
                     <nav class="navbar navbar-inverse sidebar" role="navigation">
                        <div class="navbar-collapse">
                            <ul class="nav navbar-nav">
                            
                         
                          @foreach($res as $mod)
                        <li class="<?php if($mod->m_url== $pageurl) echo "active" ?> has-sub  a" style="margin-left: -7px;">
                            @if($mod->m_type==2)
                                <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
                            @elseif($mod->m_type==3)
                            <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
                        
                            @else
                            <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > <span>{{$mod->m_name}} </span></a>
                           
                            @endif
                            <?php  
                                    if(has_child($mod->id, $mod->language_id) > 0){
                                        ?>
                                            <ul>
                                               
                                                <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ; 
                                                
                                                ?>
                                               
                                                    @foreach($ress as $mods)
                                                        <li class="<?php if($mods->m_url== $pageurl) echo "active" ?> has-sub b">
                                                            @if($mods->m_type==2)
                                                                <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}" > <span>{{$mods->m_name}} </span></a>
                                                            @elseif($mods->m_type==3)
                                                                <a target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}" > <span>{{$mods->m_name}} </span></a>
                                                            
                                                            @else
                                                            <a href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}" > <span>{{$mods->m_name}} </span></a>
                                                        
                                                            @endif  
                                                        </li>
                                                    @endforeach
                                            </ul>
                                   <?php } ?>
                        </li>
                        <?php $i++ ; ?>
                        @endforeach
                            </ul>
                        </div>
                    </nav>
                </div>
               <?php if(!empty($res)){ ?>
            </div>
            <div class="col-sm-9">
                <?php } else {?>
                <?php }  ?>
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
        <table class="table" style="border-collapse: collapse; border-spacing: 0px; padding: 0px; border: 1px;" title="Orders / Circulars">
            <thead>
                <tr>
                    <th style="width: 8%; text-align: left;">{{ __('messages.sl') }}</th>
                    <th style="width: 35%; text-align: left;">{{ __('messages.title') }}</th>
                    <th style="width: 25%; text-align: left;">{{ __('messages.published') }}</th>
                    <th style="width: 10%; text-align: left;">{{ __('messages.archivedate') }}</th>
                </tr>
            </thead>
            <tbody id="list">
                <?php
                        $count = 1;
                        
                        foreach($tenders as $row):
                    ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td> 
                        @if(!empty($row->txtuplode))
                            <a target="_blank" href="{{ URL::asset('public/upload/admin/cmsfiles/tenders/')}}/{{$row->txtuplode}}" > 
                        @elseif(!empty($row->txtweblink))
                        <a target="_blank" href="{{$row->txtweblink}}" > 
                            
                        @else
                            <a target="_blank" href="{{ url('/tenderivew') }}/{{$row->url}}" > 
                      
                        @endif
                        <?php echo $row->tender_title; ?></a></td>
                    <td><?php echo $row->start_date; ?></td>
                    <td><?php echo $row->end_date; ?></td>
                </tr>
                <?php
                        endforeach;
                    ?>
            </tbody>
        </table>
        {!! $tenders->withQueryString()->links('pagination::bootstrap-5') !!} @php $pageurl = substr(clean_single_input(request()->segment(2)),0,4); @endphp

        <span class="page-updated-date">Last updatded on: {{ get_last_updated_date($pageurl) }} </span>
    </div>
    </div>
</section>

@endsection
