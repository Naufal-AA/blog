<?php 
	require_once("assets/include/DB.php");
	require_once("assets/include/session.php");
	require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<?php 
	global $Connection;
	$admin=$_SESSION['Username'];
	$Comment_id=$_GET['id'];
	$Query="UPDATE comments SET status='ON',approvedby='$admin' WHERE id='$Comment_id'";
	$Execute=mysqli_query($Connection,$Query);
	if($Execute)
	{
		$_SESSION['SuccessMessage']='Comment Approved Successfully';
		Redirect_to("admincomments.php");
	}
	else{
		$_SESSION['ErroeMessage']='OOPS! Something went wrong! try again!';
		Redirect_to("admincomments.php");
	}
?>