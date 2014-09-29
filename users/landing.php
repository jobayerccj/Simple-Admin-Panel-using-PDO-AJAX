<?php 
session_start();
$_SESSION['username']=$username;

$path = $_SERVER['DOCUMENT_ROOT']."/jobayer/admin/path.php";

require_once($path);
require_once($config);
include 'functions.php'; 
if(loggedin()) 
{
$_SESSION['username']=$username;
header ('Location:users');
exit();
}
if (isset($_POST['login'])) 
{
//get data
$username = $_POST['username'];
$password = md5($_POST['password']);
$remember = $_POST['remember'];


$dbh = new PDO('mysql:host=localhost;dbname=database_name', 'username', 'password');
$stmt = $dbh->prepare("SELECT user_id FROM user where `user_name` = ? && `user_password_hash` = ?");
$stmt->execute(array($username,$password)) ;
$rows = $stmt->fetchAll() ;
$data = count($rows);

if($data>=1)
{
$loginok = TRUE;
} 
else 
{
	$message = "Incorrect Username/Password";
	
}
 
if ($loginok==TRUE) 
{	
	if ($remember == "yes") 
	{	
		setcookie("username", $username, time()+3600*7); //here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.	 
		header("Location:users");
		//exit();
	}
	else if ($remember=="") 
	{
		$_SESSION['username']=$username;
		header('Location:users');
	}
}
} 
/*************************************/
require($headerwtlogin);
?>



<section class="row" style="background-color: #9bd7d5">
	<div class="container">
		<div class="login_section_content">
			
			
			<div class="login_right">
				<div class="login_right_inner">
					<h1>Login</h1>

				</div>	
			</div>
		</div>
	</div>
</section>
<?php
require($get_footer);
?>
