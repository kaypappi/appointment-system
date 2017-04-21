<?php

    echo "<br><br>";
    session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";
    $booked_id="";
    isset($_GET['booked_id']) ? $booked_id=$_GET['booked_id']:'';
    //  $booked_id;
    
    if(!$superLogInName){
        header('Location: supervisor_login.php');
    }
    include('../includes/header.php'); 

    include('../includes/connection.php');

    function validateFormData($form_data){
        $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
        return $form_data;
    }

    $query="SELECT * FROM booked_appointments WHERE id='$booked_id'";
    $result=mysqli_query($conn,$query) or die("Error Querying". mysqli_error($conn));
    if(mysqli_num_rows($result) > 0){

        while($row=mysqli_fetch_assoc($result)){          
            $student_username=$row['student_username'];
            $day=$row['day'];
            $start_time=$row['start_time'];
            $end_time=$row['end_time'];
        }
        
    }
    $query4="SELECT fullname FROM student WHERE username='$student_username'";
    $result4=mysqli_query($conn,$query4) or die("Error Querying". mysqli_error($conn));
    if(mysqli_num_rows($result4) > 0){

        while($row4=mysqli_fetch_assoc($result4)){          
            $student_fullname=$row4['fullname'];
            
        }
        
    }
    
    
?>

<div class="container">
    <div class="page-header">
        <h3>Send a Messge to the Student Before you cancel his/her appointment</h3>
    </div>

    <div class="row">

        <div class="col-sm-8">   
            <form method="GET" action="cancel.php">
                <textarea name="msg_txt" id="msg_txt" class="form-control" rows="6"><?php echo "Sorry $student_username , the appointment you booked on: $day from: $start_time to: $end_time has been cancelled. Please book any other available appointment.";?></textarea>
                <br><br><br>
                <input type='text'  value='<?php echo $booked_id ;?>' name='booked_id'>
                <button  type="submit" name='del_send_msg' class='btn btn-primary'>Send Message and Cancel Appointment</button>
            </form>
        </div>
</div> 

</div>

<?php   include('../includes/footer.php');?>