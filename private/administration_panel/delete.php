<?php

require_once "../db_connect.php";

function delete_thread($thread_id)
{
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "DELETE FROM `threads` WHERE thread_id={$thread_id}";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function delete_post($post_id)
{
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "DELETE FROM `posts` WHERE post_id={$post_id}";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

if ($_POST["type"] == "0")
    delete_thread($_POST["thread_id"]);
else
    delete_post($_POST["post_id"]);

header("Location: root_panel.php");
exit;


?>