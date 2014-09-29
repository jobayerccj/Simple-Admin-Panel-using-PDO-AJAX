<?php

session_start();

$path = $_SERVER['DOCUMENT_ROOT']."/jobayer/admin/path.php";

require_once('../includes/functions.php');

require_once($path);

include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{

?>
<html>
<head>
<title>Connection log info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="ajax.js" type="text/javascript"></script>
<script src="responseHTML.js" type="text/javascript"></script>

<style>
#pagination{
text-align: center;width: 60%;
}

#active {
  text-decoration: none;
  pointer-events: none;
}

</style>
</head>

<body bgcolor="#FFFFFF">
		
		<div class="form_section_content">
			<h1 class="add_user">Connection Logs Details</h1>
			
			<div class="view_log_details">
				<div class="log_heading">
					
					<div class="serial_no">User</div>
					<div class="user_name">Action</div>
					<div class="first_name">Real IP</div>
					<div class="last_name">Virtual IP</div>
					<div class="email_address">Protocol</div>
					<div class="organisation">Duration</div>
					<div class="department">Date</div>
				</div>
<?php 
	$i = 1;
	
				if (isset($_GET["page"])) { 
				
				$page = $_GET["page"]; 
				//echo $page;
				} 
				else { $page=1; };
				$start_from = ($page-1) * 10; 
				
				$dbh = new PDO('mysql:host=localhost;dbname=database_name', 'username', 'password');
				$stmt = $dbh->prepare("SELECT * FROM conn_logs LIMIT $start_from, 10");
				$stmt->execute() ;
				
				//$result = $sth->fetch(PDO::FETCH_ASSOC);
				$rows = $stmt->fetchAll() ;
				//$usersdata = mysql_query("SELECT * FROM `user`");
				foreach($rows as $userdetails)
				{
					?>
		
		<div class="log_row">
			
			<div class="serial_no"><?php echo $userdetails['user'];?></div>
			<div class="user_name"><?php echo $userdetails['action'];?></div>
			<div class="first_name"><?php echo $userdetails['Real_IP'];?></div>
			<div class="last_name"><?php echo $userdetails['Virtual_IP'];?></div>
			<div class="email_address"><?php echo $userdetails['Protocole'];?></div>
			<div class="organisation"><?php if($userdetails['Duration'] == 'NULL' || $userdetails['Duration'] ==''){echo 0;}else echo $userdetails['Duration'];?></div>
			<div class="department"><?php echo $userdetails['date'];?></div>
		</div>
<?php

}
?>
			</div>
			

				<div id="pagination" style="">
				
				<?php
				
				
				$result = $dbh->prepare("SELECT COUNT(serial) FROM conn_logs");
				$result->execute();
				$row = $result->fetch();
				$total_records = $row[0];
				
				$total_pages = ceil($total_records / 10);
				 
				
				if($total_pages>1){
				
				for ($i=1; $i<=$total_pages; $i++) {
				?>
				<a href="#" ONCLICK="loadWholePage('view-logs2.php?page=<?php echo $i;?>')" id="<?php if($page==$i) echo "active";?>"><?php echo $i;?></a>
				<?php }
				}
				?>
				</div>
		</div>
		
			<?php 
			
		
		


	</body>
</html>	
<?php

}
else
{
header('Location:../index.php');
}
?>
