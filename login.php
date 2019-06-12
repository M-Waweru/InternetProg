 <!DOCTYPE html>
<?php 

	include_once 'DBConnector.php';
	include_once 'user.php';

	$con = new DBConnector;

	if (isset($_POST['btn-login'])){
		print("arg");

		$username = $_POST['username'];
		$password = $_POST['password'];

		// $instance = User::create();
		$instance = new User('','','',$username,$password);
		// $instance->setPassword($password);
		// $instance->setUsername($username);

		if ($instance->isPasswordCorrect()){
			$instance->login();

			$con->closeDatabase();

			$instance->createUserSession();
		} else {
			$con->closeDatabase();
			header("Location:login.php");
		}
	}
 ?>
 <html>
 <head>
 	<title>Log In</title>
 	<script type="text/javascript" src="js/validate.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/validate.css">
 	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
 </head>
 <body>
 	<div class="loginform">
 		 <form class="ui form" method="post" name="login" id="login" action="<?=$_SERVER['PHP_SELF']?>">
 		 	<table align="center">
 		 		 <tr class="field">
	 				<td><input type="text" name="username" placeholder="Username" required></td>
		 		</tr>
		 		<tr class="field">
		 			<td><input type="password" name="password" placeholder="Password" required></td>
		 		</tr>
		 		<tr class="field">
		 			<td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
		 		</tr>
		 		<tr class="field">
					<td><a href="lab1.php">Register</a></td>
				</tr>
 		 	</table>
 		</form>
 	</div>
 </body>
 <script type="text/javascript" src="semantic/dist/semantic.min.js"></script>
 </html>