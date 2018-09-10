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
        <h1>Put nav from kwasior over here!</h1>
        <div style="clear: both"></div>
    </nav><br>
    <?php
        $banner_number = rand(1, 3);
        $img_tag = "<img src=\"../assets/img/Banners/" . $banner_number . ".jpg\" id=\"banner\">";
        echo $img_tag;
    ?>
    <h1 id="board-name">User panel (<?php
      session_start();
      echo $_SESSION["username"];
    ?>)</h1>
    <hr id="header-seperator">

    <h1>Followed threads:</h1>
    <?php
      // require_once "../private/display_threads.php";

      // display_threads(1);

    ?><hr>

    <footer>
        Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
    </footer>
</body>
</html>
