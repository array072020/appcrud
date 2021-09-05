<?php // Versionn 2.3(Search)
	//function minify_code($code) { $search = array( '/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');$replace = array('>','<','\\1');$code = preg_replace($search, $replace, $code);return $code;}
	//ob_start('minify_code');
	ob_start();
	require_once('../config/db.php');
?>
<html>
	<head>
	    <meta http-equiv="Cache-control" content="no-cache" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="-1" />
		<meta charset="utf-8">
		<meta name="format-detection" content="telephone=no">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">								
		<meta name="KeyWords" content="PHP 8.x PDO CRUDS with Data Tables(Bootstrap) and Server side">
		<meta name="author" content="Asst.Prof.Dr.Taskeow Srisod">
        <link  href="../css/bootstrap.min.css" rel="stylesheet">		
		<link  href="../css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link  href="../css/responsive.dataTables.min.css" rel="stylesheet">
		<link  href="../css/mystyle.css" rel="stylesheet">
        <script src="../js/jquery.min.js"></script>
		<script src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.buttons.min.js"></script>	
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/dataTables.bootstrap.min.js"></script>	
        <script async src="../js/dataTables.responsive.min.js"></script>
		<link rel="icon" href="../../favicon.ico" type="image/x-icon">
	</head>
	<body> <!--background='bg.webp'-->
	   <div class="container box gradiant-bgb" >
			<div align="center">
	           <h2>ระบบจัดการข้อมูลบุคลากร</h2>
			</div>
	        <div align="right">
			   <h4><a href="index.php">[<span class="glyphicon glyphicon-home"></span> หน้าแรก]</a>    
			   <a href="logout.php">[<span class="glyphicon glyphicon-stop"></span> ออกจากระบบ]</a></h4>
			</div>
	   </div>		  
 	   <div class="container box gradiant-bgb">
			<div class="table-responsive">
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info"> <span class="glyphicon glyphicon-plus"></span> เพิ่ม</button>
				</div>
				<table id="user_data" class="table table-bordered table-striped table-hover" style="width:100%">  <!-- style="width:100%" -->
					<thead>
						<tr> 
							<th width="5%">รูปภาพ</th>
							<th width="35%">ชื่อ</th>
							<th width="35%">นามสกุล</th>
							<th width="5%">แก้ไขข้อมูล</th>
							<th width="5%">ลบข้อมูล</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content gradiant-bgb">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">เพิ่มผู้ใช้งาน</h3>
				</div>
				<div class="modal-body">
					<label>ป้อนข้อมูล ชื่อ</label>
					<input type="text" name="first_name" id="first_name" class="form-control" />
					<br />
					<label>ป้อนข้อมูล นามสกุล</label>
					<input type="text" name="last_name" id="last_name" class="form-control" />
					<br />
					<label>เลือกรูปภาพ ขนาด ภาพ 1 x 1 นิ้ว เท่ากับ  300 x 300 pixel</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="เพิ่มข้อมูล" />
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("เพิ่มข้อมูล");
		$('#action').val("เพิ่มข้อมูล");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	pdfMake.fonts = {
                THSarabun: {
                    normal: 'THSarabun.ttf',
                    bold: 'THSarabun-Bold.ttf',
                    italics: 'THSarabun-Italic.ttf',
                    bolditalics: 'THSarabun-BoldItalic.ttf'
                }
            };
	
	var dataTable = $('#user_data').DataTable({
		"responsive": true,
		"processing":true,
		"serverSide":true,
		"pageLength": 5,
		"lengthMenu": [5, 10, 15, 20, 25],
		"dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +"<'row'<'col-sm-12'B>>" + 
			   "<'row'<'col-sm-12'tr>>" +
	    	   "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		"buttons": [  
                     {
                        extend: 'pdfHtml5',
                        text: '<b> ส่งออก PDF </b>' ,
                        className: 'btn  glyphicon glyphicon-file btn btn-primary',
                        exportOptions: {
                            columns: [5, 1, 2]
                        },
						customize:function(doc){ 
                            doc.defaultStyle = {
                                font:'THSarabun',
                                fontSize:16                                 
                            };

							doc.content[1].table.widths = [ 50, '*', '*' ];
							doc.content[1].table.body[0][0].text = "รูปภาพ";

							var rowCount = doc.content[1].table.body.length;
					
							for (i = 1; i < rowCount; i++) {
								doc.content[1].table.body[i][0] = {
									margin: [0, 0, 0, 12],
        							alignment: 'center',
									width: 50,
									image: doc.content[1].table.body[i][0].text
								};
							}

                            doc.styles.tableHeader.fontSize = 16;
                        }
                    },		
					{
                        extend: 'excelHtml5',
                        text: '<b> ส่งออก Excel</b>',
                        className: 'btn  glyphicon glyphicon-file btn-secondary',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
					 
                    {
                        extend: 'print',
                        text: '<b> ส่งออกเครื่องพิมพ์ </b>' ,
                        className: 'btn  glyphicon glyphicon-print btn-success',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
                ],
		"columns": [
					{"width": "5%" },
					{"width": "35%" },
					{"width": "35%" },
					{"width": "5%" },
					{"width": "5%" },
					{"width": "5%",	"visible": false }					
				   ],
		
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],
		"language": {
					   url: '../js/thai.json'
							}
		

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var firstName = $('#first_name').val();
		var lastName = $('#last_name').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','webp']) == -1)
			{
				alert("ไฟล์ภาพไม่ถูกต้อง");
				$('#user_image').val('');
				return false;
			}
		}	
		if(firstName != '' && lastName != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("ต้องระบุทั้งสองช่อง");
		}
	});
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#first_name').val(data.first_name);
				$('#last_name').val(data.last_name);
				$('.modal-title').text("แก้ไขข้อมูล");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("แก้ไขข้อมูล");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>
<!-- Bottom exportOptions -->		
		<script src="../js/jszip.min.js"></script>	
        <script src="../js/buttons.html5.min.js"></script>		
		<script src="../js/buttons.print.min.js"></script>
		<script src="../js/pdfmake.min.js"></script>
		<script src="../js/vfs_fonts.js"></script>
<?php  
       ob_end_flush(); // send buffer output
	   //ob_get_clean(); // delete the contents of the buffer, but remains buffering active
?>