<?php 

include_once 'DBConnector.php';
$api_key = generateApiKey(64);
header('Content-type: application/json');
echo generateResponse($api_key);

function generateApiKey($str_length){
	$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

	$repl = unpack('C2', $bytes);

	$first = $chars[$repl[1]%62];
	$second = $chars[$repl[2]%62];
	return strtr(substr(base64_encode($bytes), 0, $str_length), '+/', "$first$second");
}

function saveApiKey($api_key){
	session_start();
	$username = $_SESSION['username'];

	$con = new DBConnector();

	$getid = mysql_query("select * from user where username = $username;");

	while ($row=mysql_fetch_array($getid)){
		$userid = $row['id'];
	}

	$res = mysql_query("INSERT INTO api_keys (user_id, api_key) VALUES ($userid,'$api_key')") or die ("Error". mysql_error());
	return $res;
}

function generateResponse($api_key){
	if (saveApiKey($api_key)){
		$res = ['success' => 1, 'message' => $api_key];
	} else {
		$res = ['success' => 0, 'message' => 'Something went wrong. Please regenerate the API key'.$api_key];
	}
	return json_encode($res);
}

 ?>