<?php

  require_once "get_board_id.php";
  require_once "db_connect.php";

  function follow_thread($thread_id, $user_id)
  {
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
      die("follow_thread() connection failure: " . mysqli_connect_error());

    $board_id = get_board_id_by_thread_id($thread_id, $conn);

    $sql = "INSERT INTO `followed_threads` (`follow_id`, `board_id`, `thread_id`, `user_id`) VALUES (NULL, '{$board_id}', '{$thread_id}', '{$user_id}')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
  }

  function unfollow_thread($thread_id, $user_id)
  {
    // DELETE FROM `followed_threads` WHERE `followed_threads`.`follow_id` = 1;

    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
      die("unfollow_thread() connection failure: " . mysqli_connect_error());

    $board_id = get_board_id_by_thread_id($thread_id, $conn);

    $sql = "DELETE FROM `followed_threads` WHERE `followed_threads`.`thread_id` = '{$thread_id}' AND `followed_threads`.`user_id` = {$user_id}";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    // TODO: Ok now you have to add seperate scripts where you'll invoke those functions. Make Jquery invoke those
    // scripts when you click on the icons

  }

  function does_user_follow_thread($thread_id, $user_id)
  {
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn)
      die("does_user_follow_thread() connection failure: " . mysqli_connect_error());

    $sql = "SELECT * FROM `followed_threads` WHERE `followed_threads`.`thread_id` = '{$thread_id}' AND `followed_threads`.`user_id` = '{$user_id}'";
    $query_result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_result) > 0)
    {
      mysqli_close($conn);
      return 1;
    }

    else
    {
      mysqli_close($conn);
      return 0;
    }
    return 0;
  }


?>
