<?php

require_once "db_connect.php";

function get_how_many_threads()
{
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql_query = "SELECT * FROM `threads` ORDER BY `thread_id` DESC";
    $query_result = mysqli_query($conn, $sql_query);
    $row = mysqli_fetch_assoc($query_result);
    return $row["thread_id"];
}

function get_how_many_posts()
{
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql_query = "SELECT * FROM `posts` ORDER BY `post_id` DESC";
    $query_result = mysqli_query($conn, $sql_query);
    $row = mysqli_fetch_assoc($query_result);
    return $row["post_id"];
}

?>