$(document).ready(function(){
	$('#btn-place-order').click(function(event){
		event.preventDefault();

		var name_of_food = $('#name_of_food').val();
		var number_of_units = $('#number_of_units').val();
		var unit_price = $('#unit_price').val();
		var order_status = $('#status').val();

		$.ajax({
			url: "http://localhost/IntProg/api/v1/orders/index.php",
			type: "post",
			data: {name_of_food:name_of_food,number_of_units:number_of_units,unit_price:unit_price,order_status:order_status},
			headers: {
				'Authorization':'Basic wjfaPN2YzLXoeks1OqJinu8S5gcXyQasIicTdi9XcziS838ZtVPXCS1W311QL8PI'
			},
			success: function(data){
				alert(data['message']);
			},
			error: function(){
				alert("An error occured");
			} 
		});
	});
});