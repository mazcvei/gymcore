<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts_admin.head')

<body>
 
  <div class="page-container">
    <div class="left-content">
      <div class="mother-grid-inner">
         @include('layouts_admin.header')
          @yield('content')
          <!--copy rights start here-->
          <div class="copyrights">
            <p>© {{date('Y')}} GymCore. Todos los derechos reservados.</p>
          </div>
      </div>
    </div>
    <!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> 
          <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i><span>Inicio</span></a></li>
		       
		      
		        
		        <li><a href="{{route('admin.classes.index')}}"><i class="fa fa-bar-chart"></i><span>Clases</span></a></li>
		        <li><a href="{{route('admin.trainers.index')}}"><i class="fa fa-user"></i><span>Entrenadores</span></a></li>

		        
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
  </div>
  <script>
	var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>


<script src="{{ asset('scripts/admin/scripts.js') }}"></script>

<script src="{{ asset('scripts/admin/bootstrap.js') }}"> </script>
</body>


</html>