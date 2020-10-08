<?php 
require_once("assets/include/DB.php");
require_once("assets/include/session.php");
require_once("assets/include/Functions.php");
?>
<?php Confirm_Login();?>
<!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<TITLE>Admin_Edit_Comment</TITLE>
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
					<li><a href="admincategory.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
					<li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Manage Admins</a></li>
					<li class="active">
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
					<h3 id="h33">UnApproved Comments</h3>
				</div>
				<div class="col-sm-12">
					<?php 
						echo message(); 
						echo successmessage();
					?>
				</div>
				<div>
					<table class="table table-striped table-condensed table-hover table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Name</th>
							<th>Date & Time</th>
							<th>Image</th>
							<th>Comment</th>
							<th>Approve</th>
							<th>Delete Comment</th>
							<th>Details</th>
						</tr>
						<?php 
							global $Connection;
							$Query="SELECT * FROM comments WHERE status='OFF' ORDER BY id DESC";
							$Execute=mysqli_query($Connection,$Query);
							$Srno=0;
							while($DataRows=mysqli_fetch_array($Execute))
							{
								$Id=$DataRows['id'];
								$Datetime=$DataRows['datetime'];
								$Name=$DataRows['name'];
								$Email=$DataRows['email'];
								$Comment=$DataRows['comment'];
								$Status=$DataRows['status'];
								$Admin_id=$DataRows['admin_panel_id'];
								$Srno++;
						?>
						<tr>
							<td><?php echo htmlentities($Srno); ?></td>
							<td>
								<?php 
									if(strlen($Name)>6){$Name=substr($Name,0,6);}
									echo htmlentities($Name);
								?>
							</td>
							<td>
								<?php 
								if(strlen($Datetime)>11){$Datetime=substr($Datetime,0,11);}
								echo htmlentities($Datetime);?>
							</td>
							<td>
							<?php
									global $Connection;
									$ImageQuery="SELECT image FROM admin_panel WHERE id='$Admin_id'";
									$Executeimage=mysqli_query($Connection,$ImageQuery);
									if($DataRows=mysqli_fetch_array($Executeimage)){
										$Image=$DataRows['image'];?>
									<img src="assets/Upload/<?php echo $Image; ?>" class="img-thumbnail" 
									style="width:100px;height:50px;margin:0;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;">
									<?php }?>
							</td>
							<td>
								<?php 
									echo htmlentities($Comment);
								?>
							</td>
							<td>
								<a href="adminapprovecomment.php?id=<?php echo $Id;?>">
									<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Approve</button>
								</a>
							</td>
							<td>
								<a href="admindeletecomment.php?id=<?php echo $Id;?>">
									<button class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Delete</button>
								</a>
							</td>
							<td>
								<a href="fullpost.php?id=<?php echo $Admin_id;?>" target="_blank">
									<button class="preview btn btn-primary"><span class="glyphicon glyphicon-tasks"></span>Live Preview</button>
								</a>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>	
				<div>
					<div class="page-header">
						<h3 id="h33">Approved Comments</h3>
					</div>
					<table class="table table-striped table-condensed table-hover table-bordered">
						<tr>
							<th>Sl No.</th>
							<th>Name</th>
							<th>Date & Time</th>
							<th>Image</th>
							<th>Comment</th>
							<th>Approved By</th>
							<th>Revert Approve</th>
							<th>Delete Comment</th>
							<th>Details</th>
						</tr>
						<?php 
							global $Connection;
							$Query="SELECT * FROM comments WHERE status='ON' ORDER BY id DESC";
							$Execute=mysqli_query($Connection,$Query);
							$Srno=0;
							while($DataRows=mysqli_fetch_array($Execute))
							{
								$Id=$DataRows['id'];
								$Datetime=$DataRows['datetime'];
								$Name=$DataRows['name'];
								$Email=$DataRows['email'];
								$Comment=$DataRows['comment'];
								$Approvedby=$DataRows['approvedby'];
								$Status=$DataRows['status'];
								$Admin_id=$DataRows['admin_panel_id'];
								$Srno++;
						?>
						<tr>
							<td><?php echo htmlentities($Srno); ?></td>
							<td>
								<?php 
									if(strlen($Name)>6){$Name=substr($Name,0,6);}
									echo htmlentities($Name);
								?>
							</td>
							<td>
								<?php 
								if(strlen($Datetime)>11){$Datetime=substr($Datetime,0,11);}
								echo htmlentities($Datetime);?>
							</td>
							<td>
								<?php
									global $Connection;
									$ImageQuery="SELECT image FROM admin_panel WHERE id='$Admin_id'";
									$Executeimage=mysqli_query($Connection,$ImageQuery);
									if($DataRows=mysqli_fetch_array($Executeimage)){
										$Image=$DataRows['image'];?>
									<img src="assets/Upload/<?php echo $Image; ?>" class="img-thumbnail" 
									style="width:100px;height:50px;margin:0;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;">
									<?php }?>
							</td>
							<td>
								<?php 
									echo htmlentities($Comment);
								?>
							</td>
							
							<td><?php echo htmlentities($Approvedby);?></td>
							<td>
								<a href="admindisapprovecomment.php?id=<?php echo $Id;?>">
									<button class="btn btn-warning">DisApprove</button>
								</a>
							</td>
							<td>
								<a href="admindeletecomment.php?id=<?php echo $Id;?>">
									<button class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Delete</button>
								</a>
							</td>
							<td>
								<a href="fullpost.php?id=<?php echo $Admin_id;?>" target="_blank">
									<button class="preview btn btn-primary"><span class="glyphicon glyphicon-tasks"></span>Live Preview</button>
								</a>
							</td>
						</tr>
						<?php } ?>
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
