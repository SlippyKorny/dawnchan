<?php

    ###############
    ### Imports ###
    ###############
    require_once "db_connect.php";
    require_once "added_images_manipulation.php";

    ####################
    ### Declarations ###
    ####################
    function get_thread_id_by_post_id($post_id, $conn)
    {
        $sql = "SELECT * FROM `posts` WHERE post_id=" . $post_id;
        $query_results = mysqli_query($conn, $sql);
        $query_row = mysqli_fetch_assoc($query_results);
        return $query_row['thread_id'];
    }

    function add_post($thread_id, $board_id, $poster_name, $post_content, $image_original_name, $file)
    {
        global $servername, $username, $password, $dbname;
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($image_original_name != "")
        {
            $image_path = get_image_no() . get_extension($image_original_name);
            save_file($file, "../assets/img/posted/" . $image_path );
        }
        else
            $image_path = "";

        if(!$conn)
            die("add_reply() connection failure: " . mysqli_connect_error());

        echo "Before: <b>" . $thread_id . ";" . $board_id . ";" . $poster_name . ";" . $post_content . ";" . $image_path . ";" . $image_original_name . "</b><br>";


        $poster_name = addslashes($poster_name);
        $post_content = addslashes($post_content);
        $thread_id = intval($thread_id);
        $thread_id = get_thread_id_by_post_id($thread_id, $conn);
        $board_id = intval($board_id);

        echo "After: <b>" . $thread_id . ";" . $board_id . ";" . $poster_name . ";" . $post_content . ";" . $image_path . ";" . $image_original_name . "</b><br>";

        $sql = "INSERT INTO `posts` (`post_id`, `thread_id`, `board_id`, `creation_date`, `poster_name`, `post_content`, `image_path`, `image_original_name`) VALUES (NULL, '{$thread_id}', '{$board_id}', CURRENT_TIMESTAMP, '{$poster_name}', '{$post_content}', '{$image_path}', '{$image_original_name}')";
        if(mysqli_query($conn, $sql))
            echo "<h1>Success</h1>";
        else
            echo die("add_reply() query failure: " . mysqli_error($conn));
        mysqli_close($conn);
        // TODO: Przekierowanie
    }

    #############
    ### Calls ###
    #############
    add_post($_POST["thread_id"], $_POST["board_id"], $_POST["poster_name"], $_POST["post_content"], $_FILES["image_original_name"]["name"], $_FILES["image_original_name"]);

?>
