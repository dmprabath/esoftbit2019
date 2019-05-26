<?php 
require_once("dbconnection.php");

if(isset($_GET["type"])){ 
	$type = $_GET["type"]; 
	$type();
}
	/*This function returns all the employee who do not have a system login*/
function getNoLoginUsers(){
	$dbobj = DB::connect();
	$sql = "SELECT emp_id,emp_name FROM tbl_employee WHERE emp_email NOT IN (SELECT usr_name FROM tbl_users) AND emp_status=1;";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$nor = $result->num_rows;
	if($nor>0){
		while ($rec=$result->fetch_assoc()) {
			echo ("<option value='".$rec["emp_id"]."'>".$rec[emp_name]."</option>");
		}
	}
	$dbobj->close();
}
function getEmail(){
	$eid = $_POST["empid"];
	$dbobj = DB::connect();
	$sql = "SELECT emp_email FROM tbl_employee WHERE emp_id='$eid';";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$rec= $result->fetch_array();
	echo ($rec[0]);
	$dbobj->close();
}

function addNewUser(){
	$eid = $_POST["txteid"];
	$uname = $_POST["txtuname"];
	$utype = $_POST["cmbtype"];
	$pwd = md5($eid);
	$status = 1;
	$reset = 1;

	$dbobj = DB::connect();

	$sql = "INSERT INTO tbl_users(usr_name,usr_pass,usr_type,usr_status,pwd_reset) VALUES(?,?,?,?,?);";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("ssiii",$uname,$pwd,$utype,$status,$reset);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Account has been Successfully Created!");
	}
	$stmt->close();
	$dbobj->close();
}


//view employee in table
function viewusers(){
	//echo("viewuser");
	// DB table to use
	$table = <<<EOT
	( SELECT 
		EMP.emp_id,
		USR.usr_name,
		CASE WHEN USR.usr_type=1 THEN "Admin"
		WHEN USR.usr_type=2 THEN "Manager"
		WHEN USR.usr_type=3 THEN "Sales Assistance"
		END AS "type",
		USR.usr_status 
		FROM tbl_employee EMP JOIN tbl_users USR ON 
			EMP.emp_email=USR.usr_name WHERE
			EMP.emp_status=1 ORDER BY emp_id ASC
	)  temp
	EOT;
 
	// Table's primary key
	$primaryKey = 'emp_id';

	$columns = array(
	    array( 'db' => 'emp_id', 'dt' => 0 ),
	    array( 'db' => 'usr_name',  'dt' => 1 ),
	    array( 'db' => 'type',  'dt' => 2 )
	    	
	);

	// SQL server connection information
	require_once("config.php");
	$host = Config::$host;
	$user = Config::$db_uname;
	$pass = Config::$db_pass;
	$db = Config::$dbname;

	$sql_details = array(
    	'user' => $user,
    	'pass' => $pass,
    	'db'   => $db,
    	'host' => $host
	);

	require('ssp.class.php');
 
	echo json_encode(
    SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
	);
}

function getUser(){
	$empid = $_POST["empid"];
	$dbobj =DB::connect();
	$sql = "SELECT * FROM tbl_employee INNER JOIN tbl_users ON tbl_employee.emp_email =tbl_users.usr_name where tbl_employee.emp_id = '$empid';";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}
	$rec = $result->fetch_assoc();
	echo(json_encode($rec));
	$dbobj->close();
}

function updateUsers(){
	$empid = $_POST["txteid"];
	$usrtype= $_POST["cmbtype"];
	$username = $_POST["txtuname"];
	$usrstatus =$_POST["optstatus"];
	

	$dbobj = DB::connect();

	$sql = "UPDATE tbl_users SET  usr_type=?,
		 usr_status=? WHERE usr_name=? ";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("iis",$usrtype,$usrstatus,$username);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Updated!");
	}
	$stmt->close();
	$dbobj->close();

}
function resetPassword(){
	$empid = $_POST["eid"];
	$uname = $_POST["uname"];

	$dbobj = DB::connect();

	$pwd =md5($empid);
	$reset =1;

	$sql = "UPDATE tbl_users SET usr_pass=?,
									 pwd_reset=? WHERE usr_name=? ";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("sis",$pwd,$reset,$uname);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Updated!");
	}
	$stmt->close();
	$dbobj->close();
}

?>
