<?php
/*echo '<pre>';
error_reporting(E_ALL);
ini_set('display_errors', 1);*/

session_start();

$path = "../path.php";

$functionfile = $_SERVER['DOCUMENT_ROOT']."/jobayer/admin/includes/functions.php";

require_once($functionfile);

require_once($path);

include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include($loginheader);
	
	$id = $_GET['id']
?>

<script src="ajax.js" type="text/javascript"></script>
<script src="responseHTML.js" type="text/javascript"></script>
<style>
.new_c { 
  padding: 17px 180px;
}	
</style>


<div id="storage" style="display:none;">
</div>
<section class="row" style="background:#9bd7d5;">
	<div class="container" style="height:710px;">

<div style="width:9%;float:left;padding:25px 0;">
		<ul style ="display: block;list-style: none outside none;text-decoration: none; font-family:open_sanslight;" class="left1">
						<li style="padding:8px 0;">
                            <a href="#" ONCLICK="loadWholePage('adduser2.php')" style="text-decoration:none;">Add User</a>
						</li>
				        <li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('modify-user2.php')" style="text-decoration:none;">Edit User</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('online-user.php')" style="text-decoration:none;">Online Users</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('view-logs2.php')" style="text-decoration:none;">View Logs</a>
						</li>

						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('show_campaign.php')" style="text-decoration:none;">Manage Campaign</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('statistics.php')" style="text-decoration:none;">Statistics</a>
						</li>
						<li style="padding:8px 0;">
						<a href="../logout.php" style="text-decoration:none;">Logout</a>
						</li>
					</ul>
		</div>
	<hr style="width:0;height:100%;float:left;color:#ccc;"/>
	<div id="displayed" style="">

		<!------------------------------------------------------------ jQUERY TEXT EDITOR ------------------------------------------------------------>
<link type="text/css" rel="stylesheet" href="demo.css">
<link type="text/css" rel="stylesheet" href="jquery-te-1.4.0.css">
<script type="text/javascript" src="https://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="jquery-te-1.4.0.min.js" charset="utf-8"></script>

<h1 style="width:85%; padding:32px 0;float:right;font-family:open_sanslight;color:#15317e;padding-bottom:10px;">Edit campaign data</h1>
<br/>
<?php 
				if(isset($_GET['id'])){

				$id = $_GET['id'];
				//echo $id.'tsst';
				$dbh = new PDO('mysql:host=localhost;dbname=database_name', 'username', 'password');
				$stmt = $dbh->prepare("SELECT * FROM campaign where `id` = ?");
				$stmt->execute(array($id)) ;
				$row = $stmt->fetchAll() ;

			
			?>

		<form name="userinfo" method="post" action="index.php" id="regform" enctype="multipart/form-data" class="new_c">
		<input type="hidden" name="ce_posted" value="true"/>
		<input type="hidden" name="ce_id" value="<?php echo $row[0]['id'];?>"/>
		<ul>
			<li class="new_c">
			<span class="form_label">	
				<label>Campaign Name</label>
			</span>
			<span class="form_input" width="80%">
				<input type="text" name="campaign" placeholder="Enter Name" size="90" value="<?php echo $row[0]['name'];?>">*
				<span class="error"></span>
			</span>
		</li>

		
		<li class="new_c">
			<span class="form_label">
				<label>Campaign Details</label>
			</span>
			<span class="form_input" style="width:100%;">
				<!--<input type="text" name="formatted_text" class="jqte-test" placeholder="Formatted Text" size="27" value="<?php echo $row[0]['formatted_text'];?>">-->
				
				<textarea name="formatted_text" class="jqte-test">
					<?php echo $row[0]['formatted_text'];?>
				</textarea>
				<span class="error"></span>
			</span>
		</li>
		
		<li></li><li></li><li></li><li></li>
		
		<li class="new_c">
			<span class="form_label" style="position:relative;top:19px;">
				<label>Upload Logo</label>
			</span>
			<span class="form_input">
				<input type="hidden" name="logo1" value="<?php echo $row[0]['logo'];?>">
				<input type="file" name="logo" placeholder="Upload Logo" value="<?php echo $row[0]['logo'];?>">
				<img src="<?php echo $row[0]['logo'];?>" alt="logo" style="width:45px;position:relative;left:-64px;"/>
				<span class="error"></span>
			</span>
		</li>
		
		
		<li class="new_c"><br/>
			<input type="submit" name="register" value="Update" required style="margin-top:34px;"/>
		</li>
		
		<li class="new_c">
			
			<?php 
				if($_SESSION['c_error_msg'])
				{
					echo "<span style=\"color:#f00\">"."* ".$_SESSION['c_error_msg']."</span>";
					unset($_SESSION['c_error_msg']);
					//$_SESSION['error_msg']='';
				}
				else{
					echo "<span style=\"color:#15317e;\">* required field, please fill up these field correctly.</span>";
				}
			?>
		</li>
		</ul>
	
</form>	
<?php }?>

<script>
	$('.jqte-test').jqte();
	
	// settings of status
	var jqteStatus = true;
	$(".status").click(function()
	{
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
</script>
		</div>
	</div>
</section>
<?php
include($get_footer);
}
else
{
header('Location:../index.php');
}
?>
