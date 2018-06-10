<?php

    ### Imports
    require_once "db_connect.php";

    ### Declarations
    function add_post($thread_id, $board_id, $poster_name, $post_content, $image_path, $image_original_name)
    {
        global $servername, $username, $password, $dbname;
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if(!$conn)
            die("add_reply() connection failure: " . mysqli_connect_error());

        $sql = "INSERT INTO `posts` (`post_id`, `thread_id`, `board_id`, `creation_date`, `poster_name`, `post_content`, `image_path`, `image_original_name`) VALUES (NULL, '$thread_id', '$board_id', CURRENT_TIMESTAMP, '$poster_name', '$post_content', '$image_path', '$image_original_name')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        // TODO: Przekierowanie
    }

    ### Calls
    # TODO: Find out a way how to get the board_id and thread_id and then implement it
?>
