<?php

//connect to MYsql
  $mysqli = mysqli_connect('localhost', 'root', '', 'farmers' );
  
  //check connection
  if($mysqli->connect_error){
    die('Connect Error: ' . $mysqli->connect_errno. ': ' .$mysqli->connect_error );
    }



    ?>