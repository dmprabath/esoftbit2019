<?php
session_start();
	require_once("dbconnection.php");
	if(!isset($_POST["txtuname"])){
		header("Location:../index.php");
	}

$uname = $_POST["txtuname"];
$pass  = $_POST["txtpass"];

//database Object
$dbobj = DB::connect();

// SQL Statement
$sql = "SELECT * FROM tbl_users WHERE usr_name='$uname';";

//Query
$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : " .$dbobj->error);
		exit;
	} 

// Number of rows
$nor = $result->num_rows;

if($nor>0){
	$row= $result->fetch_assoc();
	$pass = md5($pass);   // to convert md5 to password
	if($pass==$row["usr_pass"]){
		if($row["usr_status"]=="1"){ 
			$_SESSION["user"]["uname"]=$uname;
			$_SESSION["user"]["type"]=$row["usr_type"];
			sleep(1);
			echo ("3");

		}else
			echo("2");
	}else
		echo("1");
}else{
	echo("1");
}


//database close
$dbobj->close();
?>