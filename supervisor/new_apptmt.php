<?php

    session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";

    if(!$superLogInName){
        header('Location: supervisor_login.php');
    }
    include('../includes/header.php'); 

    if(isset($_POST['addAppmt'])){
        include('../includes/connection.php');

        function validateFormData($form_data){
            $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
            return $form_data;
        }

        if(isset($_POST['day'])){
            $day=validateFormData($_POST['day']);
        }                
         if(isset($_POST['start_time'])){
            $start_time=validateFormData($_POST['start_time']);
        }
         if(isset($_POST['end_time'])){
            $end_time=validateFormData($_POST['end_time']);
        }
         if(isset($_POST['max_no'])){
            $max_no=validateFormData($_POST['max_no']);
        }        
    
        $query="INSERT INTO appointments (id, day, start_time, end_time, max_no) VALUES (null, '$day', '$start_time', '$end_time', '$max_no') ";
        $result=mysqli_query($conn, $query) or die("Error Querying". mysqli_error($conn));
        if($result){
           $msg= "<div class='alert alert-success'>Appointment Added Successfully<br><a class='close' data-dismiss='alert'>&times;</a></div>" ;
           header('Location:supervisor_dashboard.php');
        }
        mysqli_close($conn);

    }

    $id="";
    $id=isset($_SESSION['id']) ? $_SESSION['id'] : "";
?>
    <div class="container">        
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <form class="" action="" method="post">

                    <div class="form-group">
                        <label for="day">Select a day</label>
                        <select name="day" id="day" class="form-control">
                            <option value="MONDAY">Monday</option>
                            <option value="TUESDAY">Tuesday</option>
                            <option value="WEDNESDAY">Wednesday</option>
                            <option value="THURSDAY">Thursday</option>
                            <option value="FRIDAY">Friday</option>
                            <option value="SATURDAY">Saturday</option>
                            <option value="SUNDAY">Sunday</option>
                        </select>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="start_time">Start time</label>
                        <input type="time" id="start_time" name="start_time" class="form-control">
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="end_time">End time</label>
                        <input type="time" id="end_time" name="end_time" class="form-control">
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="max_no">Enter max no of appointments</label>
                        <input type="number" id="max_no" name="max_no" class="form-control input-sm">
                    </div>
                    <br><br><br>
                    <button type="submit" name="addAppmt" class="btn btn-danger">Add Appointment</button>
                </form>

            </div>
            
            <div class="col-sm-2 col-sm-offset-1">
            
                <p style="margin-top: 50px" class="lead  p-lg">Dashboard</p>
                <br><hr>

                <a href="" class="btn btn-primary">Manage Appointments</a>
                <br><br>
                <a href="" class="btn btn-primary">Edit Profile</a>
                <br>
                <!--<a href="#" class="btn btn-danger">Add Students</a>-->
                <br><hr><br>
                
            </div>

        </div>
    </div>


<?php   include('../includes/footer.php');?>