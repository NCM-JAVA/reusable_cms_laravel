<!--************************breadcrumb********************-->
<section>
    <div class="container mt20">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb10">
                <li><a title="{{ __('messages.home') }}" href="{{ url('/')}}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item">
                    <a title="" href="{{ url('/pages') }}/{{!empty($m_url)?$m_url:''}}"> {{$title}} </a>
                </li>
                <li class="breadcrumb-item active">
                {{!empty($chtitle)?$chtitle:''}}
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