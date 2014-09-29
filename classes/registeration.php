<?php
/*
 * 
 * This file handles the user registeration process
 *
 * */
 
 class Registration
 {
	 public function UserRegister($user_name,$password,$user_email,$registration_datetime,$registration_ip)
	 {
			$registration_datetime = date('Y-m-d H:i:s');
			
			$sql=mysql_query("SELECT `user_id` FROM `users` WHERE `user_name`='$user_name' or `user_email`='$user_email'") or die(mysql_error());
			
			if(mysql_num_rows($sql)==0)
			{
				
				$result=mysql_query("INSERT INTO `users` (`user_name`,`user_password_hash`,`user_email`,`user_registration_datetime`,`user_registration_ip`) 
				VALUES ('$user_name','$password','$user_email',now(),'$registration_ip')") or die(mysql_error());
				
			}
			else
			{
				
				return false;
				
			}
		 
	 }
 }
?>
