
</div>
  </section>
</div>
<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2023 <div class="bullet"></div> Design By <a href="https://www.netcreativemind.com/">Netcreativemind</a>
    </div>
    <div class="footer-right">

  </div>
</footer>
 

  <!-- General JS Scripts -->
  <script src="{{ URL::asset('/public/assets/modules/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/popper.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/tooltip.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/moment.min.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ URL::asset('/public/assets/modules/jquery.sparkline.min.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/chart.min.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  
  <!-- Template JS File -->
  <script src="{{ URL::asset('/public/assets/js/scripts.js')}}"></script>
  <script src="{{ URL::asset('/public/assets/js/custom.js')}}"></script>

  <!-- CK Editor -->
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}",
        filebrowserImageUploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}",
        versionCheck: false
      });
  </script>  
 
<script type="text/javascript">
window.history.forward();
function noBack()
{ window.history.forward(); } //The forward method loads the next URL in the History list.
</script>
<body id="fontSize" onload="noBack();" onpageshow="if (event.persisted) noBack();">
</html>