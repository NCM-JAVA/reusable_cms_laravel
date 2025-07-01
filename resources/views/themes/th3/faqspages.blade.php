@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")
     
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
             
<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->
<div class="row inner_page">
<div class="flex-shrink-0 col-md-2 col-xs-12 pb-3">
  @include("../themes.th3.includes.sidebar")
   
</div>

  <div class="col-lg-9 col-md-9">
    <div class="content-div px-3">
        <h3 class="">{{$title}}</h3>
        
        <div class="accordion" id="accordionExample">
       @php    $i=1 ; @endphp
          @if(!empty($datas))
            @foreach($datas as $data)
            <div class="accordion-item">
              <h2 class="accordion-header" id="heading{{$data['id']}}One">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$data['id']}}One" aria-expanded="true" aria-controls="collapseOne">
                {{$data['title']}}
                </button>
              </h2>
              <div id="collapse{{$data['id']}}One" class="accordion-collapse collapse @if($i==1) show @endif" aria-labelledby="heading{{$data['id']}}One" data-bs-parent="#accordionExample">
                <div class="accordion-body">
               <?php echo $data['description']; ?>
                  </div>
              </div>
            </div>
            @php    $i++ ; @endphp
            @endforeach
          @else

          @endif
          </div>
    </div>


    <span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
  </div>
</div>

@endsection
