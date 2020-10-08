<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
require_once("assets/include/Functions.php");
?>
<?php
if(isset($_POST['submit']))
{
	$Username=mysqli_real_escape_string($Connection,$_POST['Username']);
	$Password=mysqli_real_escape_string($Connection,$_POST['Password']);
	
	if(empty($_POST['Username'])||empty($_POST['Password']))
	{
		$_SESSION['ErrorMessage']= "all Fields must be filled out ";
		Redirect_to("login.php");
	}
	
	else
	{
		$FoundAccount=Login_attempt($Username,$Password);
		$_SESSION['Userid']=$FoundAccount['id'];
		$_SESSION['Username']=$FoundAccount['username'];
		if($FoundAccount)
		{
			$_SESSION['SuccessMessage']="Welcome {$_SESSION['Username']}";
			Redirect_to("admindashboard.php");
		}
		else
		{
			$_SESSION['ErrorMessage']= "Invalid Username or Password";
			Redirect_to("login.php");
		}
	}
}
?>
<!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<TITLE>Login_Admin_Page</TITLE>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles1.css">
    <link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/publicstyle.css">
	<link rel="stylesheet" href="assets/css/adminstyle.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="shortcut icon" href="assets/Image/favicon.png">
</HEAD>
<BODY>

	<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">blog design</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					
				</div>
			</div>
		</nav>
	 <!-- Body -->
	<div class="container-fluid">
		<div class="col-sm-6 col-sm-offset-3">
				<div class="col-sm-8 col-sm-offset-2 loginhead page-header">
					<h2>Welcome Back !</h2>
				</div>
				<div class="col-sm-8 col-sm-offset-2">
					<?php 
						echo message(); 
						echo successmessage();
					?>
				</div>
				<div class="col-sm-8 col-sm-offset-2">
				<form class="horizontal" action="login.php" method="post">
					<div class="form-group col-sm-12">
						<div class="input-group input-group-lg">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-envelope text-primary "></span>
							</span>
							<input class="form-control" type="text" id="username" name="Username" placeholder="User Name">
						</div>
					</div>
					<div class="form-group col-sm-12">
						<div class="input-group input-group-lg">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-lock text-primary"></span>
							</span>
							<input class="form-control" type="password"  name="Password" placeholder="Password">
						</div>
					</div>
					<div class="form-group col-sm-12">
						<button class="login btn btn-info btn-block" name="submit">Register</button>
					</div>			
				</form>
				</div>
				</div>
			</div>
</BODY>
<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/scripts.js"></script>
</HTML>
