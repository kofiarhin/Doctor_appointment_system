<?php 

require_once "header.php";


?>


<?php 
		

		$packages = $user->packages();

	

 ?>


<div class="container">


	<h1 class="display-5 page-header text-center">Pricing Packages</h1>


	<?php 

			if($packages) {


				var_dump($packages);


					foreach($packages as $package) {


							$package_name = $package->package_name;
							$package_visit = $package->package_visit;
							$package_price = $package->package_price;


						
					}


			}

	 ?>

	<div class="card-deck mb-3 text-center">
		<div class="card mb-4 box-shadow">
			<div class="card-header">
				<h4 class="my-0 font-weight-normal">Single User</h4>
			</div>
			<div class="card-body">
				<h1 class="card-title pricing-card-title">$100 <small class="text-muted">/ mo</small></h1>
				<ul class="list-unstyled mt-3 mb-4">
					<li>Number of Visits 4</li>
					<li>Other Package Detail</li>
					<li>Priority Support</li>
					<li>Help center access</li>
				</ul>
				<a  href="login.php"type="button" class="btn btn-lg btn-block btn-primary">Get Started</a>
			</div>
		</div>

		<div class="card mb-4 box-shadow">
			<div class="card-header">
				<h4 class="my-0 font-weight-normal">Single User</h4>
			</div>
			<div class="card-body">
				<h1 class="card-title pricing-card-title">$100 <small class="text-muted">/ mo</small></h1>
				<ul class="list-unstyled mt-3 mb-4">
					<li>Number of Visits 4</li>
					<li>Other Package Detail</li>
					<li>Priority Support</li>
					<li>Help center access</li>
				</ul>
				<a  href="login.php"type="button" class="btn btn-lg btn-block btn-primary">Get Started</a>
			</div>
		</div>
		<div class="card mb-4 box-shadow">
			<div class="card-header">
				<h4 class="my-0 font-weight-normal">Family</h4>
			</div>
			<div class="card-body">
				<h1 class="card-title pricing-card-title">$150 <small class="text-muted">/ mo</small></h1>
				<ul class="list-unstyled mt-3 mb-4">
					<li>Number of Visits 4</li>
					<li>Other Package Detail</li>
					<li>Priority Support</li>
					<li>Help center access</li>
				</ul>
				<a  href="login.php"type="button" class="btn btn-lg btn-block btn-primary">Get Started</a>
			</div>
		</div>
		<div class="card mb-4 box-shadow">
			<div class="card-header">
				<h4 class="my-0 font-weight-normal">Elderly</h4>
			</div>
			<div class="card-body">
				<h1 class="card-title pricing-card-title">$200<small class="text-muted">/ mo</small></h1>
				<ul class="list-unstyled mt-3 mb-4">
					<li>Number of Visits 4</li>
					<li>Other Package Detail</li>
					<li>Priority Support</li>
					<li>Help center access</li>
				</ul>
				<a  href="login.php"type="button" class="btn btn-lg btn-block btn-primary">Get Started</a>
			</div>
		</div>
	</div>

	<?php 


	require_once "footer.php";


	?>