<?php 
    session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";

    $msg="";
    $msg=isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
    echo "<br><br>";
    if(!$superLogInName){
        header('Location: supervisor_login.php');
    }
    include('../includes/header.php'); 

    include('../includes/connection.php');    
    
?>
    
    <div class="container">        
        <div class="row">
            <div class="col-sm-8">
                <?php if(!empty($msg)){  echo $msg;$msg="" ;  } ?>       
                <div class="lead alert-success div-lg">All Appointments</div>;
                <?php
                    $query="SELECT * FROM appointments ";

                    $result=mysqli_query($conn,$query) or die("Error Querying". mysqli_error($conn));
                    
                    echo "<table class='table'>";
                    echo "<tr><th>Day</th><th>Start Time</th><th>End Time</th><th>Max Students</th></tr>";

                    if(mysqli_num_rows($result) > 0){

                        while($row=mysqli_fetch_assoc($result)){
                            $current_no=$row['current_no'];
                            $max_no=$row['max_no'];
                            $id=$row['id'];
                            echo "<tr><td>".$row['day']."</td><td>".date('h:m A', strtotime($row['start_time']))."</td><td>".date('h:m A', strtotime($row['end_time']))."</td><td>".$row['max_no']."</td><td><small><button onclick=\"window.location='del_apptmt.php?app_id=$id'\" class='btn btn-danger' >Delete</a></div></small></td></tr>";
                    //         $_SESSION['row_id']=$row['id'];
                        }
                    }
                    echo '</table>';
                ?>


                <a href="new_apptmt.php" class="btn btn-danger btn-lg">New Appointment</a>

                <br><br><br><br><hr><hr>

            <p class="lead  p-lg alert-success">Booked Appointments</p>
            <?php
                
                echo "<table class='table table-striped table-hover '>";
                echo "<tr><th>Day</th><th>Start Time</th><th>End Time</th><th>Time Booked</th><th>Student</th></tr>";
                
                $queryB="SELECT * FROM booked_appointments ";

                $resultB=mysqli_query($conn,$queryB) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($resultB) > 0){

                    while($rowB=mysqli_fetch_assoc($resultB)){          
                        $booked_id=$rowB['id'];
                        
                        echo "<tr><td>".$rowB['day']."</td><td>".date('h:m A', strtotime($rowB['start_time']))."</td><td>".date('h:m A', strtotime($rowB['end_time']))."</td><td>".date('h:m A', strtotime($rowB['time_booked']))."</td><td>".$rowB['student_username']."</td><td><small><div class='tooltip-wrapper' style='display:inline-block;' ><button onclick=\"window.location='cancel_booked.php?booked_id=$booked_id'\" class='btn btn-danger' >Cancel</a></div></small></td></tr>";
                        
                }
                
                }
                
                else{
                    echo "<tr><td colspan='4'><div class='alert alert-success'>No Booked Appointments<a class='close' data-dismiss='alert'>&times;</a></div></td></tr> " ;
                }
                echo "</table>";
            ?>
            </div>
            
            <div class="col-sm-2 ">
            
                <p style="margin-top: 50px" class="lead  p-lg">Dashboard</p>
                <br><hr>

                <a href="" class="btn btn-primary">Manage Appointments</a>
                <br><br>
                <a href="super_profile.php" class="btn btn-primary">Edit Profile</a>
                <br>
                <!--<a href="#" class="btn btn-danger">Add Students</a>-->
                <br><hr><br>
                <p>Send a messge to your Student</p>
            <hr>
            <a href="message.php" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></a>
            </div>                
            <!--<br><br><br>-->
                    
    </div>
<body>


<?php   include('../includes/footer.php');?>