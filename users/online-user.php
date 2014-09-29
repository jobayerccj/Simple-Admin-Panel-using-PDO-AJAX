<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT']."/jobayer/admin/path.php";

require_once('../includes/functions.php');

require_once($path);

include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	
?>
<html>
<head>

<title>Another HTML page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css" media="all">

</style>

</head>

<body bgcolor="#FFFFFF">
		<?php 
		exec('/usr/bin/vpnstatus',$output);
		
		?>
		
		
		<div class="form_section_content" >
			<h1 class="add_user" style="text-indent:0;">Online Users</h1>	
			
			<div class="view_log_details1">
				
			<?php if(count($output)>1){ ?>
			<table id="box-table-a">
				<thead>
				<tr >
					<th style="border:1px;solid;">Common Name</th> 
					<th style="border:1px;solid;">Virtual Address</th> 
					<th style="border:1px;solid;">Real Address</th>
					<th style="border:1px;solid;">Sent</th>
					<th style="border:1px;solid;">Received</th>
					<th style="border:1px;solid;">Connected Since</th>
				
				</tr>
				</thead>
			<?php 				
				foreach($output as $test){	
					$pieces2[] = explode("  ", $test);
					if($pieces2[0][0] != 'Common Name'){
										
					
					$empty_elements = array_keys($pieces2[0],"");
					foreach ($empty_elements as $e)
					unset($pieces2[0][$e]);
					?>
					
						<tbody>
							<tr >
							<td style="border:1px;solid;"><?php echo $pieces2[0][0];?></td> 
							<td style="border:1px;solid;"><?php echo $pieces2[0][10];?></td> 
							<td style="border:1px;solid;"><?php echo $pieces2[0][14];?></td>
							<td style="border:1px;solid;"><?php echo $pieces2[0][17];?></td>
							<td style="border:1px;solid;"><?php echo $pieces2[0][20];?></td>
							<td style="border:1px;solid;"><?php echo $pieces2[0][21];?></td>
							
							</tr>
							</tbody>
							
						</div>
		<?php
					
			?>							
				
				
					 
				
			
					<?php
						}
					unset($pieces2);
					}
					
					?> 
			
			</table>
			<?php } 
			else echo "<span style='background-color:#fff;padding:5px 103px;border-radius:5px;'> No one is connected currently (updated every 60 seconds)</span>";
			?>
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		</div>	
		
		
		
			
		


	</body>
</html>	
<?php

}
else
{
header('Location:../index.php');
}
?>
