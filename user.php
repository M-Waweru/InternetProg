<?php 
	include "crud.php";
	include "authenticator.php";
	class User implements Crud, Authenticator{
		private $user_id;
		private $first_name;
		private $last_name;
		private $city_name;

		private $username;
		private $password;
		private $utc;
		private $offset;

		function __construct($first_name, $last_name, $city_name,$username,$password, $utc, $offset)
		{
			// print_r($conn);
			// $this->con = $conn;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->city_name = $city_name;
			$this->username = $username;
			$this->password = $password;
			$this->utc = $utc;
			$this->offset = $offset;
		}

		// public static function create(){
		// 	$instance = new self();
		// 	return $instance;
		// }

		public function setUsername($username){
			$this->username = $username;
		}

		public function getUsername(){
			return $this->username;
		}

		public function setPassword($password){
			$this->password = $password;
		}

		public function getPassword(){
			return $this->password;
		}

		public function setUserId($user_id){
			$this->user_id - $user_id;
		}

		public function getUserId(){
			return $this->user_id;
		}

		public function save(){
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$uname = $this->username;
			$this->hashPassword();
			$pass = $this->password;
			$utc = $this->utc;
			$offset = $this->offset;

			$usercheck = $this->isUserExist($uname);

			if ($usercheck==true){
				return false;
			}

			$res = mysql_query("INSERT INTO user(first_name, last_name, user_city,username,password,utc,offset) VALUES('$fn','$ln','$city','$uname','$pass','$utc','$offset')") or die ("Error ".mysql_error());
			return true;
		}

		public function readAll(){
			$sql = "SELECT * FROM user";
			$result = mysqli_query($this->con,$sql);
			return $result;
		}

		public function readUnique(){
			return null;
		}

		public function search(){
			return null;
		}

		public function update(){
			return null;
		}

		public function removeOne(){
			return null;
		}

		public function removeAll(){
			return null;
		}

		public function validateForm(){
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;

			if ($fn == "" || $ln == "" || $city == ""){
				return false;
			}
			return true;
		}

		public function createFormErrorSessions($warning){
			session_start();
			$_SESSION['form_errors'] = $warning;
		}

		public function hashPassword(){
			$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		}

		public function isPasswordCorrect(){
			$con = new DBConnector;
			$found = false;
			$res = mysqli_query($this->con,"SELECT * FROM user") or die("Error".mysqli_error($this->con));

			while ($row=mysqli_fetch_array($res, MYSQLI_ASSOC)){
				if (password_verify($this->getPassword(), $row['password']) && $this->getUsername()==$row['username']){
					$this->user_id = $row['id'];
					$found = true;
				}
			}

			$con->closeDatabase();
			return $found;
		}

		public function login(){
			if ($this->isPasswordCorrect()){
				header("Location:private_page.php");
			}
		}

		public function createUserSession(){
			session_start();
			$_SESSION['username'] = $this->getUsername();
			$_SESSION['userid'] = $this->user_id;
		}

		public function logout(){
			session_start();
			unset($_SESSION['username']);
			session_destroy();
			header("Location:lab1.php");
		}

		public function isUserExist($username){
			// print_r($this->con);
			$sql = "SELECT * FROM user where username = ".$username.";";
			$result = mysql_query($sql);

			if (!$result){
				return false;
			}
			return true;
		}
	}

 ?>