<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Root control panel</title>
    <link rel="shortcut icon" href="../../assets/img/Favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/classic_theme.css">
    <script src="../../js/createNewThread.js"></script>
    <script src="../../js/getBoardId.js"></script>
    <board_id style="display: none">1</board_id>
    <style>
        body{
            background: linear-gradient(#b7c5d9, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff, #eef2ff);
        }

        button {
            background: #880000;
            color: white;
        }
    </style>
</head>
<body>
<a href="index.php"><img src="../../assets/img/Main logo/dawn_2018.png" style="display: block; margin-left: auto; margin-right: auto;"></a>
<h1 id="board-name">Root control panel</h1>
<?php
require_once "../display_threads.php";
for($i = 1; $i <= 6; $i++)
    display_threads_root($i);
?><hr>

<footer>
    Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
</footer>
</body>
</html>
