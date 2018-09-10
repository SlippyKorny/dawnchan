<?php

function get_user_id_by_username($username, $conn)
{
  // global $servername, $username, $password, $dbname;
  // $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn)
    die("get_user_id_by_username() connection failure: " . mysqli_connect_error() . "<br>");

  $sql = "SELECT user_id FROM `registered_users` WHERE `registered_users`.`username` = '{$username}'";

  $query_result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($query_result) == 0)
    die("get_user_id_by_username() Error: user called '" . $username . "' not found");
  $row = mysqli_fetch_assoc($query_result);
  // mysqli_close($conn);
  return $row["user_id"];
}

function get_user_id_by_username_kill_con($username, $conn)
{
  // global $servername, $username, $password, $dbname;
  // $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn)
    die("get_user_id_by_username() connection failure: " . mysqli_connect_error() . "<br>");

  $sql = "SELECT user_id FROM `registered_users` WHERE `registered_users`.`username` = '{$username}'";

  $query_result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($query_result) == 0)
    die("get_user_id_by_username() Error: user called '" . $username . "' not found");
  $row = mysqli_fetch_assoc($query_result);
  mysqli_close($conn);
  return $row["user_id"];
}


?>
