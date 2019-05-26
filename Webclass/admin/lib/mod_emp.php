<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}

/*
Following function generates a new employee id
eg. EMP00001
*/
function getNewEmpId(){
	$dbobj = DB::connect();
	$sql = "SELECT emp_id FROM tbl_employee ORDER BY emp_id DESC LIMIT 1;";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$nor = $result->num_rows;

	if($nor == 0){
		$newid = "EMP00001";
	}
	else{
		$rec = $result->fetch_assoc();
		$lastid = $rec["emp_id"];
		$num = substr($lastid, 3);
		$num++;
		$newid = "EMP".str_pad($num,5,"0",STR_PAD_LEFT);
	}

	$dbobj->close();
	return $newid;
}

/*
Below function is used to insert new employee records to 
the tbl_employee
*/
function addNewEmp(){
	$emp_id = $_POST["txteid"];
	$emp_title = $_POST["cmbtitle"];
	$emp_name = $_POST["txtname"];
	$emp_dob = $_POST["dtpdob"];
	$emp_gender = $_POST["optgen"];
	$emp_address = $_POST["txtaddress"];
	$emp_tel = $_POST["txttel"];
	$emp_email = $_POST["txtemail"];
	$emp_nic = $_POST["txtnic"];
	$emp_doj = $_POST["dtpdoj"];

	$dbobj = DB::connect();

	$sql = "INSERT INTO tbl_employee(emp_id,emp_title,emp_name,emp_dob,emp_gender,emp_address,emp_mobile,emp_email,	emp_nic,emp_doj) VALUES(?,?,?,?,?,?,?,?,?,?);";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("sississsss",$emp_id,$emp_title,$emp_name,$emp_dob,$emp_gender,$emp_address,$emp_tel,$emp_email,$emp_nic,$emp_doj);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Registered!");
	}
	$stmt->close();
	$dbobj->close();
}

function viewEmployee(){
	//echo("viewEmp");
	// DB table to use
	$table = 'tbl_employee';
 
	// Table's primary key
	$primaryKey = 'emp_id';

	$columns = array(
	    array( 'db' => 'emp_id', 'dt' => 0 ),
	    array( 'db' => 'emp_name',  'dt' => 1 ),
	    array( 'db' => 'emp_address',  'dt' => 2 ),
	    array( 'db' => 'emp_mobile',   'dt' => 3 ),
		array( 'db' => 'emp_email',    'dt' => 4)	
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
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"emp_status=1" )
	);
}
function getEmployee(){
	$empid = $_POST["empid"];
	$dbobj = DB::connect();
	$sql= "SELECT * FROM tbl_employee where emp_id='$empid';";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}
	$rec = $result->fetch_assoc();
	echo(json_encode($rec));
	$dbobj->close();

}

// update employee
function updateEmp(){
	$emp_id = $_POST["txteid"];
	$emp_title = $_POST["cmbtitle"];
	$emp_name = $_POST["txtname"];
	$emp_dob = $_POST["dtpdob"];
	$emp_gender = $_POST["optgen"];
	$emp_address = $_POST["txtaddress"];
	$emp_tel = $_POST["txttel"];
	$emp_email = $_POST["txtemail"];
	$emp_nic = $_POST["txtnic"];
	$emp_doj = $_POST["dtpdoj"];


	$dbobj = DB::connect();

	$sql = "UPDATE tbl_employee SET emp_title=?, emp_name=?, emp_dob=?, 
									emp_gender=?, emp_address=?, emp_mobile=?, 
									emp_email=?, emp_nic=?, emp_doj=? WHERE emp_id=?";

	/*$sql = "UPDATE tbl_employee SET emp_title='$emp_title', emp_name='$emp_name', emp_dob='$emp_dob', emp_gender='$emp_gender', emp_address='$emp_address', emp_mobile='$emp_tel', emp_email='$emp_email', emp_nic='$emp_nic',emp_doj='$emp_doj' WHERE emp_id='$emp_id'";*/

	/*$sql = "INSERT INTO tbl_employee(emp_id,emp_title,emp_name,emp_dob,emp_gender,emp_address,emp_mobile,emp_email,	emp_nic,emp_doj) VALUES(?,?,?,?,?,?,?,?,?,?);";*/

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("ississssss",$emp_title,$emp_name,$emp_dob,$emp_gender,$emp_address,$emp_tel,$emp_email,$emp_nic,$emp_doj,$emp_id);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Updated!");
	}
	$stmt->close();
	$dbobj->close();
}
function deleteEmp(){
	$empid = $_POST["empid"];
	
	$dbobj = DB::connect();
	$sql = "UPDATE tbl_employee SET emp_status=0  WHERE emp_id=?";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("s",$empid);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_employee WHERE emp_id=?)";
		$stmt_new= $dbobj->prepare($sql_new);
		$stmt_new->bind_param("s",$empid);
		$stmt_new->execute();
		$stmat_new->close();
		echo("1,Successfully Removed!");
	}
	$stmt->close();
	$dbobj->close();


}
?>