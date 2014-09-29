<?php
class users
{
	
	function deleteUser($from,$where)
	{
		
		$dquery = mysql_query("Delete from $from where $where") or die(mysql_error());
		
		if($dquery)
		{
			
			return true;
			
		} 
		else
		{
			
			return false;
			
		}
		
	}
	
}
?>
