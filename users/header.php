<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title>:: Home Page :</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css"/>
        
	<link rel="stylesheet" href="../css/media.css" type="text/css"/>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	

		<script>
		$.noConflict();
				function test1(){
					
					
					loadWholePage('add_campaign.php');
				}
				
		</script>
	
</head>
<body>
<header class="row">
	

	
	<header class="row">
	<div class="header_top">
		<div class="container">
			<div class="header_social_icon">
				<ul>
					<li class="top_facebook"><a href="#">f</a></li>
					<li class="top_twitter"><a href="#">T</a></li>
					<li class="top_google"><a href="#">G</a></li>
				</ul>
			</div>
			<div class="primary_nav">
				<ul>
					<li><a href="#">support@xyz.com</a></li>
					<?php if(loggedin())
                                        { ?>
					<li>
                                   
                                        <a href="../logout.php">Logout</a>
					</li><?php 
										}
										
										else{
										?>
					<li><a href="#">Login</a></li>
					
					<li><a href="#">Register</a></li><?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="header_nav">
		<div class="container">
			<div class="logo_bg">
				<a href="#"><img src="../images/logo.jpg" alt="image"/></a>
			</div>
			<nav class="secondary_nav">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="#">Products</a></li>
					<li><a href="benifits.html">Benefits</a></li>
					<li><a href="#">Pricing</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav>
		</div>
	</div>
</header>
</header>
