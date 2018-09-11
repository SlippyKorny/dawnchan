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
      if (isset($_SESSION["username"]))
        echo "[Logged in as: <a href=''>" . $_SESSION["username"] . "</a>]";
      else
        header("Location: ../index.php");
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
      echo $_SESSION["username"];
    ?>)</h1>
    <hr id="header-seperator">

    <h1>Followed threads:</h1>
    <?php
      // require_once "../private/display_threads.php";
      require_once "../private/db_connect.php";
      require_once "../private/get_user_id.php";

      // global $conn;
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      function display_single_thread($thread_id)
      {
        global $conn;
        $is_it_op = true;

        if(!$conn)
            die("display_thread(\$thread_id) connection failure: " . mysqli_connect_error() . "<br>");

        $sql_query_posts = "SELECT * FROM `posts` WHERE thread_id=" . $thread_id . " ORDER BY post_id ASC";


        $posts_query_result = mysqli_query($conn, $sql_query_posts);

        if(mysqli_num_rows($posts_query_result) > 0)
        {
            while($posts_query_row = mysqli_fetch_assoc($posts_query_result))
            {
                if(!$is_it_op)
                {
                    echo "<div class='post'>";
                    if ($posts_query_row ['poster_name'] == "")
                        echo "<span class='thread-poster-nickname'>Anonymous</span>";
                    else
                        echo "<span class='thread-poster-nickname'>{$posts_query_row['poster_name']}</span>";
                    echo " " . date('m/d/Y(D)G:i:s', strtotime($posts_query_row['creation_date'])) . " <span class='thread-post-id'>No.{$posts_query_row['post_id']}</span><br>";
                    if ($posts_query_row['image_path'] != "")
                    {
                        echo "File: <a href='../assets/img/posted/{$posts_query_row['image_path']}' target='_blank'>{$posts_query_row['image_original_name']}</a> (56 KB, 480x550)<br>";
                        echo "<a href='../assets/img/posted/{$posts_query_row['image_path']}' target='_blank'><img src='../assets/img/posted/{$posts_query_row['image_path']}'></a>";
                    }

                    echo "<div class='thread-text'>" . nl2br($posts_query_row['post_content'], false) . "</div>";
                    echo "<div style='clear: both'></div></div></div><br>";
                }

                else
                {
                    $sql_query_threads = "SELECT * FROM `threads` WHERE thread_id=" . $posts_query_row["thread_id"];
                    $threads_query_result = mysqli_query($conn, $sql_query_threads);
                    $threads_query_row = mysqli_fetch_assoc($threads_query_result);


                    echo "<hr><div class='thread'>";
                    echo "File: <a href='../assets/img/posted/{$threads_query_row['image_path']}' target='_blank'><span class='file-name'>{$posts_query_row['image_original_name']}</span></a> (1.16MB, 1240x1753)<br>";
                    echo "<div class='thread-content'>";
                    echo "<a href='../assets/img/posted/{$threads_query_row['image_path']}' target='_blank'><img src='../assets/img/posted/{$threads_query_row['image_path']}'></a>";
                    echo "<span class='thread-name'>{$threads_query_row['thread_name']} </span>";
                    if($posts_query_row["poster_name"] == "")
                        echo "<span class='thread-poster-nickname'>Anonymous </span>";
                    else
                        echo "<span class='thread-poster-nickname'>{$posts_query_row['poster_name']} </span>";
                    echo date('m/d/Y(D)G:i:s', strtotime($posts_query_row['creation_date']));
                    echo " <span class='thread-post-id'>No.{$posts_query_row['post_id']}</span><br>";
                    echo "<div class='thread-op-text'>" . nl2br($posts_query_row['post_content']) . "</div>";
                    $is_it_op = false;
                }
            }
            echo "<div style='clear: both'></div>";
        }
      }

      if(!$conn)
        die("normal_user_panel was not able to connect to the database");

      $user_id = get_user_id_by_username($_SESSION["username"], $conn);

      $sql_followed_threads = "SELECT * FROM followed_threads WHERE user_id={$user_id}";
      // $sql_followed_threads = "SELECT COUNT(*) FROM followed_threads";
      $followed_threads_results = mysqli_query($conn, $sql_followed_threads);
      // $row_followed_threads = mysqli_fetch_assoc($followed_threads_results);

      if (mysqli_num_rows($followed_threads_results) > 0)
      {
        while($row_followed_threads = mysqli_fetch_assoc($followed_threads_results))
          display_single_thread($row_followed_threads['thread_id']);
      }

      mysqli_close($conn);
    ?><hr>

    <footer>
        Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
    </footer>
</body>
</html>
