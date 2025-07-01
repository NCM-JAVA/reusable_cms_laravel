
@php
    $pageurl = clean_single_input(request()->segment(2));
    $langid1 = session()->get('locale');
    $nameurl=get_parent_menu_name($pageurl,$langid1);
  // dd($nameurl->m_url);
@endphp


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown"> {{$title}}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a  class="text-white" title="{{ __('messages.home') }}" href="{{ url('/')}}">{{ __('messages.home') }}</a></li>
                    @if(!empty($nameurl))
                        <li class="breadcrumb-item">
                            <a class="text-white"  title="" href="{{ url('/pages') }}/{{!empty($nameurl->m_url)?$nameurl->m_url:''}}"> {{!empty($nameurl->m_name)?$nameurl->m_name:''}} </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item text-primary active" aria-current="page"> {{$title}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->