<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
require_once("assets/include/Functions.php");
?>
<!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<TITLE>User_Blog</TITLE>
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
			<div class="col-sm-7 col-sm-offset-1">
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
					else if(isset($_GET['Category']))
					{
						$Category=$_GET['Category'];
						$Query="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY id DESC"; 
					}
					else if(isset($_GET['Page']))
					{
						$Page=$_GET['Page'];
						if($Page<1)
						{
							$Startingvalue=0;
						}
						else{
							$Startingvalue=($Page*5)-5;
						}
						$Query="SELECT * FROM admin_panel ORDER BY id DESC LIMIT $Startingvalue,5";
					}
					else{
						$Query="SELECT * FROM admin_panel ORDER BY id DESC LIMIT 0,5";
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
				
				<div class="blogpost thumbnail">
					<img class="image img-responsive img-rounded" src="assets/Upload/<?php echo $Image;?>">	
					<div class="caption">
						<h1 class="h1post col-sm-12"><a href="fullpost.php?id=<?php echo $Postid;?>"><?php echo htmlentities($Title); ?></a></h1>
						<p class="descriptionpost">
							Category:<?php echo '<span class="descriptionhead">'.htmlentities($Category).'</span>'; ?> 
							&nbsp;&nbsp;Published on <?php if(strlen($Datetime)>11){$Datetime=substr($Datetime,0,11);}echo '<span class="descriptionhead">'.htmlentities($Datetime).'</span>'; ?>
							<?php
									global $Connection;
									$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Postid' AND status='ON'";
									$ExecuteApproved=mysqli_query($Connection,$QueryApproved);
									$RowsApproved=mysqli_fetch_array($ExecuteApproved);
									$TotalApproved=array_shift($RowsApproved);
							?>
							<?php
								if($TotalApproved>0){
							?>
							<span class="badge pull-right">
								<?php 
										echo 'Comments '.$TotalApproved;
									}
								?>
							</span>
						</P>
						<p style="text-align:left;" class="post">
							<?php 
								if(strlen($Post)>150)
								{	
									$Post=substr($Post,0,150).'....';
								}
								echo nl2br($Post);
							?>
						</p>
						<a href="fullpost.php?id=<?php echo $Postid;?>">
							<span class="btn btn-info">Read More &rsaquo;&rsaquo;</span>
						</a>
					</div>
				</div>
				<?php
					}
				?>
				<div class="row">
					<div class="col-sm-1">
						<ul class="pager">
							<?php
								if(isset($Page))
								{
									if($Page>1)
									{
							?>
						
							<li class="previous"><a href="blog.php?Page=<?php echo $Page-1; ?>">&laquo;</a></li>
							<?php
									}
								}
							?>
						</ul>
					</div>
					<div class="col-sm-10">
						<ul class="pagination">
							<?php
								global $Connection;
								$SelectQuery="SELECT COUNT(*) FROM admin_panel";
								$ExecuteQuery=mysqli_query($Connection,$SelectQuery);
								$RowPagination=mysqli_fetch_array($ExecuteQuery);
								$Totalpost=array_shift($RowPagination);
				
								$PostPagination=$Totalpost/5;
								$PostPagination=ceil($PostPagination);
					
								for($i=1;$i<=$PostPagination;$i++)
								{
									if(isset($Page))
									{
										if($i==$Page)
										{
							?>
							<li class="active">
								<a href="blog.php?Page=<?php echo $i;?>"><?php echo $i; ?></a>
							</li>
							<?php 
										}
										else
										{
							?>
							<li>
								<a href="blog.php?Page=<?php echo $i;?>"><?php echo $i; ?></a>
							</li>
							<?php
										}
									}
								}
							?>
						</ul>
					</div>
					<div class="col-sm-1">
						<ul class="pager">
							<?php
								if(isset($Page))
								{
									if($Page<$PostPagination)
									{
							?>
						
							<li class="next"><a href="blog.php?Page=<?php echo $Page+1; ?>">&raquo;</a></li>
							<?php
									}
								}
							?>
						</ul>
					</div>
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
