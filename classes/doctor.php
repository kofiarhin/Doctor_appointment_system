<?php 


class Doctor {


	private $db = null,
	$session_name = null,
		$data = array(),
		$profile_pic = "default.jpg";

	public function __construct($user = null) {


		$this->db = db::get_instance();
		$this->session_name = config::get('session/session_name');

		if(!$user) {



			if(session::exist($this->session_name)) {

				$user = session::get($this->session_name);

				$this->find($user);
			}
		} else {

			$this->find($user);
		}


		if($this->profile_check()) {

				$this->profile_pic = $this->get_profile_pic();

		}
	}



	public function profile_picture() {

		return $this->profile_pic;
	}


	public function create_account($fields) {



		$login_fields = array(

			'email' => $fields['email'],
			'password' => $fields['password'],
			'salt' => $fields['salt'],
			'role' => 'doctor'

		);


		$login_insert = $this->db->insert('login', $login_fields);

		if($login_insert) {


			$user_fields = array(

				'first_name' => $fields['first_name'],
				'last_name' => $fields['last_name'],
				'email' => $fields['email'],
				'contact' => $fields['contact'],
				'address' => $fields['address'],
				'dob' => $fields['dob'],
				'gender' => $fields['gender'],
				'joined' => date("Y-m-d H:i:s"),
				'profile_status' => 0


			);


			$user_insert = $this->db->insert('users', $user_fields);


			if($user_insert) {


					//fetch user id

				$user_id = $this->db->get('users', array('email', '=', $fields['email']));

				if($user_id->count()) {

					$id = $user_id->first()->id;

						//insert fields into doctor

					$doctor_fields = array(

						'doctor_id' => $id,
						'specialty_id' => $fields['specialty'] 

					);


					$doctor_insert = $this->db->insert('doctors', $doctor_fields);

					if($doctor_insert) {

						session::put("account_created", "The account ".$fields['email']." was successfully created!");
						return true;
					}
				}
			}
		}


		return false;

	}


	public function find($user) {

		$field = (is_numeric($user)) ? "id" : "email";

		$sql = "select *, users.id as user_id from users 

		inner join doctors

		on users.id = doctors.doctor_id

		left join specialties

		on doctors.specialty_id = specialties.id


		where users.{$field} = ?";


		$fields = array(


			"{$field}" => $user
		);


		$user = $this->db->query($sql, $fields);

		if($user->count()) {


			$this->data = $user->first();

			return true;
		}



		return false;




	}


	public function profile_check($doctor_id = false) {

		if($doctor_id) {

			echo "display user id";
		}

		$status = $this->data()->profile_status;

		return ($status) ? true : false;

	}


	public function data() {


		return $this->data;
	}




	public function exist() {

		return (!empty($this->data)) ? true : false;
	}



	public function update_profile($file) {


		$file_name = file::upload($file);



		$check = $this->db->get('profile_images', array('user_id', '=', $this->data()->user_id));

		if($check->count()) {

			

			$id = $check->first()->id;

			$fields = array(

				'file_name' => $file_name
			);

			echo "someting";



			$update = $this->db->update('profile_images', $fields, array('id', '=', $id));

			if($update) {

				return true;
			}


		}else {



			$fields = array(


				'user_id' => $this->data()->user_id,
				'file_name' => $file_name
			);

			var_dump($fields);

			$insert = $this->db->insert('profile_images', $fields);

			if($insert) {

					//update the status users table

				$fields = array(

					'profile_status' => 1

				);

				$update = $this->db->update('users', $fields, array('id', '=', $this->data()->user_id));

				if($update) {


					return true;
				}



			}
		}


		return false;

	}



	public function get_profile_pic() {

		if($this->exist()){

			$file = $this->db->get('profile_images', array('user_id', '=', $this->data()->user_id));

			if($file->count()) {

				return $file_name = $file->first()->file_name;
			}
		}


		return "default.jpg";
	}


	public function update_info($fields) {


		if($this->exist()) {


			$update = $this->db->update('users', $fields, array('id', '=', $this->data()->user_id));

			if($update) {

				return true;
			}
		}

		return false;
	}






}