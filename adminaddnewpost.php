<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<?php
if(isset($_POST['submit']))
{
	$Title=mysqli_real_escape_string($Connection,$_POST['Title']);
	$category=mysqli_real_escape_string($Connection,$_POST['Category']);
	$Post=mysqli_real_escape_string($Connection,$_POST['Post']);
	
	//File(image)
	$Image=$_FILES["Image"]["name"];
	$Target="assets/Upload/".basename($_FILES["Image"]["name"]);
	$Il=strlen($Image);
	$Imagename=strstr(substr($Image,$Il-4,$Il),".");
	
	$currenttime=time();
	date_default_timezone_set("Asia/kolkata");
	$datetime=strftime("%d-%b-%Y %H:%M:%S",$currenttime);
	$admin=$_SESSION['Username'];
	
	if(($Imagename==".jpg") ||($Imagename==".JPG")||($Imagename==".png")||($Imagename==".PNG") ||($Imagename==".pdf")|| ($Imagename==".PDF"))
	{
		$Imagename="valid";
	}
	
	if(empty($_POST['Title']))
	{
		$_SESSION['ErrorMessage']= "Title can't be Empty ";
		Redirect_to("adminaddnewpost.php");
	}
	else if(strlen($Title)<=2){
		$_SESSION['ErrorMessage']= "Title should be atleast 3 Characters";
		Redirect_to("adminaddnewpost.php");
	}
	else if($category=="--SELECT--"){
		$_SESSION['ErrorMessage']= "Please Select Categories";
		Redirect_to("adminaddnewpost.php");
	}
	else if($Imagename!="valid")
	{
		$_SESSION['ErrorMessage']= "Please Upload jpg,png or pdf File";
		Redirect_to("adminaddnewpost.php");
	}
	else{
		global $Connection;
		$Query="INSERT INTO admin_panel(datetime,title,category,author,image,post) VALUES ('$datetime','$Title','$category','$admin','$Image','$Post')";
		$Execute=mysqli_query($Connection,$Query);
		
		//Image file move to folder
		move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
		
		if($Execute)
		{
			$_SESSION['SuccessMessage']='Post added successfully';
			Redirect_to("adminaddnewpost.php");
		}
		else{
			$_SESSION['ErrorMessage']='Something went Wrong! try again!';
			Redirect_to("adminaddnewpost.php");
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
	<TITLE>Admin_Add_Post</TITLE>
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
		<nav class="navbar navbar-inverse" role="navigation">
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
					<form action="blog.php" class="navbar-form navbar-right">
						<div class="input-group">
							<input class="form-control" type="text" name="Search" id="search" placeholder="Search">
						<div class="input-group-btn"><button class="btn btn-default" name="Searchbutton"><span class="glyphicon glyphicon-search">
						</span></button></div></div>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Home</a></li>
						<li><a href="blog.php?Page=1" target="_blank">Blog</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Service</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Feature</a></li>
					</ul>
				</div>
			</div>
		</nav>

	 <!-- Body -->
	<div class="container-fluid">
		<div class="row row1" id="container1">
			<div class="col-sm-2">
			<div class="sidebar">
				<ul class="nav nav-pills nav-stacked sideul">
					<li><a href="admindashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp;Dashboard</a></li>
					<li class="active"><a href="adminaddnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Add New Post</a></li>
					<li><a href="admincategory.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
					<li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Manage Admins</a></li>
					<li>
						<a href="admincomments.php">
							<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Comment
								<?php
										global $Connection;
										$QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
										$ExecuteTotal=mysqli_query($Connection,$QueryTotal);
										$RowsTotal=mysqli_fetch_array($ExecuteTotal);
										$Total=array_shift($RowsTotal);
								?>
								<?php
									if($Total>0){
								?>
								<span style="margin-top:5px" class="label label-warning pull-right">
								<?php 
									echo $Total;
									}
								?>
							</span>
						</a>
					</li>
					<li><a href="blog.php?Page=1"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;&nbsp;Live Blog</a></li>
					<li class="divider"></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li>
				</ul>
			</div>
			</div>
			<div class="col-sm-10">
				<div class="page-header">
					<h1>Add New Post</h1>
				</div>
				<div class="col-sm-12">
					<?php 
						echo message(); 
						echo successmessage();
					?>
				</div>
				<form class="horizontal" action="adminaddnewpost.php" method="post" enctype="multipart/form-data">
					<div class="form-group col-sm-12">
						<label class="control-label col-sm-1" for="title" >Title:</label>
						<div class="col-sm-11"><input type="text" class="form-control" name="Title" id="title" placeholder="Title"></div>
					</div>
					<div class="form-group col-sm-12">
						<label class="control-label col-sm-1" for="category" >Cateogry:</label>
						<div class="col-sm-11">
							<select class="form-control" id="category" name="Category">
								<option>--SELECT--</option>
								<?php
									global $Connection;
									$Query="SELECT * FROM category ORDER BY id DESC";
									$Execute=mysqli_query($Connection,$Query);
									while($DataRows=mysqli_fetch_array($Execute))
									{
										$id=$DataRows['id'];
										$category=$DataRows['name'];
								?>
								<option><?php echo $category; ?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group col-sm-12">
						<label class="control-label col-sm-1" for="image" >Image:</label>
						<div class="col-sm-11"><input type="file" class="form-control custom-file-input" name="Image" id="image" placeholder="Image"></div>
					</div>
					<div class="form-group col-sm-12">
						<label class="control-label col-sm-1" for="post" >Post:</label>
						<div class="col-sm-11"><textarea class="form-control" name="Post" id="post"></textarea></div>
					</div>
					<div class="form-group col-sm-6 col-sm-offset-3">
						<button class="btn btn-success btn-block" name="submit">Add new Post</button>
					</div>
				</form>
			</div>
		</div>
	</div>     
	
	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-1">
                    <h3>blog design</h3>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
		                    		Ut wisi enim ad minim veniam, quis nostrud.</p>
				</div>
				<div class="col-md-5 col-md-offset-2">
					<div>
						<h3>Contact US</h3>
					</div>
					<div>
						<div class="contact">
	                			<span class="fooicon glyphicon glyphicon-home"></span>
								<p> Kasaragod - 671121 , Kerala, India</p>
	                	</div>
			
						<div class="contact">
	                			<span class="fooicon glyphicon glyphicon-earphone control-col"></span>
								<p> +91 8136919446</p>
	                	</div>
						<div class="contact">
	                			<span class="fooicon glyphicon glyphicon-envelope"></span>
								<p> noufalnoupu673@gmail.com</p>
	                	</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix col-md-12 col-sm-12">
				<div class="footer-copyright">
					<p>Copyright &copy; 2020  blog design</p>
				</div>
			</div>
			<div class="clearfix col-md-12 col-sm-12">
				<hr>
			</div>

			<div class="col-md-12 col-sm-12">
				<ul class="social-icon">
					<li><a href="#" class="fa fa-facebook"></a></li>
					<li><a href="#" class="fa fa-twitter"></a></li>
					<li><a href="#" class="fa fa-google-plus"></a></li>	
					<li><a href="#" class="fa fa-linkedin"></a></li>
				</ul>
			</div>
		</div>
	</footer>

		

</BODY>
<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/scripts.js"></script>
</HTML>
