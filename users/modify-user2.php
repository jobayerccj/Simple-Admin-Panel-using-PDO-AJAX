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
		<h1 class="add_user">Edit User</h1>
		<div class="view_log_details" >
				<div class="log_heading">
					
					<div class="serial_no" style="width:20%;">User Name</div>
					<div class="user_name" style="width:42%;">User Email</div>
					<div class="first_name">Current Status</div>
					<div class="last_name" style="width:20%;">Action</div>
					
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
				$stmt = $dbh->prepare("SELECT * FROM user LIMIT $start_from, 10");
				$stmt->execute() ;
				
				
				$rows = $stmt->fetchAll() ;
				
				foreach($rows as $userdetails)
				{
					?>
		
		<div class="log_row">
			
			<div class="serial_no" style="width:20%;"><?php echo $userdetails['user_name'];?></div>
			<div class="user_name" style="width:42%;"><?php echo $userdetails['user_email'];?></div>
			<div class="first_name"><?php 
							if($userdetails['user_active'] == 1){
							echo 'Active';
							}
							else{
							echo 'Inactive';
							}
							?></div>
			<div class="last_name" style="width:20%;"><a href="edituser.php?id=<?php echo $userdetails['user_id'];?>">Edit</a></div>
			
			
		</div>
<?php

}
?>
			</div>
<div id="pagination" style="">
				
				<?php
				
				
				$result = $dbh->prepare("SELECT COUNT(user_id) FROM user");
				$result->execute();
				$row = $result->fetch();
				$total_records = $row[0];
				
				$total_pages = ceil($total_records / 10);
				 
				
				if($total_pages>1){
				
				for ($i=1; $i<=$total_pages; $i++) {
				?>
				<a href="#" ONCLICK="loadWholePage('modify-user2.php?page=<?php echo $i;?>')" id="<?php if($page==$i) echo "active";?>"><?php echo $i;?></a>
				<?php }
				}
				?>
				</div>	
		
		
			<?php 				
				$dbh = new PDO('mysql:host=localhost;dbname=vpndb', 'vpndb', 'ENFEqax3VGdQmC6t');
				$stmt = $dbh->prepare("SELECT * FROM user");
				$stmt->execute() ;
				
				
				$rows = $stmt->fetchAll() ;
				
				foreach($rows as $userdetails)
				{
					?>
					
						<tbody>
							<tr >
							<td style="border:1px;solid;"><?php echo $userdetails['user_name'];?></td> 
							<td style="border:1px;solid;"><?php echo $userdetails['user_email'];?></td> 
							<td style="border:1px;solid;"><?php 
							if($userdetails['user_active'] == 1){
							echo 'Active';
							}
							else{
							echo 'Inactive';
							}
							?></td>
							
							<td style="border:1px;solid;"><a href="edituser.php?id=<?php echo $userdetails['user_id'];?>">Edit</a></td>
							
							</tr>
						</tbody>
		
					<?php
						
					
					}
					
					?> 
			
			</table>-->
	<span style="width:100%;float:left">&nbsp; </span>	
			 <span style="width:100%;float:left">&nbsp; </span>		
	</div>
<br/></br>


	
</body>
</html>
<?php

}
else
{
header('Location:../index.php');
}
?>
