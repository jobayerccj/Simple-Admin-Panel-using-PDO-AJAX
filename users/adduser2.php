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
<title>Add user</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>

<body bgcolor="#FFFFFF">

	


		<div class="form_section_content">
		<h1 class="add_user">User Registration</h1>
<form name="userinfo" method="post" action="index.php" id="regform">
	<ul>
		<li>
			<span class="form_label">	
				<label>User Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="uname" placeholder="Choose User Name" size="27" value="">*
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">	
				<label>Password</label>
			</span>
			<span class="form_input">
				<input type="password" name="upassword" id="uppassword" placeholder="Choose Password" size="27">*
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">
				<label>Confirm Password</label>
			</span>
			<span class="form_input">
				<input type="password" name="confirm_password" placeholder="Confirm Password" size="27">*
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">
				<label>Email Address</label>
			</span>
			<span class="form_input">
				<input type="email" name="uemail" placeholder="Email-ID" size="27">*
				<span class="error"></span>
			</span>
		</li>
		
		<li>
		   <span class="form_label">
				<label>Date of Expiration</label>
			</span>
			<span class="form_input">
				
				
				<input type="date" name="expiration" placeholder="YY-MM-DD" size="27" id="datepicker">
				</span>
				<span class="error"></span>
			</span>
	   </li>
		
		<li>
			<span class="form_label">
				<label>Activate User</label>
			</span>
			<span class="form_input">
				<select name="activate" class="select_d">
					
					<option value="1">Active</option>
					<option value="0">Inactive</option>
					
					
				</select>
				<!--<input type="text" name="fname" placeholder="First Name" size="27">-->
				<span class="error"></span>
			</span>
		</li>
			
	   
	  
	   <li>
		   <span class="form_label">
				<label>User Role</label>
			</span>
			<span class="form_input">
				<select name="role" class="select_d">
					
					<option value="2">Client</option>
					<option value="1">Admin</option>
				
				</select>
				
				<!--<input type="text" name="designation" placeholder="DD/MM/YY" size="27" id="datepicker">-->
				</span>
				<span class="error"></span>
			</span>
	   </li>
	
       
	
		
		
		<li>	
			<input type="submit" name="register" value="Register" required/>
		</li>
		
		<li>
			
			<?php 
				if($_SESSION['error_msg'])
				{
					echo "<span style=\"color:#f00\">"."* ".$_SESSION['error_msg']."</span>";
					unset($_SESSION['error_msg']);
					//$_SESSION['error_msg']='';
				}
				else{
					echo "<span style=\"color:#15317e;\">* required field, please fill up these field correctly.</span>";
				}
			?>
		</li>
		</ul>
	
</form>
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
