<?php 

/*echo '<pre>';
error_reporting(E_ALL);
ini_set('display_errors', 1);*/

session_start();
$_SESSION['username']=$username;

$path = $_SERVER['DOCUMENT_ROOT']."/jobayer/admin/path.php";

require_once($path);
require_once($config);
include 'functions.php'; //includes the functions.php - very important
if(loggedin()) 
{
$_SESSION['username']=$username;
header ('Location:users');
exit();
}
if (isset($_POST['login'])) //check if the submit button is pressed
{
//get data
$username = $_POST['username'];
$password = md5($_POST['password']);
$remember = $_POST['remember'];

//echo $remember.'test';

$dbh = new PDO('mysql:host=localhost;dbname= database_name', 'username', 'password');
$stmt = $dbh->prepare("SELECT user_id FROM user where `user_name` = ? && `user_password_hash` = ?");
$stmt->execute(array($username,$password)) ;
$rows = $stmt->fetchAll() ;
$data = count($rows);


//$login = mysql_query("SELECT `user_id` FROM user WHERE user_name='$username' && `user_password_hash`='$password'") or die(mysql_error());


//$data = mysql_num_rows($login);
if($data>=1)
{
$loginok = TRUE;
} 
else 
{
	$message = "Incorrect Username/Password";
	
}
 
if ($loginok==TRUE) //if it is the same password, script will continue.
{	
	if ($remember == "yes") //if the Remember me is checked, it will create a cookie.
	{	
		setcookie("username", $username, time()+3600*7); //here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.	 
		header("Location:users");
		//exit();
	}
	else if ($remember=="") //if the Remember me isn't checked, it will create a session.
	{
		$_SESSION['username']=$username;
		header('Location:users');
	}
}
} 
/*************************************/
require($headerwtlogin);
?>
<script src="https://<?php echo $jqueryminjs; ?>"></script>

<script src="https://<?php echo $validateminjs; ?>"></script>

<script>
setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
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
				required:true
				},
            upassword: {
                required: true
            }
	
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            uname: {
				required: "Please enter username",
			},
            password: {
                required: "Please Enter password"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<section class="row" style="background-color: #9bd7d5">
	<div class="container">
		<div class="login_section_content">
			
			
			<div class="login_right">
				<div class="login_right_inner">
					<h1>Login</h1>
<form  action="" method="post" name="form-login" id="regform">
	<input required placeholder="Username" type="text" name="username" size="28"/>
	<span class="error"></span>
	<input required placeholder="Password" type="password" name="password" size="28"/>
	<span class="error"></span><br/>
	
	<span class="messages"><div class="messages"><?php if(!empty($message)){echo $message;}?></div></span>
	
	<label for="remember" style="color:#15317e;">Remember Me: <input type="checkbox" name="remember" value="yes"/></label>
	
	
	<input type="submit" name="login" value="LOG IN"/>
<!--<label class="forgot_password"><a href="#">Forgot Password</a></label>-->
</form>
				</div>	
			</div>
		</div>
	</div>
</section>
<?php
require($get_footer);
?>
