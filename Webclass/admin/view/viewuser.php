<?php
require("../lib/mod_user.php"); 
?>
<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewuser").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_user.php?type=viewusers",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"}
        ],
        "columnDefs":[
          {
            "data":null,
            "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='fas fa-user-edit'></i></a> ",
            "targets":3
          },
          {
            "data":null,
            "defaultContent":"<a href='#' title='password Reset'><i class='fas fa-sync-alt'></i></a> ",
            "targets":4
          },
          {
            "data":null,
            "defaultContent":"<a href='#' title='Status'><i class='fas fa-user-lock'></i></a> ",
            "targets":5
          }
        ]
    });


    $("#tblviewuser tbody").on('click','a',function(){
      var type = $(this).attr('title') ;
      var data = dataTable.row($(this).parents('tr')).data();

      var eid = data[0];
      var uname = data[1];
      if(type=="Edit"){
        $("#rpanel").load("view/updateuser.php?empid="+eid);
      }else if(type=="password Reset"){
        //$("#rpanel").load("view/resetpass.php?empid="+eid);
        swal({
          title:"Do you want to Reset password?",
          text:"You are trying to update:"+eid,
          icon:"warning",
          buttons:true,
          dangerMode:true
        }).then((willDelete)=>{
          if(willDelete){
            
            var url = "lib/mod_user.php?type=resetPassword";
            $.ajax({

              method:"POST",
              url:url,
              data:{eid:eid,uname:uname},
              dataType:"text",
              success:function(result){ 
                res = result.split(",");
                if(res[0]=="0"){
                swal("Error",res[1],"error")
              
              }else if(res[0]=="1"){         
                swal("Success",res[1],"success");
                $("#lnkviewuser").click();
              }
            },
              error:function(eobj,etxt,err){
              console.log(etxt);
            }
          });
        }
      });
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
  <li class="breadcrumb-item active">View User</li>
  
</ol>

          <!-- New employee form-->
    <table id="tblviewuser" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>User Name</th>
      <th>User Type</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>User Name</th>
      <th>User Type</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>
         
          
          