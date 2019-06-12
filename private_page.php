 <!DOCTYPE html>
<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}

	function fetchUserApiKey(){
		
	}
 ?>
 <html>
 <head>
 	<title>Private Page</title>
 	<script type="text/javascript" src="js/validate.js"></script>
 	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
 	<script type="text/javascript" src="js/apikey.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/validate.css">
 	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
 </head>
 <body>
 	<p>This is a private page</p>
 	<p>We want to protect it Mr/Mrs. <?php echo $_SESSION['username']; ?></p>
 	<p><a href="logout.php">Logout</a></p>
 	<hr>
 	<h3>Here, we will create an API that will allow Users/Developers to order items from external systems</h3>
 	<hr>
 	<h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

 	<button class="" id="api-key-btn"> Generate API key</button><br><br>

 	<strong>Your API key:</strong>(Note that if your API key is already in use by already running applications, generating a new key will stop the application from functioning)
 	<br>

 	<textarea cols="100" rows="2" id="api-key" readonly><?php echo fetchUserApiKey();?></textarea>

 	<h3>Service description:</h3>
 	We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it.

 	<hr>
 </body>
<script type="text/javascript" src="semantic/dist/semantic.min.js"></script>
</html>