<?php 


require_once "header.php";


?>


<div class="container">




	<?php 



		$file = input::get('file_name');

		$file_name = (!$file) ? "default.jpg" : $file;



	?>


	<h1 class="title">Medical File</h1>
	<div class="file-unit">
		<img src="img/<?php echo $file_name; ?>" alt="">
	</div>


</div>
<?php 


require_once "footer.php";


?>