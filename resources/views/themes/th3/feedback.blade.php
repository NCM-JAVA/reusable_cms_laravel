@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")

<style>
div#ExampleCaptcha_CaptchaDiv {
    display: flex !important;
}
.BDC_ReloadLink img {
    min-width: 20px
}
.BDC_CaptchaImageDiv a {
    display: none !important;
}
</style>

@php
    $pageurl = clean_single_input(request()->segment(2));
    $langid1 = session()->get('locale')??1;
@endphp 

<section class="main">
    <div class="container">
        <div class="wrapper">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-6 tab-100 order_c">
                    <div class="position-sticky top-0">
                        <img src="{{ asset('/public/themes/th3/assets/images/feed-left.png') }}" alt="side Img" class="w-100">
                    </div>
                </div>
                <div class="col-md-6 rating-reveal tab-100">
                   @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif 

@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>{{ __('messages.whoops') }}</strong> <!-- Translated "Whoops!" message -->
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    
                    
                    <div class="productRating">
                        <h2 class="ratingHead">{{get_title('fname',$langid1)->title}}</h2>
                        <form class="form" action="{{URL ::to('/feedback/process/')}}" method="post">
                            @csrf
                            <label for="name" class="form_lable">{{get_title('name',$langid1)->title}}<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-group" value="{{ old('name') }}" maxlength="36" onkeypress="return onlyAlphabets(event,this);" />
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif

                            <label for="email" class="form_lable">{{get_title('email',$langid1)->title}}<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control form-group" value="{{ old('email') }}" maxlength="64" />
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif

                            <label for="phone" class="form_lable">{{get_title('phone',$langid1)->title}}<span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control form-group" value="{{ old('phone') }}" maxlength="10" onkeypress="return onlyNumbers(event,this);" />
                            @if($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif

                            <label for="comments" class="form_lable">{{get_title('comment',$langid1)->title}}<span class="text-danger">*</span></label>
                            <textarea name="comments" class="form-control form-group" onkeypress="return onlyAlphabets(event,this);" rows="4" maxlength="240">{{ old('comments') }}</textarea>
                            @if($errors->has('comments'))
                                <span class="text-danger">{{ $errors->first('comments') }}</span>
                            @endif

                            <div class="row mb-3">
                                <label for="CaptchaCode" class="col-md-4 col-form-label">{{get_title('captcha',$langid1)->title}}</label>
                                <div class="col-md-6">
                                    {!! captcha_image_html('ExampleCaptcha') !!}
                                    <br/>
                                    <input type="text" class="form-control @error('CaptchaCode') is-invalid @enderror" id="CaptchaCode" name="CaptchaCode">
                                    @error('CaptchaCode')
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input type="hidden" value="{{ session()->get('salt') }}" name="salttaxt">
                                </div>
                            </div>
                            
                            <input class="login-button" type="submit" value="{{get_title('submit',$langid1)->title}}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <script>
        function onlyAlphabets(event, element) {
            var charCode = event.which || event.keyCode;
            var charStr = String.fromCharCode(charCode);

            var regex = /^[A-Za-z0-9\s]+$/;

            if (!regex.test(charStr)) {
                return false;
            }
            return true;
        }
    </script>
    <script>
        function onlyNumbers(event, element) {
            var charCode = event.which || event.keyCode;
            var charStr = String.fromCharCode(charCode);

            var regex = /^[0-9\s]+$/;

            if (!regex.test(charStr)) {
                return false;
            }
            return true;
        }
    </script>

@endsection