<?php

  ### TODO:
  ###   - Get the board name
  ###   - Get the thread name
  ###   - Get the thread description (That's the op's message/text)
  ###   - Save the image and get the image path after giving it a random name
  ###   - Get the image's original name

  echo "I am working!";

  ### IMPORTS
  require_once "db_connect.php";
  require_once "get_board_id.php";

  ### Declerations
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  function get_extension($original_file_name)
  {
    for ($i = 0; $i < strlen($original_file_name); $i++)
    {
        if ($original_file_name{$i} == '.')
            return substr($original_file_name, $i, strlen($original_file_name)-1);
    }
  }

  function get_image_no()
  {
      $fileReader = fopen("../assets/data", "r") or die ("Unable to open the file");
      $lastimageNo = fgets($fileReader);
      $lastimageNo = intval($lastimageNo);
      $lastimageNo++;
      fclose($fileReader);

      $fileWriter = fopen("../assets/data", "w+") or die ("Unable to open the file");
      fwrite($fileWriter, $lastimageNo);
      return $lastimageNo;
  }

  function get_last_thread_id()
  {
      global $conn;

      if(!$conn)
          die("get_last_thread_id() connection failure: " . mysqli_connect_error());

      $sql = "SELECT * FROM `threads` ORDER BY thread_id DESC";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0)
      {
          $row = mysqli_fetch_assoc($result);
          return $row["thread_id"];
      }
      else
        die("<b>get_last_thread_id() failure:</b> no results found. Returning null... This may result in fatal errors...");
  }

  function create_thread($board_name, $thread_name, $poster_name, $thread_description, $image_original_name)
  {
    global $conn;
    $board_id = get_board_id($board_name, $conn);
    echo "<b>Board id:</b> " . $board_id . "<br>";
    $image_path = get_image_no() . get_extension($image_original_name);

    if (!$conn)
      die("create_thread() connection failure: " . mysqli_connect_error());

    $sql = "INSERT INTO `threads` (`thread_id`, `board_id`, `creation_date`, `thread_name`, `thread_description`, `image_path`, `image_original_name`) VALUES (NULL, '{$board_id}', CURRENT_TIMESTAMP, '{$thread_name}', '{$thread_description}', '{$image_path}', '{$image_original_name}')";

    # Add to `threads`
    if(mysqli_query($conn, $sql))
      echo "<h1>Success</h1>";
    else
      echo "<br><b>create_thread() mysqli_query() threads table failure:</b> " . mysqli_error($conn) . "<br><b>SQL:</b> " . $sql . "<br><br><br>";

    # SQL querry for adding to the `posts` table and get the thread_id
    # TODO: I've added here a thread_id reference but there is yet no function that gets the thread_id that has been created in the previous SQL query.
    #       take care of that when you'll have some free time
    $thread_id = get_last_thread_id();
    $sql = "INSERT INTO `posts` (`post_id`, `thread_id`, `board_id`, `creation_date`, `poster_name`, `post_content`, `image_path`, `image_original_name`) VALUES (NULL, '{$thread_id}', '{$board_id}', CURRENT_TIMESTAMP, '{$poster_name}', '{$thread_description}', '{$image_path}', '{$image_original_name}')";

    # Add OP to `posts`
    if(mysqli_query($conn, $sql))
      echo "<h1>Success</h1>";
    else
      echo "<b>create_thread() mysqli_query() posts table failure:</b> " . mysqli_error($conn) . "<br><b>SQL:</b> " . $sql . "<br><br><br>";
  }

  ### CALLS
  create_thread("Anime & Manga" ,$_POST["subject"], $_POST["name"], $_POST["comment"], $_POST["file"]);
  mysqli_close($conn);
?>
