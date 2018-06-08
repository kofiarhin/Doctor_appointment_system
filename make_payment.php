<?php 


require_once "header.php";

?>

<div class="container">


	<?php 

	$user_id = input::get('user_id');

	$packages = $user->packages();


	if(input::exist()) {
		

			$update= $user->update_package(input::get('user_id'), input::get('package'));


			if($update) {

				redirect::to('route.php');
			} else {

				?>
		
					<p class="error">There was a problem making payment. Try again later</p>

				<?php 
			}


	}



	?>



	<form action="" method='post' class='awesome-form'>


		<label for="package">Select Package</label>


		<?php 

		if($packages) {

			?>

			<select name="package" id="">
				<?php 

						foreach($packages as $package) {

							?>
								<option value="<?php echo $package->id; ?>"><?php echo $package->package_name; ?></option>

							<?php
						}

				 ?>
			</select>
			<?php 
		}

		?>

		


		<label for="">Visa Card Number</label>
		<input type="number" name='card_number' placeholder="Eg: 4242-4242-4242">

		<input type="hidden" name='user_id' value='<?php echo  $user_id ?>'>

		<button type='submit' name='submit'>Make Payment</button>

		

	</form>

</div>

<?php 


require_once  "footer.php";

?>