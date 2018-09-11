<?php

function get_board_name_by_id($conn, $id)
{
    # that's the description version
    $sql_query_boards = "SELECT * FROM `boards` WHERE `board_id`={$id}";
    $sql_query_result = mysqli_query($conn, $sql_query_boards);
    $sql_row = mysqli_fetch_assoc($sql_query_result);
    return $sql_row["board_description"];
}

function get_board_name_short_by_id($conn, $id)
{
    # that's the name version
    $sql_query_boards = "SELECT * FROM `boards` WHERE `board_id`={$id}";
    $sql_query_result = mysqli_query($conn, $sql_query_boards);
    $sql_row = mysqli_fetch_assoc($sql_query_result);
    return $sql_row["board_name"];
}

?>
