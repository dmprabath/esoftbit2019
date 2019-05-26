<?php
require("../admin/header.php");
if(!isset($_SESSION["user"])){
	header("Location:../admin/index.php");  //create session for block unauthirized person
}else if($_SESSION["user"]["type"]!="2"){ // if manger
	header("Location:../admin/lib/route.php");
}
?>
<html>
	<div ">
	<h1>Manager Page</h1>
	Hello : <?php echo($_SESSION["user"]["uname"]) ?>
	<a href="../admin/lib/logout.php">Sign Out</a>
</div>
</html>
<?php
require("../admin/footer.php");
?>