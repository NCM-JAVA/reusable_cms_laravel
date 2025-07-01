<!DOCTYPE html>
<html lang="en">
   @php
         $langid=session()->get('locale')??1;
   @endphp
   @php
   $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'';
   @endphp
   <head>
   @include("../themes.{$themes}.includes.head")

  </head>
  
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
           
            
      <!-- include("../themes.{$themes}.includes.header") -->
          
    
               @yield('content')
               
               

            
              </div>
            </div>
            <!-- include("../themes.{$themes}.includes.footer") -->
      </body>
</html>