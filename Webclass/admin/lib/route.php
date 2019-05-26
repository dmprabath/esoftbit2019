<?php
session_start();
if(!isset($_SESSION["user"])){
	header("Location:../index.php");  //create session for block unauthirized person
}

$utype = $_SESSION["user"]["type"];
switch($utype){
	case "1"; 
		header("Location:../home.php");
		break;
	case "2";
		header("Location:../../manager/home.php");
		break;

}

?>