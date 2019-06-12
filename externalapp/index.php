<?php 

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Title goes here</title>
 	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
 </head>
 <body>
 	<h3>It is time to communicate with the exposed API, all we need is the API key to be passed in the header</h3>
 	<hr>
 	<h4>1. Feature 1 - Placing an order</h4>
 	<hr>
 	<form name="order-form" id="order-form">
 		<fieldset>
 			<legend>Place order</legend>
 			<input type="text" name="name_of_food" required placeholder="Name of food"><br>
 			<input type="number" name="number_of_units" required placeholder="Number of units"><br>
 			<input type="number" name="unit_price" required placeholder="Unit price"><br>
 			<input type="hidden" name="status" required value="Order placed">

 			<button type="submit" id="btn-place-order">Place order</button>
 		</fieldset>
 	</form>
 	<hr>

 	<h4>2. Feature 2 - Checking order status</h4>
 	<hr>
 	<form name="order_status_form" id="order_status_form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
 		<fieldset>
 			<legend>Check order status</legend>
 			<input type="number" name="order_id" id="order_id" required placeholder="Order ID">
 			<br><br>
 			<button type="submit" id="btn-check-order">Check order status</button>
 		</fieldset>
 	</form>
 </body>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="semantic/dist/semantic.min.js"></script>
<script type="text/javascript" src="placeorder.js"></script>
 </html>