<?php
require 'core.php';
require 'connect.php';
    $appointment_id=$_GET['id'];    
    
    $studentLogInName="";
    $studentLogInName=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

    if(!$studentLogInName){
        header('Location: student_login.php');
    }
    
    

    include('connection.php');   

    //  $queryIns="SELECT id FROM student WHERE username='$studentLogInName'   ";
    $queryChk="SELECT * FROM booked_appointments  WHERE  appointment_id='$appointment_id' AND student_username='$studentLogInName' ";

    $resultChk=mysql_query($queryChk) or die("Error Querying". mysql_error($conn));               
    echo mysql_num_rows($resultChk)."\n";
    if(mysql_num_rows($resultChk)>0){
        $msg= "<div class='alert alert-danger'>Already Booked this appointment..</div>" ;
        
    }
    else
    {   

        $querySlt="SELECT * FROM appointments  WHERE  id= '$appointment_id' ";

        $resultSlt=mysql_query($querySlt) or die("Error Querying". mysql_error());
		mysql_num_rows($resultSlt);
        if(mysql_num_rows($resultSlt)>0){

            while($row2=mysql_fetch_assoc($resultSlt)){
                $day=$row2['day'];
                $start_time=$row2['start_time'];
                $end_time=$row2['end_time'];
                $current_no=$row2['current_no'];
            }
        }
        $queryIns="INSERT INTO booked_appointments(id, appointment_id, student_username, day, start_time, end_time, time_booked ) VALUES(null, '$appointment_id', '$studentLogInName', '$day', '$start_time', '$end_time', CURRENT_TIMESTAMP)";

        $resultIns=mysql_query($queryIns) or die("Error Inserting". mysql_error());
        $msg= "<div class='alert alert-success'>Appointment Booked Successfully </div>";
        $current_no++;
        $queryUpd="UPDATE appointments SET current_no='$current_no' WHERE id='$appointment_id'  ";
        $resultUpd=mysql_query($queryUpd) or die("Error Updating". mysql_error());
        $current_no;
    }
    mysql_close();
    header("Location: landing_page.html.php?msg=$msg");


   
?>

