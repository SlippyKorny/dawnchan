<?php

    ### TODO:
    ### 1. The replies under a thread are actually ordered in ascending order - it should display the latest 5 replies
    ### 2. Make a simple parser that will look for: ', or ` or any other special characters that you can think of. ATM they cause a bug
    ### 3. Implement a way to display a single post - possible the best way to do that would be by using the get method and creating a single
    ###     php file for every kind of thread that would display unique data depending on the given variables through the get method
    ### 4. Re-write display_threads($board_no) as there is no reason for that function to have two queries. Use only one (the `posts` table one)

    ### Imports
    require_once "db_connect.php";

    ### Declerations
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    function display_threads($board_no)
    {
        //TODO: When you load a post without a picture set some default size of it and don't use an image at all
        //TODO: After you implement all of the necessary stuff for adding and displaying threads add here the option of loading a picture with the path provided by the sql query
        //TODO: Display only 5 last posts unless you go into the "reply"
        global $conn;
        if(!$conn)
            die("display_threads() connection failure: " . mysqli_connect_error() . "<br>");

        $sql_query_threads = "SELECT * FROM `threads` WHERE board_id=" . $board_no . " ORDER BY thread_id DESC";

        $threads_query_result = mysqli_query($conn, $sql_query_threads);

        if (mysqli_num_rows($threads_query_result) > 0)
        {
            while($threads_query_row = mysqli_fetch_assoc($threads_query_result))
            {
                $sql_query_posts = "SELECT * FROM `posts` WHERE thread_id=" . $threads_query_row["thread_id"];
                $posts_query_result = mysqli_query($conn, $sql_query_posts);
                $posts_query_row = mysqli_fetch_assoc($posts_query_result);


                # Write down all of the OP's data
                echo "<hr><div class='thread'>";
                echo "File: <a href='../../assets/img/posted/{$threads_query_row['image_path']}' target='_blank'><span class='file-name'>{$threads_query_row['image_original_name']}</span></a> (1.16MB, 1240x1753)<br>";
                echo "<div class='thread-content'>";
                echo "<a href='../../assets/img/posted/{$threads_query_row['image_path']}' target='_blank'><img src='../../assets/img/posted/{$threads_query_row['image_path']}'></a>";
                echo "<span class='thread-name'>{$threads_query_row['thread_name']} </span>";
                if($posts_query_row["poster_name"] == "")
                    echo "<span class='thread-poster-nickname'>Anonymous </span>";
                else
                    echo "<span class='thread-poster-nickname'>{$posts_query_row['poster_name']} </span>";

                echo date('m/d/Y(D)G:i:s', strtotime($threads_query_row['creation_date']));

                echo " <span class='thread-post-id'>No.{$posts_query_row['post_id']}</span>   <form style='display: inline-block' method='post' action='../thread.php'><input style='display: none' value='{$posts_query_row['board_id']}' name='board_id'>[<span class='thread-reply'><input name= 'thread_id' value='{$threads_query_row['thread_id']}' style='display: none'><button>Reply</button></span>]</form><br>";
                echo "<div class='thread-op-text'>{$threads_query_row['thread_description']}</div><br>";

                $counter = 0;

                while ($posts_query_row = mysqli_fetch_assoc($posts_query_result))
                {
                    echo "<div class='post'>";

                    if ($posts_query_row['poster_name'] == "")
                        echo "<span class='thread-poster-nickname'>Anonymous</span>";
                    else
                        echo "<span class='thread-poster-nickname'>{$posts_query_row['poster_name']}</span>";

                    echo " " . date('m/d/Y(D)G:i:s', strtotime($posts_query_row['creation_date'])) . " <span class='thread-post-id'>No." . (string)$posts_query_row['post_id'] . "</span><br>";

                    if ($posts_query_row['image_original_name'] != "")
                    {
                        echo "File: <a href=\"../../assets/img/posted/{$posts_query_row['image_path']}\" target=\"_blank\">{$posts_query_row['image_original_name']}</a> (56 KB, 480x550)<br>";
                        echo "<a href=\"../../assets/img/posted/{$posts_query_row['image_path']}\" target=\"_blank\"><img src=\"../../assets/img/posted/{$posts_query_row['image_path']}\"></a>";
                    }

                    echo "<div class=\"thread-text\">" . nl2br($posts_query_row['post_content'], false) . "</div>";
                    echo "<div style=\"clear: both\"></div></div></div><br>";
                    $counter++;
                }
                echo "<div style='clear: both'></div>";
            }
        }
        else
            die("display_threads() `threads` extraction failure: no threads found");
  }

  function display_single_thread($thread_id)
  {
      global $conn;
      $is_it_op = true;

      if(!$conn)
          die("display_thread() connection failure: " . mysqli_connect_error() . "<br>");

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
                  echo " " . date($posts_query_row['creation_date'], false) . " <span class='thread-post-id'>No.{$posts_query_row['post_id']}</span><br>";
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
                  echo $posts_query_row ["creation_date"];
                  echo " <span class='thread-post-id'>No.{$posts_query_row['post_id']}</span><br>";
                  echo "<div class='thread-op-text'>" . nl2br($posts_query_row['post_content']) . "</div>";
                  $is_it_op = false;
              }
          }
      }


  }

  ### Calls
  # Calls should be inside of the importing file (e.g. a/1.php)
?>
