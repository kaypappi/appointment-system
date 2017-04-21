<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/land.css" />
<link href="../../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" />
<link href="../../bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet"  />
<title>Untitled Document</title>
</head>

<body>
<?php
	require 'core.php';
	require 'connect.php';
	
?>
<div class="">
	<nav class="navbar navbar-default navbar-inverse">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-target="#coll" data-toggle="collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
		</div>
		<div id="coll" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right ">
				<li class="active"><a href="#">Dashboard</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Projects</a></li>
			</ul>
		</div>
	</nav>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<div id="wrapper">
				<div id="sidebar">
					<div id="sidebar-btn" > <span></span> <span></span> <span></span> </div>
					<a href='' ><img id="img" src="<?php echo getuserfield('image');   ?>" width="100" height="100" /></a>
					<h4><?php echo getuserfield('firstname')." ".getuserfield('lastname'); ?></h4>
					<ul class="sidebar-nav">
						<li><a href="#">Dashboard</a></li>
						<li><a href="#">Profile</a></li>
						<li><a href="logout.html.php">LOGOUT</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-10">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-6"> <a href='' ><img  src="<?php echo getuserfield('image');   ?>" class="img-circle" alt="User Image" width="300" height="300" ></a> </div>
				
			</div>
			<div class="row">
				<div class="col-md-2">
				
				</div>
				<div class="col-md-8"><br />
				<ul class="list-group">
  <li class="list-group-item"><h4>FULL NAME:<?php  echo getuserfield('firstname').'  '. getuserfield('lastname'); ?></h4></li>
  <li class="list-group-item"><h4>MATRIC NUMBER:<?php echo getuserfield('matricno'); ?></h4></li>
  <li class="list-group-item"><h4>DEPARTMENT:<?php echo getuserfield('department'); ?></h4></li>
  <li class="list-group-item"><h4>EMAIL:<?php echo getuserfield('email'); ?></h4></li>
  
</ul>
				
				<button class="btn btn-primary" data-target="#project" data-toggle="modal">Change Password</button> <br>
					<br>
					<button class="btn btn-primary" data-target="#image" data-toggle="modal">Upload Picture</button> <br>
					<br>
					
					<div class="row">
						<div class="col-xs-12">
							<div class="modal fade" data-keyboard="false" data-backdrop="static" id="project" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Password</h4>
										</div>
										<div class=" modal-body"> 
											<!--<?php if(!empty($msg)){  echo $msg;$msg="" ;  } ?>       -->
											<form method="post" action="student_profile.php">
												<div class="form-group">
													<div class="input-group">
														<label for="oldPassword">Enter old Password</label>
														<input type="password" id="oldPassword" name="oldPassword" class="form-control">
													</div>
													<br>
													<div class="input-group">
														<label for="newPassword1">Enter new Password</label>
														<input type="password" id="newPassword1" name="newPassword1" class="form-control">
													</div>
													<br>
													<div class="input-group">
														<label for="newPassword2">ConfirmPassword</label>
														<input type="password" id="newPassword2" name="newPassword2" class="form-control">
													</div>
													<br>
													<br>
												<button type="submit" id="update" name="update" class="btn btn-danger">Update Profile</button>
												</div>
												
											</form>
										</div>
										<div class="modal-footer">
											<button  class="btn btn-primary" data-dismiss="modal">cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12">
							<div class="modal fade" data-keyboard="false" data-backdrop="static" id="image" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Password</h4>
										</div>
										<div class=" modal-body"> 
											<form action='upload_pic.php' method='POST' enctype="multipart/form-data" class='form'>
                <label for='image' class='label label-success'>Select an image to upload Image should be less than 2Mb</label>
                <input type='file' name='image' id='image'>
                <br><br><br>
                <button type='submit' name='submit' class='btn btn-primary' >Upload Picture</button>
            </form>
										</div>
										<div class="modal-footer">
											<button  class="btn btn-primary" data-dismiss="modal">cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../../bootstrap-3.3.7-dist/js/jquery-3.1.1.min (1).js"></script> 
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script type="text/javascript">
	$(document).ready(function() {
		$('#sidebar-btn').click(function(){
			$('#sidebar').toggleClass('visible');
		});
	});
</script>
</body>
</html>
