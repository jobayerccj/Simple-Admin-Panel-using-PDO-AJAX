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



	<div class="form_section_content">
			<h1 class="add_user">Edit Campaign data</h1>
			
		
			<?php 
				if(isset($_GET['id'])){

				$id = $_GET['id'];
				echo $id;
				$dbh = new PDO('mysql:host=localhost;dbname=vpndb', 'vpndb', 'ENFEqax3VGdQmC6t');
				$stmt = $dbh->prepare("SELECT * FROM campaign where `id` = ?");
				$stmt->execute(array($id)) ;
				$row = $stmt->fetchAll() ;

			
			?>

		<form name="userinfo" method="post" action="" id="regform" enctype="multipart/form-data">
		<input type="hidden" name="ce_posted" value="true"/>
		<input type="hidden" name="ce_id" value="<?php echo $row[0]['id'];?>"/>
		<ul>
			<li>
			<span class="form_label">	
				<label>Campaign Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="campaign" placeholder="Enter Name" size="27" value="<?php echo $row[0]['name'];?>">*
				<span class="error"></span>
			</span>
		</li>

		
		<li>
			<span class="form_label">
				<label>Campaign Details</label>
			</span>
			<span class="form_input">
				<input type="text" name="formatted_text" placeholder="Formatted Text" size="27" value="<?php echo $row[0]['formatted_text'];?>">
				<span class="error"></span>
			</span>
		</li>
		
		
		<li>
			<span class="form_label" style="position:relative;top:19px;">
				<label>Upload Logo</label>
			</span>
			<span class="form_input">
				<input type="file" name="logo" placeholder="Upload Logo" value="<?php echo $row[0]['logo'];?>">
				<img src="<?php echo $row[0]['logo'];?>" alt="logo" style="width:45px;position:relative;left:-64px;"/>
				<span class="error"></span>
			</span>
		</li>
		
		
		<li><br/>	
			<input type="submit" name="register" value="Update" required/>
		</li>
		
		<li>
			
			<?php 
				if($_SESSION['c_error_msg'])
				{
					echo "<span style=\"color:#f00\">"."* ".$_SESSION['c_error_msg']."</span>";
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
<?php }?>
	</div>
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
