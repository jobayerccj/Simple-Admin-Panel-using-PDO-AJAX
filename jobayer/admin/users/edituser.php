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

		

<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
<script>
	setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#modify-form").validate({
    
        // Specify the validation rules
        rules: {
            email_id: {
                required: true,
                email: true
            },
           first_name:{
				required: true,
				minlength: 3,
				alpha: true
				},
			last_name:{
				required:true,
				minlength: 3,
				alpha: true
				},
			designation:{
				required:true,
				minlength:4
				},
			employee:{
				required: true,
				},
			organisation:{
				required:true,
				},
				
        },
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            first_name:{
				required: "Please Enter your Name",
				alpha: "Only Characters are allowed"
			},
            last_name:{
				required: "Please enter your Last Name",
				alpha: "Only Characters are allowed"
			},
            designation:"Field is required",
            employee: "Field is required",
            confirm_password:"Password don not Match",
            organisation:"Field is required",
            email_id: "Please enter a valid email address"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>

<div id="storage" style="display:none;">
</div>
<section class="row" style="background:#9bd7d5;">
	<div class="container" style="height:auto;">

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
	
	<div id="displayed" style="width:90%;float:left;border-left:1px solid #848482;height:100%;">

		<div class="form_section_content">
			<h1 class="add_user">Modify User</h1>
			<?php
			
				//$password = $_POST['password'];
				
				
				
				$dbh = new PDO('mysql:host=localhost;dbname=vpndb', 'vpndb', 'ENFEqax3VGdQmC6t');
			
				if(isset($_POST['modify']))
				{
				$user_name = $_POST['user_name'];
				
				$user_email = $_POST['user_email'];
				
				$user_active = $_POST['user_active'];
				//echo $user_active;
				
				$expiration = $_POST['expiration'];
					
					$stmt2 = $dbh->prepare("UPDATE user SET user_name = :user_name, user_email = :user_email, user_active = :activate,expiration_date = :expiration_date WHERE user_id = :id");
					
					$final2 = $stmt2->execute(array(':user_name' => $user_name, ':user_email' => $user_email, ':activate' => $user_active, ':expiration_date' => $expiration, ':id' => $id));
					
					//$sql = mysql_query("Update `members` set `first_name`='$fname',`last_name`='$lname',`designation`
					//='$designation',`employee_no`='$employee',organisation='$organisation' where `id` = '$id'") or die(mysql_error());
					
					if($final2)
					{
						
						echo "<div class='messages'>Information updated Successfully</div>";
						
					}
					else
					{
						
						echo "<div class='messages'>Something Wrong</div>";
						
					}
					
				}
				else{
			
			?>
			<form name="form1" method="post" action="" id="regform">
				<ul>
					<?php
					
						
						$stmt = $dbh->prepare("SELECT * FROM user where `user_id` = ?");
						$stmt->execute(array($id)) ;
						$row = $stmt->fetchAll() ;
						//$data = count($row);
						//echo '<pre>';
						//print_r($row);
						//echo $row[0]['user_name'];
						//$modif = mysql_query("SELECT * FROM `members` where `id` = '$id'") or die(mysql_error());
						//$row = mysql_fetch_array($modif);
					?>
					
					<li>
					
					<span class="form_label">
						<label>User Name</label>
						</span>
						<span class="form_input">
						<input type="text" value="<?php echo $row[0]['user_name'];?>" name="user_name" id="">
						</span>
					</li>
					
					<li>
					<span class="form_label">
						<label>User Email</label>
						</span>
						<span class="form_input">
						<input type="text" value="<?php echo $row[0]['user_email'];?>" name="user_email" id="">
						</span>
					</li>
					<li>
					<span class="form_label">
						<label>Activate User</label>
						</span>
						<span class="form_input">
						<select name="user_active">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
						<!--<input type="text" value="<?php //echo $row[0]['user_active'];?>" name="employee" id="">-->
						</span>
					</li>
					<li>
					<span class="form_label">
						<label>Expiration Date</label>
						</span>
						<span class="form_input">
						<input type="text" value="<?php echo $row[0]['expiration_date'];?>" name="expiration" id="">
						</span>
					</li>	
					
					<li>
						<input type="submit" name="modify" id="" value="Update"/>
					</li>					
				</ul>
			</form>
			<?php }?>
		</div>
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
