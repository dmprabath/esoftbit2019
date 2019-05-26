<?php
require("../lib/mod_emp.php");
?>

<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewemp").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_emp.php?type=viewEmployee",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"},
          {"data":"3"},
          {"data":"4"},
          {"data":"5"}
        ],
        "columnDefs":[
          {
            "data":null,
            "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
            "targets":5
          },
          {
            "data":null,
            "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
            "targets":6
          }
        ]
    });
    $("#tblviewemp tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
        var type= $(this).attr('title');
        var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
        var eid = data[0];
        if(type=="Edit"){
            $("#rpanel").load("view/updateemp.php?empid="+eid);
        }else if(type=="Delete"){
            swal({
            title:"Do you want to Remove this Employee?",
            text:"You are trying to Remove Employee:"+eid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
              if(willDelete){
                var url = "lib/mod_emp.php?type=deleteEmp";
                $.ajax({
                  method:"POST",
                  url:url,
                  data:{empid:eid},
                  dataType:"text",
                  success:function(result){
                    res = result.split(",");
                    if(res[0]=="0"){
                      swal("Error",res[1],"error")
                    }
                    
                    else if(res[0]=="1"){         
                      swal("Success",res[1],"success");
                      $("#lnkviewemp").click();
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
  <li class="breadcrumb-item">
    <a href="#">Employee Management</a>
  </li>
  <li class="breadcrumb-item active">View Empoyee</li>
</ol>
<table id="tblviewemp" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Address</th>
      <th>Mobile</th>
      <th>Email</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Address</th>
      <th>Mobile</th>
      <th>Email</th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>