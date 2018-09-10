<?php

    ### TODO:
    ### 1. The replies under a thread are actually ordered in ascending order - it should display the latest 5 replies
    ### 2. Make a simple parser that will look for: ', or ` or any other special characters that you can think of. ATM they cause a bug
    ### 3. Implement a way to display a single post - possible the best way to do that would be by using the get method and creating a single
    ###     php file for every kind of thread that would display unique data depending on the given variables through the get method
    ### 4. Re-write display_threads($board_no) as there is no reason for that function to have two queries. Use only one (the `posts` table one)

    ### Imports
    require_once "db_connect.php";
    require_once "get_board_name_by_id.php";

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
                echo "File: <a href='../assets/img/posted/{$threads_query_row['image_path']}' target='_blank'><span class='file-name'>{$threads_query_row['image_original_name']}</span></a> (1.16MB, 1240x1753)<br>";
                echo "<div class='thread-content'>";
                echo "<a href='../assets/img/posted/{$threads_query_row['image_path']}' target='_blank'><img src='../assets/img/posted/{$threads_query_row['image_path']}'></a>";
                echo "<span class='thread-name'>{$threads_query_row['thread_name']} </span>";
                if($posts_query_row["poster_name"] == "")
                    echo "<span class='thread-poster-nickname'>Anonymous </span>";
                else
                    echo "<span class='thread-poster-nickname'>{$posts_query_row['poster_name']} </span>";

                echo date('m/d/Y(D)G:i:s', strtotime($threads_query_row['creation_date']));

                echo " <span class='thread-post-id'>No.{$posts_query_row['post_id']}</span>   <form style='display: inline-block' method='post' action='thread.php'>"
                            . "<input style='display: none' value='{$posts_query_row['board_id']}' name='board_id'><input style='display: none' name='board_description' value='" . get_board_name_by_id($conn, $threads_query_row["board_id"])
                                . "'><input style='display: none' name='board_name' value='" . get_board_name_short_by_id($conn, $threads_query_row["board_id"]) . "'>[<span class='thread-reply'><input name= 'thread_id' value='{$threads_query_row['thread_id']}' style='display: none'><button>Reply</button></span>]</form>";
                echo "<a href=''><img src='../assets/img/follow_0.png'></a><br>"; // TODO: make the function on click add it to the following
                echo "<div class='thread-op-text'>" . nl2br($threads_query_row['thread_description'], false) . "</div><br>";

                $counter = 0;

                while ($posts_query_row = mysqli_fetch_assoc($posts_query_result))
                {
                    if (mysqli_num_rows($posts_query_result) == 1)
                    {
                        echo "<div style='clear: both'></div><br>";
                        break;
                    }

                    else
                    {
                        echo "<div class='post'>";

                        if ($posts_query_row['poster_name'] == "")
                            echo "<span class='thread-poster-nickname'>Anonymous</span>";
                        else
                            echo "<span class='thread-poster-nickname'>{$posts_query_row['poster_name']}</span>";

                        echo " " . date('m/d/Y(D)G:i:s', strtotime($posts_query_row['creation_date'])) . " <span class='thread-post-id'>No." . (string)$posts_query_row['post_id'] . "</span><br>";

                        if ($posts_query_row['image_original_name'] != "")
                        {
                            echo "File: <a href=\"../assets/img/posted/{$posts_query_row['image_path']}\" target=\"_blank\">{$posts_query_row['image_original_name']}</a> (56 KB, 480x550)<br>";
                            echo "<a href=\"../assets/img/posted/{$posts_query_row['image_path']}\" target=\"_blank\"><img src=\"../assets/img/posted/{$posts_query_row['image_path']}\"></a>";
                        }

                        echo "<div class='thread-text'>" . nl2br($posts_query_row['post_content'], false) . "</div>";
                        echo "<div style=\"clear: both\"></div></div></div><br>";
                        $counter++;
                    }
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

    function display_recent_threads()
    {
        global $conn;

        if(!$conn)
            die("display_recent_threads() connection failure: " . mysqli_connect_error() . "<br>");

        $sql_query_threads = "SELECT * FROM `threads` ORDER BY `thread_id` DESC";
        $sql_query_result = mysqli_query($conn, $sql_query_threads);
        $description = "";

        for($i = 1; $i < 10; $i++)
        {
            $sql_row = mysqli_fetch_assoc($sql_query_result);
            if ($i == 1 || $i == 4 || $i == 7)
            {
                echo "<div class='recent-threads-row'>";
            }

            echo "<div class='recent-threads-entry'>";
                echo "<b>" . get_board_name_by_id($conn, $sql_row["board_id"]) . "</b>";
                echo "<a href='" . $sql_row["image_path"] . "'><img src='assets/img/posted/" . $sql_row["image_path"] . "'></a>"; #TODO: Change the redirection to the thread
                if(strlen($sql_row["thread_description"]) > 100)
                    $description = substr($sql_row["thread_description"], 0, 90) . "(...)";
                else
                    $description = $sql_row["thread_description"];
                if ($sql_row["thread_name"] != "")
                    echo "<p><b>" . $sql_row["thread_name"] . "</b><br>" . $description . "</p>";
                else
                    echo "<p>" . $description . "</p>";
            echo "</div>";

            if ($i%3 == 0)
                echo "</div>";
        }
    }

function display_threads_root($board_no)
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

            echo " <span class='thread-post-id'>No.{$posts_query_row['post_id']}</span>   <form style='display: inline-block' method='post' action='delete.php'>"
                . "<input name= 'thread_id' value='{$threads_query_row['thread_id']}' style='display: none'><input style='display: none;' name='type' value='0'><button>X</button></span></form><br>";
            echo "<div class='thread-op-text'>" . nl2br($threads_query_row['thread_description'], false) . "</div><br>";    # TODO: Implement deleting whole threads here

            $counter = 0;

            while ($posts_query_row = mysqli_fetch_assoc($posts_query_result))
            {
                if (mysqli_num_rows($posts_query_result) == 1)
                {
                    echo "<div style='clear: both'></div><br>";
                    break;
                }

                else
                {
                    echo "<div class='post'>";

                    if ($posts_query_row['poster_name'] == "")
                        echo "<span class='thread-poster-nickname'>Anonymous</span>";
                    else
                        echo "<span class='thread-poster-nickname'>{$posts_query_row['poster_name']}</span>";

                    echo " " . date('m/d/Y(D)G:i:s', strtotime($posts_query_row['creation_date'])) . " <span class='thread-post-id'>No." . (string)$posts_query_row['post_id'] .
                            "<form method='post' action='delete.php'><input name= 'post_id' value='{$posts_query_row['post_id']}' style='display: none'><input style='display: none' name='type' value='1'><button type='submit'>X</button></form></span><br>";   #TODO: Implement deleting posts here - no thread_id

                    if ($posts_query_row['image_original_name'] != "")
                    {
                        echo "File: <a href=\"../../assets/img/posted/{$posts_query_row['image_path']}\" target=\"_blank\">{$posts_query_row['image_original_name']}</a> (56 KB, 480x550)<br>";
                        echo "<a href=\"../../assets/img/posted/{$posts_query_row['image_path']}\" target=\"_blank\"><img src=\"../../assets/img/posted/{$posts_query_row['image_path']}\"></a>";
                    }

                    echo "<div class='thread-text'>" . nl2br($posts_query_row['post_content'], false) . "</div>";
                    echo "<div style=\"clear: both\"></div></div></div><br>";
                    $counter++;
                }
            }

            echo "<div style='clear: both'></div>";
        }
    }
    else
        die("display_threads() `threads` extraction failure: no threads found");
}

  ### Calls
  # Calls should be inside of the importing file (e.g. a.php)
?>
