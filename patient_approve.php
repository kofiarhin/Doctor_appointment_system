<?php 

		require_once "header.php";


 ?>

		<?php 

				//get request id
				//update the request to approved
				//update appointment to approved

			if(!$user->logged_in()) {


				redirect::to('login.php');
			}



			$request_id = input::get('request_id');


			if(!$request_id) {

				redirect::to('route.php');

			}
			

			$request = new Request($request_id);

			$approve = $request->approve($request_id);

			if($approve) {

				redirect::to("route.php");
			} else {

				?>

					<p class="error">There was a problem approving appointment please try again</p>

				<?php 
			}

		 ?>



 <?php 


 	require_once "footer.php";

  ?>