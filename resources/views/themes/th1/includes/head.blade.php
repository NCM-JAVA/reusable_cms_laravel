

       <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title> {{ $title ??'' }}</title>
      
      <meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="Keywords" content="Cemilac">
<meta name="Description" content="Cemilac">
<meta name="title" content="Cemilac">
<meta name="language" content="EN">
<link rel="icon" type="image/x-icon" href="{{ URL::asset('public/upload/admin/setting/')}}/{{!empty(get_setting()->favicon)?get_setting()->favicon:''}}">

<link href="{{ URL::asset('/public/themes/th1/css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('/public/themes/th1/css/print_index.css')}}" media="print" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('/public/themes/th1/css/style-hrms.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('/public/themes/th1/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('/public/themes/th1/css/responsive.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('/public/themes/th1/css/change.css')}}" rel="alternate stylesheet" media="screen" title="change">
<link href="{{ URL::asset('/public/themes/th1/css/outrageous_orange.css')}}" rel="alternate stylesheet" media="screen" title="outrageous_orange">
<link href="{{ URL::asset('/public/themes/th1/css/green.css')}}" rel="alternate stylesheet" media="screen" title="green">
<link href="{{ URL::asset('/public/themes/th1/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('/public/themes/th1/font/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<noscript>
<link href="{{ URL::asset('/public/themes/th1/css/js_Off.css')}}" rel="stylesheet" type="text/css">
</noscript>
<link href="{{ URL::asset('/public/themes/th1/css/custom_index.css')}}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css')}}" rel="stylesheet">



<!----- font size increase decrease ------>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {

            $('#fontincrease').click(function() {
                modifyFontSize('increase');
            });
            $('#fontdecrease').click(function() {
                modifyFontSize('decrease');
            });
            $('#fontreset').click(function() {
                modifyFontSize('reset');
            });

            function modifyFontSize(flag) {
                var divElement = $('body');
                var currentFontSize = parseInt(divElement.css('font-size'));

                if (flag == 'increase') {
                        currentFontSize +=2;
                    } else if (flag == 'decrease') {
                        currentFontSize -=2;
                    } else {
                        currentFontSize = 15;
                }
                divElement.css('font-size', currentFontSize);
            }
        });
    </script>

