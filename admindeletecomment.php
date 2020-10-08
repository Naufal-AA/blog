<?php 
	require_once("assets/include/DB.php");
	require_once("assets/include/session.php");
	require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<?php
	global $Connection;
	$Comment_id=$_GET['id'];
	$Query="DELETE FROM comments WHERE id='$Comment_id'";
	$Execute=mysqli_query($Connection,$Query);
	if($Execute)
	{
		$_SESSION['SuccessMessage']='Comment Deleted Successfully';
		Redirect_to("admincomments.php");
	}
	else{
		$_SESSION['ErroeMessage']='OOPS! Something went wrong! try again!';
		Redirect_to("admincomments.php");
	}
?>