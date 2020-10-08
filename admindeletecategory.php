<?php 
	require_once("assets/include/DB.php");
	require_once("assets/include/session.php");
	require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<?php
	global $Connection;
	$Category_id=$_GET['id'];
	$Query="DELETE FROM category WHERE id='$Category_id'";
	$Execute=mysqli_query($Connection,$Query);
	if($Execute)
	{
		$_SESSION['SuccessMessage']='Category Deleted Successfully';
		Redirect_to("admincategory.php");
	}
	else{
		$_SESSION['ErroeMessage']='OOPS! Something went wrong! try again!';
		Redirect_to("admincategory.php");
	}
?>