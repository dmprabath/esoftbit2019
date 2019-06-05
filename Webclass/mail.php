<?php
$to = "newuser@localhost";
$sub = "Hello";
$msg = "Hello there";
$headers = "From:<postmaster@localhost>";

if(mail($to,$sub,$msg,$headers))
	echo("Sent");
else
	echo("Failed");

?>