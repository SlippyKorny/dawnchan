<?php
  function get_board_id($board_name, $conn) {
    $sql = "SELECT * FROM `boards` WHERE board_description = '$board_name'";
    if (!$conn)
      die("get_board_name() connection failure: " . mysqli_connect_error());

    $result = mysqli_query($conn, $sql);
    $row;
    if(mysqli_num_rows($result) > 0)
      $row = mysqli_fetch_assoc($result);
    else
      die("get_board_name() query failure: The board name is incorrect");

    return $row["board_id"];
  }
?>
