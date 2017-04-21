<?php

    // session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";

    $studentLogInName="";
    $studentLogInName=isset($_SESSION['studentLogInName']) ? $_SESSION['studentLogInName'] : '';

    $student_fullname="";
    $student_fullname=isset($_SESSION['fullname']) ? $_SESSION['fullname'] : "";
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project Scheduler</title>

    <link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css"rel="stylesheet">                
<!--    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"> -->

    <link href="../css/style1.css" rel="stylesheet">          

</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<!--                <a class="navbar-brand" href="#">Brand</a>-->
                    <p class="lead"><h2>PROJECT APPOINTMENT MANAGER</h2></p>
            </div>

            <div  class="collapse navbar-collapse" id="navbar-collapse">
                
                <ul class="nav navbar-nav">
                    <li class="active"><a href="landing_page.html.php">HOME</a></li>
                    <?php
                        if($superLogInName){
                            echo "<li class='alert-danger'><a href='../logout.php'>Log-out: .$superLogInName. </a></li>";
                        }
                        elseif($studentLogInName){
                            echo "<li class='alert-danger'><a href='../logout.php'>Log-out: .$student_fullname. </a></li>";
                        }
                        else{
                            echo "<li class='dropdown'>".
                                "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>LOGIN<span  class='caret'></span></a>".                        
                                "<ul class='dropdown-menu'>".
                                "<li class='alert-danger'><a href='../student/student_login.php'>Student</a></li>".
                                "<li role='separator' class='divider'></li>".
                                "<li class='alert-danger'><a href='../supervisor/supervisor_login.php'>Supervisor</a></li>";
                        }
                              ?>
                        </ul>
                    </li>
                    <!--<img src="" alt="User Image" width="100" height="50" />-->
                </ul>
            </div>
        </div>

    </nav>