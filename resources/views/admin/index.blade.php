@extends('layouts_admin.app')
@section('content')


<div class="inner-block">
	<!--market updates updates-->
	<div class="market-updates">
		<div class="col-md-4 market-update-gd">
			<div class="market-update-block clr-block-1">
				<div class="col-md-8 market-update-left">
					<h3>{{$countUsers}}</h3>
					<h4>Usuarios registrados</h4>
				</div>
				<div class="col-md-4 market-update-right">
					<i class="fa fa-users"> </i>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="col-md-4 market-update-gd">
			<div class="market-update-block clr-block-2">
				<div class="col-md-8 market-update-left">
					<h3>{{$countClasses}}</h3>
					<h4>Clases disponibles</h4>
				</div>
				<div class="col-md-4 market-update-right">
					<i class="fa fa-eye"> </i>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="col-md-4 market-update-gd">
			<div class="market-update-block clr-block-3">
				<div class="col-md-8 market-update-left">
					<h3>{{$countReservations}}</h3>
					<h4>Reservas realizadas</h4>
				</div>
				<div class="col-md-4 market-update-right">
					<i class="fa fa-envelope-o"> </i>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>

		<div class="col-md-4 market-update-gd">
			<div class="market-update-block clr-block-4" style="margin-right: 0.8em; margin-top:1rem">
				<div class="col-md-8 market-update-left" >
					<h3>{{$countActiveMemberships}}</h3>
					<h4>Membresías activas</h4>
				</div>
				<div class="col-md-4 market-update-right">
					<i class="fa fa-reservation"> </i>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>



</div>



@endsection