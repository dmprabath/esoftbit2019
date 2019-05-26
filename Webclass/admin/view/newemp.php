<?php
require("../lib/mod_emp.php");
$newID=getNewEmpId();

?>
<script >

  $(function(){
    $("#dtpdob").datepicker({
      changeMonth:true,
      changeYear:true,
      dateFormat:"yy-mm-dd",
      maxDate:"-6570"
    });
  });

  $(function(){
    $("#dtpdoj").datepicker({
      changeMonth:true,
      changeYear:true,
      dateFormat:"yy-mm-dd",
      maxDate:"0"
    });
  });

  $(function(){
    $("#btnreg").click(function(){
      var title = $("#cmbtitle").val();
      var name = $("#txtname").val();
      var dob = $("#dtpdob").val();
      var gender = $("input[name='optgen']:checked").length;
      var address = $("#txtaddress").val();
      var mobile = $("#txttel").val();
      var email = $("#txtemail").val();
      var nic = $("#txtnic").val();
      var doj = $("#dtpdoj").val();

      if(title==""){
        swal("Invalid Input","Please Select the title","error");
        return;
      }
      var name_pattern=/^[a-zA-Z\.\s]+$/;

      if(!name.match(name_pattern)){
        swal("Invalid Input","Please enter valid name","error");
        return;
      }
      var date_pattern=/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;
      if(!dob.match(date_pattern)){
        swal("Invalid Input","Please Enter valid date","error");
        return;
      }

      if(gender== 0){
        swal("Required Field ","Please Select Gender","error");
        return;
      }
      if(address== 0){
        swal("Required Field ","Please enter valid address","error");
        return;
      }

      var email_pattern = /^[a-zA-Z\d\.\_]+\@[a-zA-Z\d\.\-]+\.[a-zA-Z]{2,4}$/;

      if(!email.match(email_pattern)){
        swal("Invalid Input","Please Enter valid email address","error");
        return;
      }
      var fdata = $('form').serialize();
      var url = "lib/mod_emp.php?type=addNewEmp";

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
          $("#lnknewemp").click();
        }
      },
      error:function(eobj,etxt,err){
        console.log(etxt);
      }

      });

    });

  });
</script> 

<!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item" ><a href="#">Employee Management</a></li>            
            <li class="breadcrumb-item active">New Employee</li>
          </ol>

          <!-- New employee form-->
         
           <form>
              <div class="form-group row">
                <label for="txteid" class="col-sm-2 col-form-label">Employee ID</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="txteid" name="txteid" value="<?php echo($newID); ?>" readonly="readonly">
                </div>
              </div>

              <div class="form-group row">
                <label for="cmbtitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-3">
                  <select class="form-control" name="cmbtitle" id="cmbtitle">
                    <option>-- Select --</option>
                    <option value="1">Mr.</option>
                    <option value="2">Ms.</option>
                    <option value="3">Dr.</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="txtname" name="txtname" value="" placeholder="Employee Full Name">
                </div>
              </div> 
              
              <div class="form-group row">
                <label for="dtpdob" class="col-sm-2 col-form-label">Date Of Birth</label>
                <div class="col-sm-3">
                  <input type="text" id="dtpdob" class="form-control" name="dtpdob" readonly="readonly">
                </div>
              </div>
              <div class="form-group row">
                <label for=""  class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-5">
                  <div class="form-check form-check-inline"> <!-- for align button and label -->
                    <input type="radio" class="form-check-input" name="optgen" id="optmale" value="1" >
                    <label for="optmale" class="form-check-label">Male</label>
                  </div>
                  <div class="form-check form-check-inline"> <!-- for align button and label -->
                    <input type="radio" class="form-check-input" name="optgen" id="optfemale" value="0" >
                    <label for="optfemale" class="form-check-label" >Female</label>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtaddress" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-3">
                  <input type="text" id="txtaddress" class="form-control" name="txtaddress" placeholder="Enter Your Address">
                </div>
              </div>

              <div class="form-group row">
                <label for="txttel" class="col-sm-2 col-form-label">Mobile</label>
                
                <div class="col-sm-3">
                  <input type="text" id="txttel" class="form-control" name="txttel" placeholder="Enter Your mobile number">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtemail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-3">
                  <input type="text" id="txtemail" class="form-control" name="txtemail" placeholder="Enter Your Email Address">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtnic" class="col-sm-2 col-form-label">NIC</label>
                <div class="col-sm-3">
                  <input type="text" id="txtnic" class="form-control" name="txtnic" placeholder="Enter Your NIC here">
                </div>
              </div>

              <div class="form-group row">
                <label for="dtpdoj" class="col-sm-2 col-form-label">Date of Join</label>
                <div class="col-sm-3">
                  <input type="text" id="dtpdoj" class="form-control" name="dtpdoj" >
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                  <input type="button" id="btnreg" class="btn btn-primary" name="btnreg" value="Register">
                  <input type="reset" class="btn btn-danger" name="">
                </div>
              </div>
              
              

             
           </form>
          