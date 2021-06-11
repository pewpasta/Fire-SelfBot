<?php
$message="fire";
if(count($_GET)>0) {
	$conn = mysqli_connect("dbhost","dbname","dbpassword","dbname");
	$safe_user = $conn->real_escape_string($_GET["user"]);
	$safe_pass = $conn->real_escape_string($_GET["pass"]);
	$safe_hwid = $conn->real_escape_string($_GET["hwid"]);
	$result = mysqli_query($conn,"SELECT * FROM accs WHERE Username='" . $safe_user . "' and pass = '". $safe_pass."'");
	$row = $result->fetch_array();
	if($row[2] == "nohwid"){
		$result2 = mysqli_query($conn,"UPDATE accs SET hwid='". $safe_hwid."' WHERE Username='" . $safe_user . "'");
	}
	$result3 = mysqli_query($conn,"SELECT * FROM accs WHERE Username='" . $safe_user . "' and pass = '". $safe_pass."' and hwid = '". $safe_hwid."'");
	$count  = mysqli_num_rows($result3);
	if($count==0) {
		if ($row[2] != $safe_hwid){
			if ($row[2] != null){
				$message = "Invalid HWID!";
           		echo "Wrong HWID";
				die();
			}
			
	}
		echo "Wrong password";
	} else {
		$message = "You are successfully authenticated!";
        echo "All Right";	
	}

}else {
	header("Location: https://xefox.de/");
	die();
}	
?>
