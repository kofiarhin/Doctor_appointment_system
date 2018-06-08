<?php 


	class File {


			public static function upload($file) {


					$file_name = $file['name'];

					if(!$file_name) {

						return false;
					}


					$file_tmp_name = $file['tmp_name'];
					$file_error = $file['error'];
					$file_size = $file['size'];

					$file_extention = explode('.', $file_name);

					$file_extention = strtolower(end($file_extention));

					$file_new_name = md5(uniqid()).".".$file_extention;

					$file_destination = "img/".$file_new_name;

					if(move_uploaded_file($file_tmp_name, $file_destination)) {

						return $file_new_name;
					}

						return false;

			}



			public static function delete($path) {


				if(file_exists($path)) {

					echo "file exist";
				}
			}

	}