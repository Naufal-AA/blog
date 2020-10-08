<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<?php
if(isset($_POST['submit']))
{
	$category=mysqli_real_escape_string($Connection,$_POST['category']);
	$currenttime=time();
	date_default_timezone_set("Asia/kolkata");
	$datetime=strftime("%d-%b-%Y %H:%M:%S",$currenttime);
	$admin=$_SESSION['Username'];
	if(empty($_POST['category']))
	{
		$_SESSION['ErrorMessage']= "all Fields must be filled out ";
		Redirect_to("admincategory.php");
	}
	else if(strlen($category)>99){
		$_SESSION['ErrorMessage']= "Too Long Name ";
		Redirect_to("admincategory.php");
	}
	else{
		global $Connection;
		$Query="INSERT INTO category(datetime,name,creatorname) VALUES ('$datetime','$category','$admin')";
		$Execute=mysqli_query($Connection,$Query);
		if($Execute)
		{
			$_SESSION['SuccessMessage']='Category added successfully';
			Redirect_to("admincategory.php");
		}
		else{
			$_SESSION['ErrorMessage']='Category Failed to add';
			Redirect_to("admincategory.php");
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
	<TITLE>Admin_Add_Category</TITLE>
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
					<li><a href="adminaddnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Add New Post</a></li>
					<li class="active"><a href="admincategory.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
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
					<h1>Add New Category</h1>
				</div>
				<div class="col-sm-12">
					<?php 
						echo message(); 
						echo successmessage();
					?>
				</div>
				<form class="horizontal" action="admincategory.php" method="post">
					<div class="form-group col-sm-12">
						<label class="control-label col-sm-1" for="name" >Name:</label>
						<div class="col-sm-11"><input type="text" class="form-control" name="category" id="name" placeholder="Name"></div>
					</div>
					<div class="form-group col-sm-6 col-sm-offset-3">
						<button class="btn btn-success btn-block" name="submit">Add new Category</button>
					</div>
				</form>
				<div>
					<table class="table table-striped table-condensed table-hover table-bordered">
						<tr>
							<th>ID</th>
							<th>Date</th>
							<th>Category</th>
							<th>Admin Name</th>
							<th>Action</th>
						</tr>
						<?php
							global $Connection;
							$Query="SELECT * FROM category ORDER BY id DESC";
							$Execute=mysqli_query($Connection,$Query);
							$srno=0;
							while($DataRows=mysqli_fetch_array($Execute))
							{
								$id=$DataRows['id'];
								$datetime=$DataRows['datetime'];
								$category=$DataRows['name'];
								$Admin=$DataRows['creatorname'];
								$srno++;
							
						?>
						<tr>
							<td><?php echo $srno; ?></td>
							<td><?php echo $datetime; ?></td>
							<td class="info"><?php echo $category; ?></td>
							<td><?php echo $Admin; ?></td>
							<td>
								<a href="admindeletecategory.php?id=<?php echo $id;?>">
									<button class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Delete</button>
								</a>
							</td>
						</tr>
						<?php
							}
						?>
					</table>
				</div>
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
