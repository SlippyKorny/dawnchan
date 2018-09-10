<?php
  require_once "follow_module.php";
  require_once "get_user_id.php";

  session_start();
  // echo "This is a test (follow_thread.php). user_id = " . $_SESSION["user_id"] . " thread_id = " . $_POST["thread_id"];

  echo "Hellooooo this a message from Diamond city radio. Your connection is not yet established and your username is: "
        . $_SESSION["username"];

  $connection = mysqli_connect($servername, $username, $password, $dbname);

  echo "Hellooooo this a message from Diamond city radio. Your connection is established and your username is: "
        . $_SESSION["username"];

  follow_thread($_GET["thread_id"], get_user_id_by_username_kill_con($_SESSION["username"], $connection));
?>
