<?php
require("../lib/mod_user.php");
?>
<script >
   $("#cmbename").change(function(){
    var eid= $(this).val();
   	$("#txteid").val(eid);

    var url = "lib/mod_user.php?type=getEmail";

      $.ajax({
 
      method:"POST",
      url:url,
      data:{empid:eid},
      dataType:"text",
      success:function(result){
        $("#txtuname").val(result);
      },
      error:function(eobj,etxt,err){
        console.log(etxt);
      }
      });
   });

   $("#btnsave").click(function(){
    var ename=$("#cmbename").val();
    var eid =$("#txteid").val();
    var etype=$("#cmbtype").val();

    if(ename==""){
      swal("Incomplete input","Please enter User name","error");
      return;
    }else if(etype==""){
      swal("Incomplete input","Please enter User name","error");
      return;
    }

    var fdata = $("form").serialize();
    var url = "lib/mod_user.php?type=addNewUser";

    $.ajax({
 
      method:"POST",
      url:url,
      data:fdata,
      dataType:"text",
      success:function(result){
        res = result.split(",");
        if(res[0]=="0"){
          swal("Error",res[1],"error")
        }
        else if(res[0]=="1"){
          swal("Success",res[1],"success");
          $("#lnknewacc").click();
        }
      },
      error:function(eobj,etxt,err){
        console.log(etxt);
      }
      });
   }); 
</script> 

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">User Management</a></li>            
  <li class="breadcrumb-item active">New Account</li>
</ol>

          <!-- New employee form-->
         
<form>
  <div class="form-group row">
    <label for="cmbename" class="col-sm-2 col-form-label">Employee Name</label>
    <div class="col-sm-3">
      <select class="form-control" id="cmbename" name="cmbename">
      	<option value="">--Select a User--</option>
      	<?php getNoLoginUsers(); ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="txteid" class="col-sm-2 col-form-label">Employee ID</label>
    <div class="col-sm-3">
      <input class="form-control" type="text" name="txteid" id="txteid" readonly="readonly">
    </div>
  </div>
  <div class="form-group row">
    <label for="txtuname" class="col-sm-2 col-form-label">User Name</label>
    <div class="col-sm-4">
      <input class="form-control" type="text" name="txtuname" id="txtuname" readonly="readonly">
    </div>
  </div>
 


  <div class="form-group row">
    <label for="cmbtype" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-3">
      <select class="form-control" name="cmbtype" id="cmbtype">
        <option value="">--Select Here--</option>
        <option value="1">Admin</option>
        <option value="2">Manager</option>
        <option value="3">Sales Assistent</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2" ></label>
    <div class="col-sm-3">
     <input type="button" class="btn btn-primary" value="save" name="btnsave" id="btnsave">
     <input type="reset" class="btn btn-danger">
    </div>
  </div>
</form>
    