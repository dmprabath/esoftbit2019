<?php
require("header.php");

?>

<div class="container">
	<div class="row">
		<div class="col-md"></div>
		<div class="login col-md">
			<h2 align="center">Login Page</h2>
			<hr>
			<form>  <!--  from Boostrap -->
				<div class="form-group">
					<div class="input-group">	
						<div class="input-group-prepend">
		          <div class="input-group-text"><i class="fas fa-user"></i></div>
		        </div>
					<input class="form-control" type="text" id="txtuname" name="txtuname" placeholder="username">

					</div>
				</div>
				<div class="form-group">
					<div class="input-group">	
						<div class="input-group-prepend">
		          <div class="input-group-text"><i class="fas fa-key"></i></div><!--From Fontawesome-->
		        </div>
					<input class="form-control" type="password" id="txtpass" name="txtpass" placeholder="password">

					</div>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary" id="btnlogin">Login </button>
					<span style="display: none;" id="loading"><img width="40%" src="..//images/loading-2.gif" /></span>
				</div> 
			</form><!--  form Boostrap  end-->
		</div>
		<div class="col-md"></div>
	</div><!--row close -->
  
</div>

<script type="text/javascript">
	function manage_ctrl(arg){ // function for disable button
		if(arg=="0"){
			$("#loading").css("display","inline"); // change css to display
			$("#btnlogin").attr("disabled",true);  // To disabled login button after enter

		}else if(arg=="1"){
			$("#loading").css("display","none");
			$("#btnlogin").attr("disabled",false);
		}
	}

	$(document).ready(function(){
		$("#txtpass").keypress(function(e){  // function of key press
			if(e.which==13){  // 13 = asque value of enter
				$("#btnlogin").click();  // call to click function 
			};
		});

		$("#btnlogin").click(function(){
			manage_ctrl("0");
			var uname,pass;
			uname=$("#txtuname").val();
			pass=$("#txtpass").val();
			if(uname=="" || pass==""){
				swal("Login Error!", "Both username and Password must be filled", "error");  //this is from sweet alert
				manage_ctrl("1");
			}
			else{
				var fdata = $("form").serialize();
				var url = "lib/loginhandle.php";

				$.ajax({
					method:"POST",
					url:url,
					data:fdata,
					dataType:"text",
					success:function(result){
						manage_ctrl("1");
						if(result=="1")
							swal("Login Error","Invalid username or Password", "error");
						else if(result=="2")
							swal("Locked Account","Your Account has been disabled, please contact administrartor", "warning");
						else if(result=="3")
							location.href="lib/route.php";
						else
							alert(result);
					},
					error:function(eobj,etxt,err){
						console.log(etxt);
					}
				});
			}

		});
		

	});

</script>


<?php
require("footer.php")

?>
