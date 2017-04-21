<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified JavaScript -->
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
				<li><a href="student_profile.html.php">Profile</a></li>
				<li><a href="#">Progects</a></li>
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
		<img id="img" src="<?php echo getuserfield('image');   ?>" width="100" height="100" />
		<h4><?php echo getuserfield('firstname')." ".getuserfield('lastname'); ?></h4>
		<ul class="sidebar-nav">
			<li><a href="message.php">Message</a></li>
			<li><a href="#">Profile</a></li>
			<li><a href="logout.html.php">LOGOUT</a></li>
		</ul>
	</div>
</div>
		</div>
		<div class="col-sm-10">
			<div class="row">
		<div class=" col-xs-offset-1 col-md-9 panel panel-primary">
			<div class="panel-heading">Create New Project</div>
			<div class="panel-body">
			<?php if(!empty($book_msg)){  echo $book_msg;$book_msg="" ;  } ?>
				<p class="lead  p-lg alert-success">Booked Appointments</p>
             <?php
                // CURRENT_TIMESTAMP
                echo "<table class='table table-striped table-hover '>";
                echo "<tr><th>Day</th><th>Start Time</th><th>End Time</th><th>Time Booked</th></tr>";
                $studentLogInName=$_SESSION['user_id'];
                $queryB="SELECT * FROM booked_appointments WHERE  student_username='$studentLogInName' ";

                $resultB=mysql_query($queryB) or die("Error Querying". mysql_error());

                if(mysql_num_rows($resultB) > 0){

                    while($rowB=mysql_fetch_assoc($resultB)){       
                        date_default_timezone_set('Africa/Lagos');
                        // echo date("Y-m-d h-i-sa");  

                        $booked_id=$rowB['id'];

                        $current_time=date("h:i:s");
                        // echo strtotime($current_time)-12*3600 ;
                        // echo "<br>";
                        // echo $current_time."<br>";
                        $current_time=date("h:i:s d-m-Y",strtotime($current_time));
                        $st_time=$rowB['start_time'];
                        
                        $hourdiff=round(strtotime($st_time)-strtotime($current_time),1)/3600;
                        if(abs($hourdiff)<10){
                        $cancel=false;
                        }
                        else{
                            $cancel=true;
                        }
                        echo "<tr><td>".$rowB['day']."</td><td>".date('h:m A', strtotime($rowB['start_time']))."</td><td>".date('h:m A', strtotime($rowB['end_time']))."</td><td>".date('h:m A', strtotime($rowB['time_booked']))."</td><td><small><div class='tooltip-wrapper' style='display:inline-block;' ". ((!$cancel)? 'title=\'Appointment can only be cancelled 10 hours before appointment time!!\'':'') . "><button onclick=\"window.location='del_appmt.php?booked_id=$booked_id'\" class='btn btn-danger'". (($cancel)? 'disabled':'') . " >Cancel</a></div></small></td></tr>";                        
                    }
                }
                else{
                    echo "<tr><td colspan='4'><div class='alert alert-success'>No Booked Appointments<a class='close' data-dismiss='alert'>&times;</a></div></td></tr> " ;
                }
                echo "</table>";

            ?>
				<h3>To create a new project</h3>
				<button class="btn btn-primary" data-target="#project" data-toggle="modal">Click Here</button>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
		<div class="row">
		<div class=" col-xs-offset-1 col-xs-9 panel panel-primary">
			<div class="panel-heading">Supervisors Schedule</div>
			<div class="panel-body">
				<?php if(!empty($book_msg)){  echo $book_msg;$book_msg="" ;  } ?>
                <p class="lead  p-lg alert-success">All Appointments</p>
            
            <?php
                
                echo "<table class='table table-striped table-hover '>";
                echo "<tr><th>Day</th><th>Start Time</th><th>End Time</th><th></th></tr>";

                // $query="SELECT * FROM appointments WHERE student_username='$studentLogInName' ";
                $query="SELECT * FROM appointments  ";

                $result=mysql_query($query) or die("Error Querying". mysql_error());

                if(mysql_num_rows($result) > 0){

                    while($row=mysql_fetch_assoc($result)){
                        $current_no=$row['current_no'];
                        $max_no=$row['max_no'];
                        $id=$row['id'];
                        echo "<tr><td>".$row['day']."</td><td>".$row['start_time']."</td><td>".$row['end_time']."</td><td><small><div class='tooltip-wrapper' style='display:inline-block;' ". (($current_no===$max_no)? 'title=\'Max Limit for this appointment reached!!\'':'') . "><button onclick=\"window.location='book.php?id=$id'\" class='btn btn-primary'". (($current_no===$max_no)? 'disabled':'') . " >Book</button></div></small></td></tr>";
                        // $_SESSION['row_id']=$row['id'];
                }
                
                }
                
                else{
                    echo "<tr><td colspan='4'><div class='alert alert-success'>No Available Appointments<a class='close' data-dismiss='alert'>&times;</a></div></td></tr> " ;
                }
                echo "</table>";
            ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12">
				<div class="modal fade" data-keyboard="false" data-backdrop="static" id="project" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Create Project</h4>
							</div>
							<div class=" modal-body">
								<form>
									<div class="form-group">
										<label for="projectID">Project ID</label>
										<input class="form-control" placeholder="Project ID" type="text" id="projectid" />
									</div>
									<div class="form-group">
										<div class="radio">
											<label for="projectID">
											<h3>Select your assigned supervisor</h3>
											</label>
											<br />
											<label>
												<input type="radio" value="rufai" name="radio" />
												rufai </label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" value="odumuyiwa" name="radio" />
												odumuyiwa </label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" value="chika" name="radio" />
												chika </label>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button class="btn btn-primary">submit</button>
								<button class="btn btn-primary" data-dismiss="modal">cancel</button>
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
