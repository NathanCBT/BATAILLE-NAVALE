<?php
  if (isset($_POST["reset_total"])) {
    include('./destory_session.php');
    include('./init_boats.php');
    
    header("Location: ../index.php");
    exit;
   

  }