<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts_admin1.head')

<body>
 
  <div id="wrapper">
         @include('layouts_admin1.navbar')
          @yield('content')
    
     
  </div>
  <div class="footer">
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  {{date('Y')}} dominio.com | Design by: <a href="#" style="color:#fff;" target="_blank">Mazcvei</a>
                </div>
            </div>
    </div>

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{ asset('scripts/admin1/jquery-1.10.2.js') }}"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('scripts/admin1/bootstrap.min.js') }}"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset('scripts/admin1/custom.js') }}"></script>
   
</body>


</html>