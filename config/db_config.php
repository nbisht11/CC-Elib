<?php
// connect to database
$conn = mysqli_connect('localhost','nbisht','password','CC_Elib');

// check connection
if(!$conn){
	echo 'Connection error: '. mysqli_connect_error();
}
?>
