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

if (isset($_POST['login'])) //check if the submit button is pressed
{
//get data
$username = $_POST['username'];
$password = md5($_POST['password']);
$remember = $_POST['remember'];

//echo $remember.'test';

$dbh = new PDO('mysql:host=localhost;dbname=vpndb', 'vpndb', 'ENFEqax3VGdQmC6t');
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
			
			
			
				<div class="login_right_inner">
					<h1>
					<?php 
						if(isset($_GET['name'])){
							$name = $_GET['name'];
						}
						
						$dbh = new PDO('mysql:host=localhost;dbname=vpndb', 'vpndb', 'ENFEqax3VGdQmC6t');
						$stmt = $dbh->prepare("SELECT * FROM campaign where `name` = ?");
						$stmt->execute(array($name)) ;
						$rows = $stmt->fetchAll() ;
						
						//echo $rows[0]['name']."<br/>";
						echo $rows[0]['formatted_text']."<br/>";?>
						<img src="<?php echo 'users/'.$rows[0]['logo'];?>" style="width:14%;"/>
						

			</h1>

				</div>	
			
		</div>
	</div>
</section>
<?php
require($get_footer);
?>
