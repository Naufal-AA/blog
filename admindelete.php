<?php 
	require_once("assets/include/DB.php");
	require_once("assets/include/session.php");
	require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<?php
	global $Connection;
	$Admin_id=$_GET['id'];
	$Query="DELETE FROM registration WHERE id='$Admin_id'";
	$Execute=mysqli_query($Connection,$Query);
	if($Execute)
	{
		$_SESSION['SuccessMessage']='Admin Deleted Successfully';
		Redirect_to("admins.php");
	}
	else{
		$_SESSION['ErroeMessage']='OOPS! Something went wrong! try again!';
		Redirect_to("admins.php");
	}
?>