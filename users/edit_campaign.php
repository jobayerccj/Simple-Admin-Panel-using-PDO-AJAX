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
	//include($loginheader);
?>
<html>
<head>
<title>Manage Campaign</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>

<body bgcolor="#FFFFFF">

	<div class="form_section_content">

<div id="edit_form2">

<?php 
if(isset($_GET['id'])){

$id = $_GET['id'];
echo $id;
$dbh = new PDO('mysql:host=localhost;dbname=database_name', 'username', 'password');


}
?>

<div class="form_section_content">
			<h1 class="add_user">Edit Campaign data</h1>
			
			<div class="view_log_details">
				<div class="log_heading">
					
					<div class="serial_no" style="padding-left:5px;">Name</div>
					<div class="user_name" style="width:59%;">Campaign Details</div>
					<div class="first_name">Logo</div>
					<div class="last_name">Action</div>
					
				</div>
<?php 
	$i = 1;
	
				if (isset($_GET["page"])) { 
				
				$page = $_GET["page"]; 
				//echo $page;
				} 
				else { $page=1; };
				$start_from = ($page-1) * 10; 
				
				$dbh = new PDO('mysql:host=localhost;dbname=database', 'username', 'password');
				$stmt = $dbh->prepare("SELECT * FROM campaign LIMIT $start_from, 10");
				$stmt->execute() ;
				
				//$result = $sth->fetch(PDO::FETCH_ASSOC);
				$rows = $stmt->fetchAll() ;
				//$usersdata = mysql_query("SELECT * FROM `campaign`");
				foreach($rows as $userdetails)
				{
					?>
		
		<div class="log_row">
			
			<div class="serial_no" style="padding-left:5px;"><?php echo $userdetails['name'];?></div>
			<div class="user_name" style="width:59%;"><?php echo $userdetails['formatted_text'];?></div>
			<div class="first_name"><img src="<?php echo $userdetails['logo'];?>" alt="logo" width="45px"/></div>
			<div class="last_name"><a href="edit_campaign2.php?id=<?php echo $userdetails['id'];?>" >Edit</a></div>
			
		</div>
<?php

}
?>
			</div>
			

				<div id="pagination" style="">
				
				<?php
				
				
				$result = $dbh->prepare("SELECT COUNT(id) FROM campaign");
				$result->execute();
				$row = $result->fetch();
				$total_records = $row[0];
				
				$total_pages = ceil($total_records / 10);
				
				
				if($total_pages>1){
				for ($i=1; $i<=$total_pages; $i++) {
				?>
				<a href="#" ONCLICK="loadWholePage('edit_campaign.php?page=<?php echo $i;?>')" id="<?php if($page==$i) echo "active";?>"><?php echo $i;?></a>
				<?php }
				}
				?>
				</div>
		</div>
</div>



<?php }else { 
header('Location:../index.php');
 } ?>

</div>
	

</body>
</html>
<?php
//require($get_footer);
?>
