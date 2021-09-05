<?php
  ob_start(null, 4096);  // Once the buffer size exceeds 4096 bytes, PHP automatically executes flush, ie. the buffer is emptied and sent out.
  session_start();
?>
<html>
	<head>
	    <meta http-equiv="Cache-control" content="public">
		<meta charset="utf-8">
		<meta name="format-detection" content="telephone=no">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">								
		<meta name="KeyWords" content="แสดงผลตรวจสอบสถานะการใช้งานในระบบ">
		<meta name="author" content="Asst.Prof.Dr.Taskeow Srisod">
        <link  href="../css/bootstrap.min.css" rel="stylesheet"/>		
		<link  href="../css/dataTables.bootstrap.min.css" rel="stylesheet" />
		<link  href="../css/responsive.dataTables.min.css" rel="stylesheet"  >
		<script src="../js/jquery.min.js"></script>
		<script src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/dataTables.bootstrap.min.js"></script>	
        <script src="../js/dataTables.responsive.min.js"></script>		
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				padding:5px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
	    
	   <table align="center"><br>
	        <tr>
			    <td align="center"><h3 align="center">แสดงผลตรวจสอบสถานะการใช้งานในระบบ &nbsp;&nbsp;&nbsp; 
				    </h3>&nbsp;&nbsp;&nbsp; </td>
			    <td><h4><a href="index.php">[ หน้าก่อน]</a><a href="logout.php">[ ออกจากระบบ]</a></h4></h4></td>
			<tr>
	   </table>		  
		  
		
		<div class="container box">
			
			<div class="table-responsive">
				
				<table id="user_data" class="table table-bordered table-striped">  <!-- style="width:100%" -->
					<thead>
						<tr>
							<th width="35%">ชื่อผู้ใช้ระบบ</th>
							<th width="35%">จดหมายอิเล็กทรอนิกส์</th>
							<th width="10%">เวลาเริ่มต้นการใช้งาน</th>
							<th width="10%">เวลาปรับปรุงข้อมูล</th>
							<th width="10%">สถานะการใช้ระบบ </th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	</body>
</html>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	
	var dataTable = $('#user_data').DataTable({
		"responsive": true,
		"processing":true,
		"serverSide":true,
		"lengthMenu": [5, 10, 15, 20],
		"pageLength": 5,
		"columns": [
					{"width": "35%" },
					{"width": "35%" },
					{"width": "10%" },
					{"width": "10%" },
					{"width": "10%" }				
				   ],
		
		"order":[], 
		"ajax":{
			url:"fetchlogin.php",
			type:"POST"
		},
		"columnDefs":[
			{ 
				"orderable":true,
			},
		],
		"language": {
					   url: '../js/thai.json'
							}	

	});


});
</script>
<?php 
	  ob_end_flush(); 
	  ob_get_clean();
?>
