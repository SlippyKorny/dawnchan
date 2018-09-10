<?php
  require_once "db_connect.php";

  function register_user($_username, $_password)
  {
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn)
      die("Connection died'e'd'd (register_user)" . mysqli_connect_error());


    echo "Elo";
    $sql = "INSERT INTO `registered_users` (`user_id`, `username`, `password`, `account_type`) VALUES (NULL, '{$_username}', '{$_password}', '3')";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
    session_start();
    $_SESSION["username"] = $_username;
    header("Location: ../public/normal_user_panel.php");
  }

  register_user($_POST['username'], $_POST['password']);

?>
