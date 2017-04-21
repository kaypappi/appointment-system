<?php 
    session_start();
    $studentLogInName="";
    $studentLogInName=isset($_SESSION['studentLogInName']) ? $_SESSION['studentLogInName'] : "";

    $book_msg="";
    $book_msg=isset($_GET['msg']) ? $_GET['msg'] : $book_msg="";
    // echo $book_msg;

    if(!$studentLogInName){
        header('Location: student_login.php');
    }
    
    include('../includes/header.php'); 

    include('../includes/connection.php');              
    
?>
    
<div class="container">        
    <div class="row">
        <div class="col-md-8">
            <?php if(!empty($book_msg)){  echo $book_msg;$book_msg="" ;  } ?>
                <p class="lead  p-lg alert-success">All Appointments</p>
            
            <?php
                
                echo "<table class='table table-striped table-hover '>";
                echo "<tr><th>Day</th><th>Start Time</th><th>End Time</th><th></th></tr>";

                // $query="SELECT * FROM appointments WHERE student_username='$studentLogInName' ";
                $query="SELECT * FROM appointments  ";

                $result=mysqli_query($conn,$query) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($result) > 0){

                    while($row=mysqli_fetch_assoc($result)){
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
            <br><br><br><br><hr><hr>

            <p class="lead  p-lg alert-success">Booked Appointments</p>
            <?php
                
                echo "<table class='table table-striped table-hover '>";
                echo "<tr><th>Day</th><th>Start Time</th><th>End Time</th><th>Time Booked</th></tr>";
                
                $queryB="SELECT * FROM booked_appointments WHERE  student_username='$studentLogInName' ";

                $resultB=mysqli_query($conn,$queryB) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($resultB) > 0){

                    while($rowB=mysqli_fetch_assoc($resultB)){          
                        $booked_id=$rowB['id'];

                        $current_time='CURRENT_TIMESTAMP';
                        $booked_time=$rowB['time_booked'];
                        if($current_time-$booked_time>=0){
                            $cancel=true;
                        }
                        else{   $cancel=false;  }
                        echo "<tr><td>".$rowB['day']."</td><td>".$rowB['start_time']."</td><td>".$rowB['end_time']."</td><td>".$rowB['time_booked']."</td><td><small><div class='tooltip-wrapper' style='display:inline-block;' ". ((!$cancel)? 'title=\'Appointment can only be cancelled 10 hours before appointment time!!\'':'') . "><button onclick=\"window.location='book.php?id=$booked_id'\" class='btn btn-danger'". ((!$cancel)? 'disabled':'') . " >Cancel</a></div></small></td></tr>";
                        // $_SESSION['row_id']=$row['id'];
                }
                }
                else{
                    echo "<tr><td colspan='4'><div class='alert alert-success'>No Booked Appointments<a class='close' data-dismiss='alert'>&times;</a></div></td></tr> " ;
                }
                echo "</table>";

                $queryImg="SELECT image_name FROM student WHERE username='$studentLogInName'";
                $resultImg=mysqli_query($conn,$queryImg) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($resultImg) > 0){

                    while($rowImg=mysqli_fetch_assoc($resultImg)){   
                        $image_name=$rowImg['image_name'];
                    }
                }
            ?>
        
        
        </div>
        
        <div class="col-md-2 col-md-offset-1">
        
            <p style="margin-top: 50px" class="lead  p-lg">Dashboard</p>
            <br><hr>

            <a href="" class="btn btn-primary">Available Appointments</a>
            <br><br>
            <a href="student_profile.php" class="btn btn-primary">Change Password</a>
            <br><br>
            <a href='upload_pic.php' class='btn btn-primary' >Upload/Change Profile Pic</a>
            <br><br>
            <form action="" methos="POST">
            <!--<input type="file" name='profile_image' class='img-circle form-control' />-->
            <!--</form>-->
            <a href='' ><img  src="../uploads/<?php echo $image_name; ?>" class="img-circle" alt="User Image" width="104" height="76" ></a> 

            <br><br><hr>

            <p>Send a messge to your supervisor</p>
            <hr>
            <button  onclick='' class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></button>
            <br>
            <!--<a href="#" class="btn btn-danger">Add Students</a>-->
            <br><hr><br>
            
        </div>
            
        

        <br><br><br>

                
        </div>    
</div>
<body>


<?php   include('../includes/footer.php');?>