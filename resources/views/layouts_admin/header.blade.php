   <!--header start here-->
				<div class="header-main">
					<div class="header-left">
							
							<div class="clearfix"> </div>
						 </div>
						 <div class="header-right">
							
							<div class="profile_details" style="width: 40%;">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
												<div class="user-name">
													<p>{{ Auth::user()->name }}</p>
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="{{route('home')}}"><i class="fa fa-globe"></i> Web</a> </li> 
											<li>
												<form method="POST" action="{{ route('logout') }}">
													@csrf
													<button class="">
														Cerrar sesión
													</button>
												</form>
											<!-- <a href="#"><i class="fa fa-sign-out"></i> Cerrar sesín</a>  -->
											</li>
										
										
										</ul>
									</li>
								</ul>
							</div>
							<div class="clearfix"> </div>				
						</div>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>