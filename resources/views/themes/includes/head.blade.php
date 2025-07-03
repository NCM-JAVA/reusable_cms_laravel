<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $title ??''}}</title>
    <!-- <title>Home | Department of Consumer Affairs | Ministry of Consumer Affairs Food and Public Distribution | Government of India</title>  -->
    <meta name="keywords" content="consumer, affairs, jago, grahak, food, swachh">
    <meta name="description" content="Department of Consumer Affairs, Ministry of Consumer Affairs, Food and Public Distribution, Government of India">
    <meta name="title" content="Home | Department of Consumer Affairs | Ministry of Consumer Affairs Food and Public Distribution | Government of India">

    <link rel="stylesheet"
        href="{{ URL::asset('/public/themes/th3/assets/CSS/bootstrap-icons.min.css')}}"
        integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/bootstrap.min.css')}}" />

    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/animate.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/fontawesome.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/fontawesome-free-6.5.2-web/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/remixicon.css')}}" />
    <link
        href="{{ URL::asset('/public/themes/th3/assets/CSS/google_fonts.css')}}"
        rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/orange.css')}}" id="orange-css" disabled>
        <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/BW-css.css')}}" id="BW-css" disabled>
        <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/Comman.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/blue.css')}}" >
        <link href="{{ URL::asset('/public/themes/th3/assets/CSS/outrageous_orange.css')}}" rel="alternate stylesheet"
        media="screen" title="outrageous_orange">
        <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/CSS/style.css')}}" id="theme">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link href="{{ URL::asset('/public/themes/th3/assets/CSS/boxicons.min.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('/public/themes/th3/assets/CSS/owl.carousel.min.css')}}" rel="stylesheet">





    <!-- ----------------------font size script Start-------------------------- -->
    <script type="text/javascript">
    $(document).ready(function() {
        var maxFontSizeChange = 3; // Set the maximum font size change allowed

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
                currentFontSize += 3;
                if (currentFontSize > 22) { // Limit to a maximum of 24px
                    currentFontSize = 22;
                }
            } else if (flag == 'decrease') {
                currentFontSize -= 3;
                if (currentFontSize < 11) { // Limit to a minimum of 12px
                    currentFontSize = 11;
                }
            } else {
                currentFontSize = 16; // Reset to the default font size
            }

            divElement.css('font-size', currentFontSize + 'px');
        }
    });
    </script>



</head>