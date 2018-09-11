<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User panel</title>
    <link rel="shortcut icon" href="../assets/img/Favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/classic_theme.css">
    <!-- <script src="../js/createNewThread.js"></script> -->
    <!-- <script src="../js/getBoardId.js"></script> -->
    <!-- <board_id style="display: none">1</board_id> -->
</head>
<body>
  <nav>
  <div id="boards">
  <h1>Boards</h1>
    <div id="jap-culture">
      <b>Japanese Culture</b>
      <ul>
        <li><a href="a.php">Anime</a></li>
        <li><a href="jp.php">Otaku culture</a></li>
      </ul>
    </div>
    <div id="video-games">
      <b>Video Games</b>
      <ul>
        <li><a href="v.php">Video Games</a></li>
        <li><a href="vp.php">Pokémon</a></li>
      </ul>
    </div>
    <div id="interests">
      <b>Interests</b>
      <ul>
        <li><a href="co.php">Comics & Cartoons</a></li>
        <li><a href="g.php">Technology</a></li>
      </ul>
    </div>
  </div>
  <div id="misc">
    <?php
      session_start();
      if ($_SESSION["username"] != NULL)
        echo "[Logged in as: <a href=''>" . $_SESSION["username"] . "</a>]";
    ?>
      [Settings]
      [Search]
      [<a href="../private/log_out.php">Log out</a>]
      [<a href="../index.php">Home</a>]
  </div>
      <div style="clear: both"></div>
  </nav><br>
    <?php
        $banner_number = rand(1, 3);
        $img_tag = "<img src=\"../assets/img/Banners/" . $banner_number . ".jpg\" id=\"banner\">";
        echo $img_tag;
    ?>
    <h1 id="board-name">User panel (<?php
      session_start();
      echo $_SESSION["username"];
    ?>)</h1>
    <hr id="header-seperator">

    <h1>Followed threads:</h1>
    <?php
      require_once "../private/display_threads.php";
      require_once "../private/db_connect.php";
      require_once "../private/get_user_id.php";

      $conn = mysqli_connect($servername, $username, $password, $dbname);

      if(!$conn)
        die("normal_user_panel was not able to connect to the database");

      $user_id = get_user_id_by_username($_SESSION["username"], $conn);

      $sql_followed_threads = "SELECT * FROM `followed_threads` WHERE `followed_threads`.`user_id`='{$user_id}'";
      $followed_threads_results = mysqli_query($conn, $sql_query_threads);

      if (mysqli_num_rows($followed_threads_results) > 0)
      {
          while($row_followed_threads = mysqli_fetch_assoc($followed_threads_results))
          {
            echo "Test";
            display_single_thread($row_followed_threads['thread_id']);
          }
      }
    ?><hr>

    <footer>
        Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
    </footer>
</body>
</html>
