<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
?>
<?php
function Redirect_to($NewLocation){
	header("Location:".$NewLocation);
	exit;
}

function Login_attempt($Username,$Password)
{
	global $Connection;
	$Query="SELECT * FROM registration WHERE username='$Username' AND password='$Password'";
	$Execute=mysqli_query($Connection,$Query);
	if($admin=mysqli_fetch_assoc($Execute))
	{
		return $admin;
	}
	else
	{
		return null;
	}
}

function Login(){
	if(isset($_SESSION['Userid'])){
		return true;
	}
}
function Confirm_Login(){
	if(!Login()){
		$_SESSION['ErrorMessage']='Login Required!';
		Redirect_to("login.php");
	}
}
?>