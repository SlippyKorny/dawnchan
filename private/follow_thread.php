<?php
  require_once "follow_module.php";
  require_once "get_user_id.php";

  session_start();
  // echo "This is a test (follow_thread.php). user_id = " . $_SESSION["user_id"] . " thread_id = " . $_POST["thread_id"];

  $connection = mysqli_connect($servername, $username, $password, $dbname);

  $user_id = get_user_id_by_username_kill_con($_SESSION["username"], $connection);

  follow_thread($_POST["thread_id"], $user_id);
?>
