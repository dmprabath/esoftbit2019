<?php
session_start();
if(!isset($_SESSION["user"])){
	header("Location:../index.php");  // create session for block unauthirized person
}
unset($_SESSION["user"]);
session_destroy();
header("Location:../index.php");
?>