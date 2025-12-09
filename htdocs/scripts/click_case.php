<?php

if (isset($_POST["a1"])) {
  echo 'A1';

  header("Location: ../index.php");
  exit;
}