

      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- test  -->
      <!-- site metas -->
      <title> @yield('title')</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Option 1: Include in HTML -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <!-- General CSS Files -->
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/bootstrap/css/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/fontawesome/css/all.min.css')}}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <!-- CSS Libraries -->
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/summernote/summernote-bs4.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">

            <!-- Template CSS -->
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/style.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/custom.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/components.css')}}">

            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-94034622-3');
            </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
      //   alert("AJAX script loaded!123"); // Debugging - Remove later

        const timeoutMilliseconds = 30 * 60 * 1000; // 1 minute
        let logoutTimer;

        function logoutUser() {
            console.log("Logging out due to inactivity..."); // Debugging - Remove later
            $.ajax({
                url: "{{ route('logout') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                     "Content-Type": "application/json"
                },
                success: function (response) {
                    console.log("response" + response.message);
                    window.location.href = "{{ url('/login') }}"; // Redirect to login page
                },
                error: function (xhr) {
                  console.log("Logout failed: " + xhr.status + " - " + xhr.responseText);
                }
            });
        }

        function startLogoutTimer() {
            clearTimeout(logoutTimer);
            logoutTimer = setTimeout(logoutUser, timeoutMilliseconds);
        }

        // Start logout timer when user is inactive
        $(document).on("mousemove keypress scroll click touchstart", startLogoutTimer);

        // Initialize the timer
        startLogoutTimer();
    });
</script>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        console.log("AJAX script loaded!"); // Ensure the script is running
        
        const timeoutMilliseconds = 60 * 1000; // 1 minute
        let logoutTimer;
        let isWindowActive = true;

        // Function to log out the user via AJAX
        function logoutUser() {
            $.ajax({
                url: "{{ route('logout') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    console.log('response',response.message);
                    window.location.href = "/dca/login"; // Redirect after logout
                },
                error: function (xhr) {
                    console.error("Logout failed:", xhr.responseText);
                }
            });
        }

        // Function to start logout timer when the window is inactive
        function startLogoutTimer() {
            clearTimeout(logoutTimer);
            if (!isWindowActive) {
                logoutTimer = setTimeout(logoutUser, timeoutMilliseconds);
            }
        }

        // Detect when the window becomes inactive (user switches tab or minimizes)
        $(window).on("blur", function () {
            isWindowActive = false;
            startLogoutTimer();
        });

        // Detect when the window becomes active again
        $(window).on("focus", function () {
            isWindowActive = true;
            clearTimeout(logoutTimer); // Cancel logout if the user returns
        });
    });
</script> -->


  