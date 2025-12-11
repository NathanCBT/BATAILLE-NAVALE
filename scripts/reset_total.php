<?php
  if (isset($_POST["reset_total"])) {
    include('./destory_session.php');
    include('./init_boat.php');
    
    header("Location: ../index.php");
    exit;
   

  }