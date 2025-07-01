<!--************************breadcrumb********************-->
@php
    $pageurl = clean_single_input(request()->segment(2));
    $langid1 = session()->get('locale');
    $nameurl=get_parent_menu_name($pageurl,$langid1);
  // dd($nameurl->m_url);
@endphp
<section>
    <div class="container mt20">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb10">
                <li><a title="{{ __('messages.home') }}" href="{{ url('/')}}">{{ __('messages.home') }}</a></li>
                @if(!empty($nameurl))
                <li class="breadcrumb-item">
                    <a title="" href="{{ url('/pages') }}/{{!empty($nameurl->m_url)?$nameurl->m_url:''}}"> {{!empty($nameurl->m_name)?$nameurl->m_name:''}} </a>
                </li>
                @endif
                <li class="breadcrumb-item active">
                {{$title}}
                </li>
                <li class="pull-right before_disable">
                    <a href="javscript:void(0)" class="btn btn-primary btn-xs" onclick="window.history.go(-1); return false;">{{ __('messages.back') }}</a> | <a href="javscript:void(0)" class="btn btn-primary btn-xs" onclick="myFunction()">{{ __('messages.print') }}</a> |
                    <a href="javscript:void(0)" class="btn btn-primary btn-xs" onclick="generatePDF('history')">{{ __('messages.pdf') }}</a>
                </li>
            </ol>
        </nav>
    </div>
</section>
<!--************************breadcrumb********************-->