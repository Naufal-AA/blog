<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<?php
if(isset($_POST['submit']))
{
	$Delete_ID=$_GET['Delete'];
	$currenttime=time();
	date_default_timezone_set("Asia/kolkata");
	$datetime=strftime("%d-%b-%Y %H:%M:%S",$currenttime);
	
	$Title=mysqli_real_escape_string($Connection,$_POST['Title']);
	$category=mysqli_real_escape_string($Connection,$_POST['Category']);
	$admin="Abdul Naufal";
	
	//File(image)
	$Image=$_FILES["Image"]["name"];
	$Target="assets/Upload/".basename($_FILES["Image"]["name"]);
	
	$Post=mysqli_real_escape_string($Connection,$_POST['Post']);
	
	
	global $Connection;
	$DeleteQuery="DELETE FROM admin_panel WHERE id='$Delete_ID'";
	$Executequery=mysqli_query($Connection,$DeleteQuery);
			
	if($Executequery)
	{
		$_SESSION['SuccessMessage']='Post Deleted successfully';
		Redirect_to("admindashboard.php");
	}
	else
	{
		$_SESSION['ErrorMessage']='Something went Wrong! try again!';
		Redirect_to("admindashboard.php");
	}	
}
?>
<!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<TITLE>Admin_Delete_Post</TITLE>
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
					<li class="active"><a href="admindashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp;Dashboard</a></li>
					<li><a href="adminaddnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Add New Post</a></li>
					<li><a href="admincategory.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
					<li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Manage Admins</a></li>
					<li><a href="admincomments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Comment</a></li>
					<li><a href="blog.php?Page=1"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;&nbsp;Live Blog</a></li>
					<li class="divider"></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li>
				</ul>
			</div>
			</div>
			<div class="col-sm-10">
				<div class="page-header">
					<h1>Delete Post</h1>
				</div>
				<div class="col-sm-12">
					<?php 
						echo message(); 
						echo successmessage();
					?>
				</div>
				<?php
					$Deleteid=$_GET['Delete'];
					global $Connection;
					$Query="SELECT * FROM admin_panel WHERE id='$Deleteid'";
					$Execute=mysqli_query($Connection,$Query);
					while($DataRows=mysqli_fetch_array($Execute))
					{
						$TitleDelete=$DataRows['title'];
						$CategoryDelete=$DataRows['category'];
						$ImageDelete=$DataRows['image'];
						$PostDelete=$DataRows['post'];
					}
				?>
				<form class="horizontal" action="admindeletepost.php?Delete=<?php echo $Deleteid; ?>" method="post" enctype="multipart/form-data">
					<div class="form-group col-sm-12">
						<label class="control-label col-sm-1" for="title" >Title:</label>
						<div class="col-sm-11"><input disabled type="text" class="form-control" name="Title" 
														value="<?php echo $TitleDelete;?>" id="title" placeholder="Title">
						</div>
					</div>
					<div class="form-group col-sm-12">
						<div class="col-sm-12">
							<span class="fieldinfo"><?php echo "Existing Category:<span class=\"fieldinforesult\">$CategoryDelete</span>";?></span>
						</div>
						<label class="control-label col-sm-1" for="category" >Cateogry:</label>
						<div class="col-sm-11">
							<select disabled class="form-control" id="category" name="Category">
								<option><?php echo $CategoryDelete;?></option>
							</select>
						</div>
					</div>
					<div class="form-group col-sm-12">
						<div class="col-sm-12">
							<span class="fieldinfo">Existing Image:
								<img src="assets/Upload/<?php echo $ImageDelete;?>" class="img-thumbnail" 
									style="width:100px;height:50px;margin:0;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;">
							</span>
						</div>
						<label class="control-label col-sm-1" for="image" >Image:</label>
						<div class="col-sm-11"><input disabled type="file" class="form-control custom-file-input" name="Image" id="image" placeholder="Image"></div>
					</div>
					<div class="form-group col-sm-12">
						<label class="control-label col-sm-1" for="post" >Post:</label>
						<div class="col-sm-11"><textarea disabled class="form-control" name="Post" id="post"><?php echo $PostDelete; ?></textarea></div>
					</div>
					<div class="form-group col-sm-6 col-sm-offset-3">
						<button class="btn btn-danger btn-block" name="submit">Delete Post</button>
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
