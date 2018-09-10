<?php

  session_start();
  $_SESSION["username"] = NULL;
  header("Location: ../index.php");
?>
