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
  padding: 17px 74px;
}	
</style>
<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>


<style>
.spinner {
    position: fixed;
    top: 50%;
    left: 35%;
    margin-left: -50px; /* half width of the spinner gif */
    margin-top: -147px; /* half height of the spinner gif */
    text-align:center;
    z-index:1234;
    overflow: hidden;
    width: 100px; /* width of the spinner gif */
    height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
}
</style>
<script type="text/javascript">
function test1(){
	document.getElementById("spinner").style.display = "block";
	document.getElementById("regform").style.display = "none";
	document.getElementById("displayed").style.height = "360px";
	document.getElementById("c_h1").style.display = "none";
	
}
$(document).ready(function(){
    $('#button-upload').click(function() {
        $('#spinner').show();
    });
});
</script>
<div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="ajax-loader.gif" alt="Loading"/>
</div>

<div id="storage" style="display:none;">
</div>
<section class="row" style="background:#9bd7d5;height:auto;">
	<div class="container" style="height:100%;">

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
						<a href="#" ONCLICK="loadWholePage('show_campaign.php')" style="text-decoration:none;">Manage Campaigns</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('statistics.php')" style="text-decoration:none;">Statistics</a>
						</li>
						<li style="padding:8px 0;">
						<a href="../logout.php" style="text-decoration:none;">Logout</a>
						</li>
					</ul>
		</div>
	
	<div id="displayed" style="width:90%;float:left;border-left:1px solid #848482;height:100%;">

		<!------------------------------------------------------------ jQUERY TEXT EDITOR ------------------------------------------------------------>
<link type="text/css" rel="stylesheet" href="demo.css">
<link type="text/css" rel="stylesheet" href="jquery-te-1.4.0.css">
<script type="text/javascript" src="https://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="jquery-te-1.4.0.min.js" charset="utf-8"></script>

<h1 style="width:93%; padding:32px 0;float:right;font-family:open_sanslight;color:#15317e;padding-bottom:10px;" id="c_h1">Enter information for your new campaign</h1>
<br/>
<form name="userinfo" method="post" action="index.php" id="regform" enctype="multipart/form-data" class="new_c">
		<input type="hidden" name="c_posted" value="true"/>
		<ul>
			<li class="new_c">
			<span class="form_label">	
				<label>Campaign Name</label>
			</span>
			<span class="form_input" style="width:80%;">
				<input type="text" name="campaign" placeholder="Enter Name" size="90" value="">*
				<span class="error"></span>
			</span>
		</li>

		
		<li class="new_c">
			<span class="form_label">
				<label>Campaign Details</label>
			</span>
		
			
			
			<span class="form_input" style="width:100%;">
				<!--<input type="text" name="formatted_text" placeholder="Formatted Text" size="27">*-->
				
				<textarea rows="8" cols="40" name="formatted_text" id="editor" class="jqte-test">
				
				</textarea>
				
				<span class="error"></span>
			</span>
			
		</li>
		<li></li><li></li><li></li><li></li>
		
		<li class="new_c">
			<span class="form_label">
				<label>Upload Logo</label>
			</span>
			<span class="form_input">
				<input type="file" name="logo" placeholder="Upload Logo" size="27" style="padding:0;">
				<span class="error"></span>
			</span>
		</li>
		
		
		
		
		<li class="new_c">	
			<input type="submit" name="register" value="Insert" required style="margin-top:17px;" id="button-upload" onclick="test1()"/>
		</li>
		
		<li class="new_c">
			
			<?php 
				if($_SESSION['c_error_msg'])
				{
					echo "<span style=\"color:#f00\">".$_SESSION['c_error_msg']."</span>";
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
