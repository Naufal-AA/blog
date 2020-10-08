<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
require_once("assets/include/Functions.php");
?>
<?php
if(isset($_POST['submit']))
{
	$Postid=$_GET['id'];
	$Name=mysqli_real_escape_string($Connection,$_POST['Name']);
	$Email=mysqli_real_escape_string($Connection,$_POST['Email']);
	$Comment=mysqli_real_escape_string($Connection,$_POST['Comment']);
	
	$currenttime=time();
	date_default_timezone_set("Asia/kolkata");
	$datetime=strftime("%d-%b-%Y %H:%M:%S",$currenttime);
	
	if(empty($_POST['Name'])||empty($_POST['Email'])||empty($_POST['Comment']))
	{
		$_SESSION['ErrorMessage']= "All Fields are Required ";
	}
	else if(strlen($Comment)>500){
		$_SESSION['ErrorMessage']= "Only 500 Characters are allowed in comment";
	}
	
	else{
		global $Connection;
		$Query="INSERT INTO comments(datetime,name,email,comment,approvedby,status,admin_panel_id) VALUES ('$datetime','$Name','$Email','$Comment','Pending','OFF','$Postid')";
		$Execute=mysqli_query($Connection,$Query);
		
		if($Execute)
		{
			$_SESSION['SuccessMessage']='Comment Submitted successfully';
			Redirect_to("fullpost.php?id={$Postid}");
		}
		else{
			$_SESSION['ErrorMessage']='Something went Wrong! try again!';
			Redirect_to("fullpost.php?id={$Postid}");
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
	<TITLE>FullPost_Blog</TITLE>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/publicstyle.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="shortcut icon" href="assets/Image/favicon.png">
</HEAD>
<BODY>

	<!-- Top menu -->
	<div class="top-content">
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
						<li><a href="blog.php?Page=1">Blog</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Service</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Feature</a></li>
					</ul>
				</div>
			</div>
		</nav>
	
		<!-- Top content -->
		<div class="top-content-container">
		<div class="container">
				<div class="row">
					<div class="col-sm-12 text wow fadeInLeft">
						<h1>The Complete Responsive CMS Blog</h1>
						<div class="description">
							<p class="medium-paragraph">
								The Complete Blog Using PHP, Designed and Developed by <a href="#">NAUFAL AA</a> 
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <!-- Body -->
	<div class="bodycontainer">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="col-sm-12">
					<?php 
						echo message(); 
						echo successmessage();
					?>
				</div>
				<?php  
					global $Connection;
					if(isset($_GET['Searchbutton']))
					{
						$Search=$_GET['Search'];
						$Query="SELECT * FROM admin_panel WHERE
								datetime LIKE '%$Search%' OR
								title LIKE '%$Search%' OR
								category LIKE '%$Search%' OR
								author LIKE '%$Search%' OR
								post LIKE '%$Search%'";
					}
					else{
						$PostIdFromUrl=$_GET['id'];
						$Query="SELECT * FROM admin_panel WHERE id='$PostIdFromUrl' ORDER BY id DESC";
					}
					$Execute=mysqli_query($Connection,$Query);
					while($DataRows=mysqli_fetch_array($Execute))
					{
						$Datetime=$DataRows['datetime'];
						$Postid=$DataRows['id'];
						$Title=$DataRows['title'];
						$Category=$DataRows['category'];
						$Author=$DataRows['author'];
						$Image=$DataRows['image'];
						$Post=$DataRows['post'];
				?>
				
				<div class="fullpost thumbnail">
					<img class="image img-responsive img-rounded" src="assets/Upload/<?php echo $Image;?>">	
					<div class="caption">
						<h1 class="h1post"><a href="fullpost.php?id=<?php echo $Postid;?>"><?php echo htmlentities($Title); ?></a></h1>
						<p class="descriptionpost">
							Category:<?php echo '<span class="descriptionhead">'.htmlentities($Category).'</span>'; ?> 
							&nbsp;&nbsp;Published on <?php echo '<span class="descriptionhead">'.htmlentities($Datetime).'</span>'; ?>
						</P>
						<p class="post">
							<?php
								echo nl2br($Post);
							?>
						</p>
					</div>
				</div>
				<?php
					}
				?>
				<div class="col-sm-12" id="commentdiv">
					<span id="commenthead">Comment:</span>
				</div>
				<?php
					global $Connection;
					$Postid=$_GET['id'];
					$Query="SELECT * FROM comments WHERE admin_panel_id='$Postid' AND status='ON'";
					$Execute=mysqli_query($Connection,$Query);
					while($DataRows=mysqli_fetch_array($Execute))
					{
						$Datetime=$DataRows['datetime'];
						$Name=$DataRows['name'];
						$Email=$DataRows['email'];
						$Comment=$DataRows['comment'];
						$Status=$DataRows['status'];
				?>
				<div class="commentuser">	
					<img src="assets/Upload/avatar.png" class="user pull-left">
					<p id="date1">
						<?php 
							if(strlen($Datetime)>17){$Datetime=substr($Datetime,0,17);}
							echo $Datetime;
						?>
					</p>
					<p id="name1"><?php echo $Name;?></p>
					<p id="email1"><?php echo $Email;?></p>
					<p id="comment1"><?php echo nl2br($Comment);?></p>
				</div>
				<hr>
				<?php }?>
				<div>
					<span id="commenthead">
						Share your thoughts about this post...
					</span>
				</div>
				<div class="col-sm-12" style="border:2px solid green;padding-top:10px;margin-bottom:10px;">
					<form class="horizontal" action="fullpost.php?id=<?php echo $Postid; ?>" method="post" enctype="multipart/form-data">
						<div class="form-group col-sm-12">
							<label class="control-label col-sm-2" for="name" >Name:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="Name" id="name" placeholder="Name"></div>
						</div>
						<div class="form-group col-sm-12">
							<label class="control-label col-sm-2" for="email" >Email:</label>
							<div class="col-sm-10"><input type="email" class="form-control" name="Email" id="email" placeholder="Email"></div>
						</div>
						<div class="form-group col-sm-12">
							<label class="control-label col-sm-2" for="comment" >Comment:</label>
							<div class="col-sm-10"><textarea class="form-control" name="Comment" id="comment"></textarea></div>
						</div>
						<div class="form-group col-sm-2 col-sm-offset-2">
							<button class="btn btn-primary" name="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-3 col-sm-offset-1">
				<h1 style="text-align:center;" class="h1post">About Me</h1>
				<img src="assets/Image/aboutme.jpg" class="imageicon img-circle">
				<p>
					Sahyadri Educational Institutions are a group of Institutions established under the aegis of bhandary foundation at sahyadri campus, Mangalore, Karnataka.
					Sahyadri campus is one of the nearest institutions to the city of mangalore.
				</p>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">Categories</h4>
					</div>
					<div class="panel-body commentpanelbackground">
						<?php
							global $Connection;
							$Query="SELECT * FROM category ORDER BY id DESC";
							$Execute=mysqli_query($Connection,$Query);
							while($DataRows=mysqli_fetch_array($Execute))
							{
								$id=$DataRows['id'];
								$Datetime=$DataRows['datetime'];
								$Category=$DataRows['name'];
								$Admin=$DataRows['creatorname'];
						?>
						<a href="blog.php?Category=<?php echo $Category;?>" target="_blank"><span class="commentpanel"><?php echo $Category; ?></span></a><br>
						<?php
							}
						?>
					</div>
					<div class="panel-footer">
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">Recent Post</h4>
					</div>
					<div class="panel-body commentpanelbackground">
						<?php 
							global $Connection;
							$Query="SELECT * FROM admin_panel ORDER BY id DESC LIMIT 0,5";
							$Execute=mysqli_query($Connection,$Query);
							while($DataRows=mysqli_fetch_array($Execute))
							{
								$Datetime=$DataRows['datetime'];
								$id=$DataRows['id'];
								$Title=$DataRows['title'];
								$Category=$DataRows['category'];
								$Author=$DataRows['author'];
								$Image=$DataRows['image'];
								$Post=$DataRows['post'];
						?>
						<img style="width:60px;margin-right:0px;margin-left:-10px;" class="img-responsive img-rounded pull-left" src="assets/Upload/<?php echo $Image;?>">
						<a href="fullpost.php?id=<?php echo $id; ?>" target="_blank">
							<p style="text-align:left;padding-bottom:0px;margin-left:65px;margin-top;0px;margin-bottom:-10px;font-size:14px;"><?php echo htmlentities($Title); ?></p>
						</a>
						<p style="text-align:right;margin-top;0px;margin-bottom:0px;font-size:10px;">
							<?php
								if(strlen($Datetime)>11){$Datetime=substr($Datetime,0,11);}
								echo htmlentities($Datetime);
							?>
						</p>
						<hr style="margin-bottom:5px;margin-top:5px;">
						<?php
							}
						?>
					</div>
					<div class="panel-footer">
					</div>
				</div>
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
