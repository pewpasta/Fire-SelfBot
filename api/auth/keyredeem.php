<?php
$message="fire";
if(count($_GET)>0) {
    $conn = mysqli_connect("dbhost","dbname","dbpassword","dbname");
    $safe_key = $conn->real_escape_string($_GET["key"]);
    $safe_user = $conn->real_escape_string($_GET["user"]);
	$safe_pass = $conn->real_escape_string($_GET["pass"]);
    $result = mysqli_query($conn,"SELECT * FROM keylist WHERE keylist='" . $safe_key . "'");
    $row = $result->fetch_array();
    if($row[1] == "yes"){
        echo "already redeemed";
        die();
    }
    $count  = mysqli_num_rows($result);
    if($count==0) {
		echo "Invalid Key";
	} else {
        echo "kk";	
        $result2 = mysqli_query($conn, "INSERT INTO `accs`(`Username`, `pass`, `hwid`, `isAdmin`) VALUES ('" . $safe_user . "','" . $safe_pass . "','nohwid', 'false' )");
        $result3 = mysqli_query($conn,"UPDATE keylist SET benutzt='yes' WHERE keylist='" . $safe_key . "'");
	}
}else {
	header("Location: https://xefox.de/");
	die();
}	
?>