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
	
		


<div id="add_form" style="display:block;">		
	
	

	<h1 class="add_user">Enter information for your new campaign</h1>
	<form name="userinfo" method="post" action="index.php" id="regform" enctype="multipart/form-data">
		<input type="hidden" name="c_posted" value="true"/>
		<ul>
			<li>
			<span class="form_label">	
				<label>Campaign Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="campaign" placeholder="Enter Name" size="27" value="">*
				<span class="error"></span>
			</span>
		</li>

		
		<li>
			<span class="form_label">
				<label>Campaign Details</label>
			</span>
			
			<!------------------------------------------------------------ jQUERY TEXT EDITOR ---------------------------------------------------------
<link type="text/css" rel="stylesheet" href="demo.css">
<link type="text/css" rel="stylesheet" href="jquery-te-1.4.0.css">
<script type="text/javascript" src="https://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="jquery-te-1.4.0.min.js" charset="utf-8"></script>


<textarea name="textarea" class="jqte-test"><b>My contents are from <u><span style="color:rgb(0, 148, 133);">TEXTAREA</span></u></b></textarea>


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

<!------------------------------------------------------------ jQUERY TEXT EDITOR ------------------------------------------------------------>
			
			
			<span class="form_input">
				<!--<input type="text" name="formatted_text" placeholder="Formatted Text" size="27">*-->
				
				<textarea rows="8" cols="40" name="formatted_text" id="editor" class="jqte-test">
				
				</textarea>
				
				<span class="error"></span>
			</span>
			
		</li>
		<li></li><li></li><li></li><li></li>
		
		<li>
			<span class="form_label">
				<label>Upload Logo</label>
			</span>
			<span class="form_input">
				<input type="file" name="logo" placeholder="Upload Logo" size="27">
				<span class="error"></span>
			</span>
		</li>
		
		
		
		
		<li>	
			<input type="submit" name="register" value="Insert" required/>
		</li>
		
		<li>
			
			<?php 
				if($_SESSION['c_error_msg'])
				{
					echo "<span style=\"color:#f00\">".$_SESSION['c_error_msg']."</span>";
					unset($_SESSION['c_error_msg']);
					//$_SESSION['error_msg']='';
				}
				else{
					echo "* required field, please fill up these field correctly.";
				}
			?>
		</li>
		</ul>
	
</form>

</div>

<div id="inserting">
	
</div>

<div id="edit_form">


<!--<div class="form_section_content">
			<h1 class="add_user">Edit Campaign data</h1>
			
			<div class="view_log_details">
				<div class="log_heading">
					
					<div class="serial_no">Name</div>
					<div class="user_name">F. Text</div>
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
				$start_from = ($page-1) * 3; 
				
				$dbh = new PDO('mysql:host=localhost;dbname=database_name', 'username', 'password');
				$stmt = $dbh->prepare("SELECT * FROM campaign LIMIT $start_from, 3");
				$stmt->execute() ;
				
				//$result = $sth->fetch(PDO::FETCH_ASSOC);
				$rows = $stmt->fetchAll() ;
				//$usersdata = mysql_query("SELECT * FROM `campaign`");
				foreach($rows as $userdetails)
				{
					?>
		
		<div class="log_row">
			
			<div class="serial_no"><?php echo $userdetails['name'];?></div>
			<div class="user_name"><?php echo $userdetails['formatted_text'];?></div>
			<div class="first_name"><img src="<?php echo $userdetails['logo'];?>" alt="logo" width="50%"/></div>
			<div class="last_name">Edit</div>
			
		</div>
<?php

}
?>
			</div>
			

				<div id="pagination" style="">
				
				<?php
				//echo 'testing pagination';
				
				$result = $dbh->prepare("SELECT COUNT(id) FROM campaign");
				$result->execute();
				$row = $result->fetch();
				$total_records = $row[0];
				
				$total_pages = ceil($total_records / 3);
				 
				/*for ($i=1; $i<=$total_pages; $i++) {
				
				echo "<a href='view-logs2.php?page=".$i."'";
				if($page==$i)
				{
				echo "id=active";
				}
				echo ">";
				echo "".$i."</a> ";
				}*/
				
				for ($i=1; $i<=$total_pages; $i++) {
				?>
				<a href="#" ONCLICK="loadWholePage('edit_campaign.php?page=<?php echo $i;?>')" id="<?php if($page==$i) echo "active";?>"><?php echo $i;?></a>
				<?php }?>
				</div>
		</div>
</div>-->

<div id="delete_form">
Delete campaign
</div>

<?php }else { 
header('Location:../index.php');
 } ?>



<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
<script>
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#regform").validate({
    
        // Specify the validation rules
        rules: {
            uname: {
				required:true,
				minlength:5,
				noSpace: true
				},
            email: {
                required: true,
                email: true
            },
            upassword: {
                required: true,
                minlength: 5,
                noSpace: true
            },
            confirm_password:{
					required:true,
					equalTo:"#uppassword"
				},
            fname:{
				required: true,
				minlength: 3,
				alpha: true
				},
			lname:{
				required:true,
				minlength: 3,
				alpha: true
				},
			designation:{
				required:true,
				minlength:4
				},
			empno:{
				required: true,
				},
			organisation:{
				required:true,
				},
				uemail:{
					required:true,
					}
				
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            uname: {
				required: "Please choose Username",
				noSpace: "Spaces are not allowed in Username"
			},
            fname:{
				required: "Please Enter your Name",
				alpha: "Only Characters are allowed"
			},
            lname:{
				required: "Please enter your Last Name",
				alpha: "Only Characters are allowed"
			},
            designation:"Field is required",
            empno: "Field is required",
            confirm_password:"Password don not Match",
            organisation:"Field is required",
            uemail: "Please enter a valid email address",
            username: "Please enter a valid username",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                noSpace: "Spaces are not allowed in Password"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>

</div>
	

</body>
</html>
<?php
//require($get_footer);
?>
