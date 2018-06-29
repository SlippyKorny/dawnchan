<?php

require_once "db_connect.php";

function check_credentials($user_username, $user_password)
{
    global $servername, $username, $password, $dbname;
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql_query = "SELECT * FROM `registered_users` WHERE username='{$user_username}' AND password='{$user_password}'";
    $query_result = mysqli_query($conn, $sql_query);

    if (mysqli_num_rows($query_result) > 0)
    {
        echo "<h1>Something</h1>";
        $row = mysqli_fetch_assoc($query_result);
        mysqli_close($conn);
        if ($row["account_type"] == 0)  // Root - All rights
        {
            header("administration_panel/root_panel.php");
            exit;
        }
        else if ($row["account_type"] == 1) // Administrator - Almost all rights
        {
            header("administration_panel/admin.php");
            exit;
        }
        else if ($row["account_type == 2"]) // Moderator - Can edit only one board
        {
            header("administration_panel/mod.php");
            exit;
        }
    }

    else
    {
        mysqli_close($conn);
        header("login_error.html");
        exit;
    }
}

check_credentials($_POST['username'], $_POST['password']);


?>