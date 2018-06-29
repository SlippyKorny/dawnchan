<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Root control panel</title>
    <link rel="shortcut icon" href="../assets/img/Favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/classic_theme.css">
    <script src="../js/createNewThread.js"></script>
    <script src="../js/getBoardId.js"></script>
    <board_id style="display: none">1</board_id>
</head>
<body>
<h1 id="board-name">Root control panel</h1>
<hr id="header-seperator">
<?php
require_once "../private/display_threads.php";
for($i = 1; $i <= 6; $i++)
    display_threads($i);
?><hr>

<footer>
    Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
</footer>
</body>
</html>
