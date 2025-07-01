@extends('layouts.themes') 
@section('content') 

  @include("../themes.th3.includes.breadcrumb") 
  @php 
    $pageurl = clean_single_input(request()->segment(2)); 
    $langid1 = session()->get('locale')??1; 
  @endphp

<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->


<div class=" inner_page mb-5 mt-2">
   


<!-- Name: Kesh Kumar
Date: 02-11-23
Reason: This modal is dymically change the image.  -->

    <div class="container"> 
     
        <form action="#" method="get" name="filterForm" accept-charset="utf-8" class="mb-3">
            @csrf
            <input type="hidden" name="_token" value="c0FFzRSJlCtN845ftmOAXwfpZIeNTD2MkRQoH2Zg" autocomplete="off">            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group">
                        <input type="text" name="keywords" value="" id="keywords" class="input_class form-control alphNumDasSpcDotCommaBcsc" placeholder="Title">
                    </div> 
                </div>
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <div class="form-group error-startdate">
                        <input type="date" name="startdate" id="startdate1" class="input_class form-control validDate1" value="" placeholder="From Date">
                    </div>
                </div>   
                <div class="col-lg-3 col-md-3 col-xm-12">
                    <button name="cmdsubmit_search_gallery" type="submit" class="btn btn-primary" id="cmdsubmit" value="Search"> Search </button>
                </div>
            </div>
        </form>
    
        <div class="content-div px-3"></div>
            <div class="d-flex gap-2">
                <div class="row gy-5 justify-content-evenly">

                  @foreach($importantLink as $val)
                    <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $val->title }}">
                      <a href="{{ $val->logo_url }}" target="_blank"><img src="{{ asset('public/upload/admin/cmsfiles/logo/thumbnail/') }}/{{$val->txtuplode}}" alt="{{ $val->title }}" srcset></a>
                        <div class="overlay"></div>
                        <a href="{{ $val->logo_url }}" target="_blank"><p> {{$val->title}} </p></a>
                    </div>
                  @endforeach

                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'NTH' : 'एन टी एच' }}">
                     <a href="https://www.nth.gov.in/" target="_blank"><img src="/dca/public/themes/th3/assets/images/nth-logo.png" alt srcset></a>
                            <div class="overlay"></div>
                           <a href="https://www.nth.gov.in/" target="_blank"><p>@if($langid1 == 1) NTH @else एन टी एच @endif</p></a>
                  </div> -->

                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'BIS' : 'बी आई एस' }}">
                  <a href="https://www.bis.gov.in/" target="_blank"><img src="/dca/public/themes/th3/assets/images/bsi.png" alt srcset></a>
                            <div class="overlay"></div>
                            <a href="https://www.bis.gov.in/" target="_blank"><p> @if($langid1 == 1) BIS @else बी आई एस @endif</p></a>
                  </div> -->

                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'E-Daakhil' : 'ई-दाखिल' }}">
                  <a href="https://edaakhil.nic.in/index.html" target="_blank"><img src="/dca/public/themes/th3/assets/images/e-daakhil.png" alt srcset></a>
                            <div class="overlay"></div>
                           <a href="https://edaakhil.nic.in/index.html" target="_blank"> <p>@if($langid1 == 1) E-Daakhil @else ई-दाखिल @endif</p></a>
                  </div> -->

                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'NCCF' : 'एन सी सी एफ' }}">
                  <a href="https://nccf-india.com/" target="_blank"><img src="/dca/public/themes/th3/assets/images/nccf.jfif" alt srcset></a>
                            <div class="overlay"></div>
                            <a href="https://nccf-india.com/" target="_blank"><p>@if($langid1 == 1) NCCF @else एन सी सी एफ @endif</p></a>
                  </div> -->
                  
                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'NCDRC' : 'एन सी डी आर सी' }}">
                    <a href="https://ncdrc.nic.in/" target="_blank"><img src="/dca/public/themes/th3/assets/images/ncdrc.png" alt
                      srcset></a>
                    <div class="overlay"></div>
                    <a href="https://ncdrc.nic.in/" target="_blank"><p>@if($langid1 == 1) NCDRC @else एन सी डी आर सी @endif</p></a>
                  </div> -->
                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'NCH' : ' एन सी एच' }}">
                   <a href="https://consumerhelpline.gov.in/public/" target="_blank"> <img src="/dca/public/themes/th3/assets/images/NCH.jfif" alt
                      srcset></a>
                    <div class="overlay"></div>
                   <a href="https://consumerhelpline.gov.in/public/" target="_blank"> <p> @if($langid1 == 1) NCH @else एन सी एच @endif </p></a>
                  </div> -->
                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'Anumati' : 'अनुमति' }}">
                    <a href="https://www.anumati.co.in/" target="_blank"><img src="/dca/public/themes/th3/assets/images/anumati.png" alt
                      srcset></a>
                    <div class="overlay"></div>
                    <a href="https://www.anumati.co.in/" target="_blank"><p> @if($langid1 == 1) Anumati @else अनुमति @endif </p></a>
                  </div> -->
                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'Consumer Welfare Fund' : 'उपभोक्ता कल्याण कोष' }}">
                    <a href="https://consumeraffairs.nic.in/organisation-and-units/division/consumer-welfare-fund" target="_blank"><img src="/dca/public/themes/th3/assets/images/CWF1.jpg" alt
                      srcset>
                    <div class="overlay"></div>
                    <a href="https://consumeraffairs.nic.in/organisation-and-units/division/consumer-welfare-fund" target="_blank">
                      <p>@if($langid1 == 1) Consumer <br>Welfare Fund @else उपभोक्ता <br> कल्याण कोष @endif </p>
                    </a>
                  </div> -->
                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'Jago Grahak Jago' : 'जागो ग्राहक जागो' }}">
                    <a href="https://jagograhakjago.gov.in/" target="_blank"><img src="/dca/public/themes/th3/assets/images/JGJ.png" alt
                      srcset></a>
                    <div class="overlay"></div>
                    <a href="https://jagograhakjago.gov.in/" target="_blank"><p>@if($langid1 == 1) Jago Grahak Jago @else जागो ग्राहक जागो @endif </p></a>
                  </div> -->

                  <!-- <div class="card view-all-page wallet p-3 col-md-3 shadow" title="{{ $langid1 == 1 ? 'Legal Metrology' : 'लीगल मेट्रोलॉजी' }}">
                    <a href="https://lm.doca.gov.in/" target="_blank"><img src="/dca/public/themes/th3/assets/images/legal_metrology.png" alt
                      srcset></a>
                    <div class="overlay"></div>
                    <a href="https://lm.doca.gov.in/" target="_blank"><p>@if($langid1 == 1) Legal Metrology @else लीगल मेट्रोलॉजी @endif </p></a>
                  </div> -->
                  
        </div>

    </div>
    <span class="page-updated-date px-3 text-align-right mt-3">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
    </div>
<div>



@endsection
