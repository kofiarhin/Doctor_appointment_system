<?php 

	
	require_once "header.php";

 ?>

		



 		<?php 

 				$doctor  = new Doctor;

 				

 		 ?>



 		 <?php 

 		 		if(input::exist()) {

 		 			$fields = array(
 		 				
 		 				'first_name' => input::get('first_name'),
 		 				'last_name' => input::get('last_name'),
 		 				'contact' => input::get('contact'),
 		 				'address' => input::get('address')

 		 			);

 		 			$changes = $doctor->update_info($fields);

 		 			if($changes) {

 		 				redirect::to("doctor_profile.php");
 		 			} else {

 		 				?>

						<p class="error">There was a problem saving changes </p>

 		 				<?php 
 		 			}
 		 		}

 		  ?>

		<h1 class="title">Edit Info</h1>

		<form action="" method='post' class='awesome-form'>
				
				<input type="text" name='first_name' value = "<?php echo $doctor->data()->first_name; ?>">

				<input type="text" name='last_name' value="<?php echo $doctor->data()->last_name ?>">
				<input type="text" name='contact' value="0<?php echo $doctor->data()->contact ?>">
				<input type="text" name='address' value="<?php echo $doctor->data()->address ?>">

				<button type='submit' name='submit'>Save Changes</button>

		</form>

 <?php 


 		require_once "footer.php";

  ?>