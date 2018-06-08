<?php 


class User {


	private $db = null,
	$session_name,
	$logged_in = false,
	$data = array();


	public function __construct($user = null) {


		$this->db = db::get_instance();
		$this->session_name = config::get('session/session_name');

		if(!$user) {

			if(session::exist($this->session_name)) {


				$user = session::get($this->session_name);

				if($this->find($user)) {

					$this->logged_in = true;
				}
			}
		}

	}


	public function find($user = null) {

		$field = (is_numeric($user)) ? 'id': 'email';

		$user = $this->db->get('login', array($field, '=', $user));

		if($user->count()) {

			$this->data = $user->first();

			return true;
		}

		return false;


	}


	public function packages() {


			$packages = $this->db->get('packages');

			if($packages->count()) {

				return $packages->result();
			}

			return false;
	}


	public function update_package($user_id, $package_id) {

		//need package details
		//expiry

		

		$expiry = new DateTime("+30 days");

		$expiry_date = $expiry->format("Y-m-d H:i:s");
	

		$fields = array(

			'package_id' => $package_id,
			'patient_visit' => 0,
			'expiry' => $expiry_date

		);



		$update = $this->db->update('patients', $fields, array('patient_id', '=', $user_id));


		if($update) {

			session::flash("update", "You have successfully updated your acciount");

			return true;
		}



		return false;

		

	}


	public function find_package($package_id) {


		$package = $this->db->get('packages', array('id', '=', $package_id));

		if($package->count()) {

			return $package->first();

		}

		return false;
	}

	public function login ($email, $password) {



		$user = $this->find($email);

		if($user) {

			
			if($this->data()->password == hash::make($password, $this->data()->salt)) {

				session::put($this->session_name, $this->data()->email);

				return true;

			}
		}

		return false;
	}




	public function specialties($specialty_id = false) {


		if($specialty_id) {

				$specialty = $this->db->get('specialties', array('id', '=', $specialty_id));


				if($specialty->count()) {



					return $specialty->first()->specialty_name;
				}



				return "";

		} else {


			$specialties = $this->db->get('specialties');

			if($specialties->count()) {

				return $specialties->result();
			}


		}

		return false;
	}





	public function update_admin($fields) {


		if($this->exist()) {


			$current_password = $fields['current_password'];

			$new_password = $fields['new_password'];
			$email = $fields['email'];

			if($this->data()->password == hash::make($current_password, $this->data()->salt)) {

							//update the passsword

				$salt = hash::salt(32);
				$password = hash::make($new_password, $salt);

				$fields  = array(

					'email' => $email,
					'password' => $password,
					'salt' => $salt,
					'role' => 'admin'
				);

							//update the login table;

				$update = $this->db->update('login', $fields, $this->data()->id);

				if($update) {

					session::put("update", "You have successfully updated your account");
					return true;
				}



			}
		}


		return false;

	}


		//general getters

	public function all_patients() {

		$sql = "select * from patients

		inner join users
		on patients.patient_id = users.id

		left join packages on

		patients.package_id = packages.id
		";

		$users = $this->db->query($sql);

		if($users->count()) {


			return $users->result();
		}

		return false;

	}


	public function all_doctors() {


		$sql = "select * from doctors

		inner join users
		on doctors.doctor_id = users.id

		left join specialties
		on doctors.specialty_id = specialties.id
		";

		$query = $this->db->query($sql);

		if($query->count()) {

			return $query->result();
		}

		return false;


	}



	public function get_doctor($specialty_id = false)  {


		$sql = "select *, users.id as doctor_id from doctors


		inner join users
		on doctors.doctor_id = users.id

		left join specialties
		on doctors.specialty_id  = specialties.id

		where doctors.specialty_id = ?";


		$fields = array(

			'specialty_id' => $specialty_id

		);


		$query = $this->db->query($sql, $fields);

		if($query->count()) {

			return $query->result();
		}


		return false;


	}






	public function exist() {


		return (!empty($this->data)) ? true : false;
	}

	public function data() {

		return $this->data;
	}


	public function logged_in() {

		return $this->logged_in;
	}


	public function logout() {

		session::delete($this->session_name);

	}

	public function delete($user_id) {



			$user = $this->db->get('users', array('id', '=', $user_id));


			if($user->count()) {

				$email = $user->first()->email;

				$login_delete  = $this->db->delete('login', array('email', '=', $email));

				if($login_delete) {


					$user_delete = $this->db->delete('users', array('id', '=', $user_id));


					if($user_delete) {

						return true;
					}
				}
			

				return false;
			}

	}


}