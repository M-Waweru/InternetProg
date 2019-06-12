<!DOCTYPE html>
<?php 
	include_once 'DBConnector.php';
	include_once 'user.php';
	include_once 'fileUploader.php';

	$con = new DBConnector;
	// print_r($con);

	if (isset($_POST['btn_save'])){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];

		$username = $_POST['username'];
		$password = $_POST['password'];

		$utc_timestamp = $_POST['utc_timestamp'];
		$offset = $_POST['time_zone_offset'];

		// echo $utc_timestamp;
		// echo $offset;
		// // print_r($con);

		$user = new User($first_name, $last_name, $city, $username, $password, $utc_timestamp, $offset);

		$uploader = new FileUploader;

		if (!$user->validateForm()) {
			$user->createFormErrorSessions("All fields are required");
			header("Refresh:0");
			die();
		}

		$res = $user->save();
		echo "Res: ".$res;
		echo "<br>";

		$file_upload_response = $uploader->uploadFile();

		if ($res && $file_upload_response) {
			echo "Save operation was successful";
		} else {
			$user->createFormErrorSessions("Username is already taken");			
			header("Refresh:0");
			die();
		}
	}
 ?>
<html>
<head>
	<title>Title goes here</title>
	<script type="text/javascript" src="js/validate.js"></script>
	<link rel="stylesheet" type="text/css" href="css/validate.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
</head>
<body>
	<div class="userform">
		<form class="ui form" name="user_details" id="user_details" onsubmit="return validateForm()" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
			<table align="center">
				<tr>
					<td>
						<div id="form-errors">
							<?php 
								session_start();
								if (!empty($_SESSION['form_errors'])) {
									echo " ".$_SESSION['form_errors'];
									unset($_SESSION['form_errors']);
								}
							 ?>
						</div>
					</td>
				</tr>
				<tr class="field">
					<td><input type="text" name="first_name" required placeholder="First Name"> </td>
				</tr>
				<tr class="field">
					<td><input type="text" name="last_name" placeholder="Last Name"></td>
				</tr>
				<tr class="field">
					<td><input type="text" name="city_name" placeholder="City"></td>
				</tr>
				<tr class="field">
					<td><input type="text" name="username" placeholder="Username"></td>
				</tr>
				<tr class="field">
					<td><input type="password" name="password" placeholder="Password"></td>
				</tr>
				<tr class="field">
					<td>Profile image:<input type="file" name="fileToUpload" id="fileToUpload"></td>
				</tr>
				<tr class="field">
					<td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
				</tr>
				<input type="hidden" name="utc_timestamp" id="utc_timestamp" value="">
				<input type="hidden" name="time_zone_offset" id="time_zone_offset" value="">
				<tr class="field">
					<td><a href="login.php">Login</a></td>
				</tr>
		</table>
		</form>
	</div>
	
<div class="container" id="userresults">
	<?php 

	if (isset($_POST['btn_save'])){
		echo "	<h2>User Details Table</h2>";
		$result = $user->readAll();
		echo "<table align='center' class='ui celled table'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>ID</th>";
		echo "<th>First Name</th>";
		echo "<th>Last Name</th>";
		echo "<th>City</th>";
		echo "<th>Username</th>";
		echo "<th>Password</th>";
		echo "<th>UTC</th>";
		echo "<th>Offset</th>";
		echo "</tr>";
		echo "</thead>";

		while($row = mysql_fetch_assoc($result)){
			echo "<tr>";
			echo "<td data-label='ID'>".$row['id']."</td>";
			echo "<td data-label='First Name'>".$row['first_name']."</td>";
			echo "<td data-label='Last Name'>".$row['last_name']."</td>";
			echo "<td data-label='City'>".$row['user_city']."</td>";
			echo "<td data-label='Username'>".$row['username']."</td>";
			echo "<td data-label='Password'>".$row['password']."</td>";
			echo "<td data-label='UTC'>".$row['utc']."</td>";
			echo "<td data-label='Offset'>".$row['offset']."</td>";
			echo "</tr>";
    		// echo "<br>";
		}

		echo "</table>";
	}
		$con->closeDatabase();
 	?>
</div>		
</body>
<script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="semantic/dist/semantic.min.js"></script>
<script type="text/javascript" src="js/timezone.js"></script>
</html>