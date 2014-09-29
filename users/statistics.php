<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT']."/jobayer/admin/path.php";

$functionfile = $_SERVER['DOCUMENT_ROOT']."/jobayer/admin/includes/functions.php";

require_once($functionfile);

require_once($path);

include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{

?>
<html>
<head>
<title>internal page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">

	<div class="form_section_content">	
		<h1 class="add_user">Welcome to WAAUGO Admin Panel</h1>
		<div class="view_log_details" >
				<div class="log_heading">
					
					<div class="serial_no" style="width:20%;">Statistics</div>
					<div class="user_name" style="width:42%;">Last Week</div>
					<div class="first_name">Past 30 days</div>
										
				</div>
<?php 
					
				$dbh = new PDO('mysql:host=localhost;dbname=database_name', 'password', 'password');
				
				$date1 = date('Y-m-d', strtotime("-7 days"));
				$date2 = date('Y-m-d', strtotime("-30 days"));
				//echo date('M d, Y', $date);
				
				$dbh = new PDO('mysql:host=localhost;dbname=database_name', 'password', 'password');
				$result = $dbh->prepare("SELECT COUNT(user_id) FROM user WHERE DATEDIFF(user_registration_datetime, '$date1') >= 1");
				$result->execute();
				$row = $result->fetch();
				$total_user = $row[0];
				
				$result_1 = $dbh->prepare("SELECT COUNT(user_id) FROM user WHERE DATEDIFF(user_registration_datetime, '$date2') >= 1");
				$result_1->execute();
				$row_1 = $result_1->fetch();
				$total_user_1 = $row_1[0];
				
				$result2 = $dbh->prepare("SELECT COUNT(user_id) FROM user WHERE user_active='1'");
				$result2->execute();
				$row2 = $result2->fetch();
				$total_active = $row2[0];
				
				$result3 = $dbh->prepare("SELECT COUNT(user_id) FROM user WHERE user_active='0'");
				$result3->execute();
				$row3 = $result3->fetch();
				$total_inactive = $row3[0];
				
				$result4 = $dbh->prepare("SELECT COUNT(user_id) FROM user WHERE role='1'");
				$result4->execute();
				$row4 = $result4->fetch();
				$total_admin = $row4[0];
				
				$result5 = $dbh->prepare("SELECT COUNT(user_id) FROM user WHERE role != '1'");
				$result5->execute();
				$row5 = $result5->fetch();
				$total_client = $row5[0];
				
				$result6 = $dbh->prepare("SELECT COUNT(id) FROM campaign");
				$result6->execute();
				$row6 = $result6->fetch();
				$total_campaign = $row6[0];
				
				
				?>
				
		<div class="log_row">
				<?php 
				$datetime1 = date('Y-m-d H:i:s');
				
				?>
				
				<div class="serial_no" style="width:22%;padding-left:5px;"> Total registered user</div>
				<div class="user_name" style="width:39%;"><?php echo $total_user; ?></div>
				<div class="first_name"><?php echo $total_user_1; ?></div>							
		</div>
		
		<div class="log_row">			
				<div class="serial_no" style="width:20%;padding-left:5px;"> Total active user</div>
				<div class="user_name" style="width:42%;"><?php echo $total_active; ?></div>
				<div class="first_name"><?php echo $total_active; ?></div>							
		</div>
			
			<div class="log_row">		
				<div class="serial_no" style="width:20%;padding-left:5px;"> Total inactive user</div>
				<div class="user_name" style="width:42%;"><?php echo $total_inactive; ?></div>
				<div class="first_name"><?php echo $total_inactive; ?></div>							
			</div>
			
			<div class="log_row">		
				<div class="serial_no" style="width:20%;padding-left:5px;"> No. of Admin</div>
				<div class="user_name" style="width:42%;"><?php echo $total_admin; ?></div>
				<div class="first_name"><?php echo $total_admin; ?></div>							
			</div>
			
			<div class="log_row">		
				<div class="serial_no" style="width:20%;padding-left:5px;"> No. of Client</div>
				<div class="user_name" style="width:42%;"><?php echo $total_client; ?></div>
				<div class="first_name"><?php echo $total_client; ?></div>							
			</div>
			
			<div class="log_row">		
				<div class="serial_no" style="width:20%;padding-left:5px;"> No. of Campaign</div>
				<div class="user_name" style="width:42%;"><?php echo $total_campaign; ?></div>
				<div class="first_name"><?php echo $total_campaign; ?></div>							
			</div>

	</div>

	</div>

</body>
</html>
<?php

}
else
{
header('Location:../index.php');
}
?>
