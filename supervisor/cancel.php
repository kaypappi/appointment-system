<?php

echo "<br><br>";

    session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";

    $booked_id="";
    isset($_GET['booked_id']) ? $booked_id=$_GET['booked_id']:'';
    echo $booked_id;

    $msg_txt=$_GET['msg_txt'];
    echo $msg_txt;
if(!$superLogInName){
        header('Location: supervisor_login.php');
    }
    include('../includes/header.php'); 

    include('../includes/connection.php');
                
        $querySlt="SELECT appointment_id FROM booked_appointments WHERE id='$booked_id'";
        $resultSlt=mysqli_query($conn, $querySlt)or die("Error Selecting". mysqli_error($conn));
        if(mysqli_num_rows($resultSlt)>0){
            while($rowSlt=mysqli_fetch_assoc($resultSlt)){
                $appointment_id=$rowSlt['appointment_id'];
            }
        }

        $querySlt2="SELECT current_no FROM appointments WHERE id=$appointment_id ";
        $resultSlt2=mysqli_query($conn, $querySlt2)or die("Error Selecting 2". mysqli_error($conn));
        if(mysqli_num_rows($resultSlt2)>0){
            while($rowSlt2=mysqli_fetch_assoc($resultSlt2)){
                $current_no=$rowSlt2['current_no'];
            }
        }
        $current_no--;

        $queryDelBooked="DELETE FROM booked_appointments WHERE id='$booked_id'";
        $resultDelBooked=mysqli_query($conn, $queryDelBooked)or die("Error Deleting". mysqli_error($conn));


        $queryDelApmt="UPDATE  appointments SET current_no='$current_no' WHERE id='$appointment_id'";
        $resultDelApmt=mysqli_query($conn, $queryDelApmt)or die("Error Updating". mysqli_error($conn));

        
        if($resultSlt && $resultSlt2 && $resultDelBooked && $queryDelApmt){
        echo"<div class='alert alert-success'>Appointment Deleted Successfully..<a class='close' data-dismiss='alert'>&times;</a></div>" ;
        }
        else{
            echo "<div class='alert alert-danger'>Appointment Not Deleted ..<a class='close' data-dismiss='alert'>&times;</a></div>" ;
        }

        $querySlt3="SELECT * FROM student WHERE id=$appointment_id ";
        $resultSlt3=mysqli_query($conn, $querySlt2)or die("Error Selecting 2". mysqli_error($conn));
        if(mysqli_num_rows($resultSlt2)>0){
            while($rowSlt2=mysqli_fetch_assoc($resultSlt2)){
                $current_no=$rowSlt2['current_no'];
            }
        }

            
            $query="INSERT INTO message_table(id,student_username,full_name, message, type_student, type_supervisor, _time) VALUES(null, '$student_username', '$student_fullname', '$msg_txt','Inbox', 'Outbox',CURRENT_TIMESTAMP)";

            $result=mysqli_query($conn,$query) or die("Error Inserting ". mysqli_error($conn));
            $msg="Sent";
            
                header("Location:supervisor_dashboard.php");
            
        
    
?>