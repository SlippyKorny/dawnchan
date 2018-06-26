<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>/jp/ - Otaku Culture - Dawnchan</title>
    <link rel="shortcut icon" href="../assets/img/Favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/classic_theme.css">
    <script src="../js/createNewThread.js"></script>
    <script src="../js/getBoardId.js"></script>
    <board_id style="display: none">2</board_id>
</head>
<body>
<nav>
    <div id="boards">
        [a / b / c / d / e / f / g / gif / h / hr / k / m / o / p / r / s / t / u / v / vg / vr / w / wg] [i / ic] [r9k / s4s / vip / qa] [cm / hm / lgbt / y] [3 / aco / adv / an / asp / bant / biz / cgl / ck / co / diy / fa / fit / gd / hc / his / int / jp / lit / mlp / mu / n / news / out / po / pol / qst / sci / soc / sp / tg / toy / trv / tv / vp / wsg / wsr / x]
    </div>
    <div id="misc">
        [Settings]
        [Search]
        [<a href="../../index.php">Home</a>]
    </div>
    <div style="clear: both"></div>
</nav><br>
<?php
$banner_number = rand(1, 3);
$img_tag = "<img src=\"../assets/img/Banners/" . $banner_number . ".jpg\" id=\"banner\">";
echo $img_tag;
?>
<h1 id="board-name">/jp/ - Otaku Culture</h1>
<hr id="header-seperator">
<div id="newThread-container"><form id="newThread-form" action="../private/add_thread.php" method="post" enctype="multipart/form-data">
        <?php
            require_once "../private/get_board_name_by_id.php";
            require_once "../private/db_connect.php";

            global $servername, $username, $password, $dbname;
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            echo "<input style='display: none' value='" . get_board_name_by_id($conn, 2) . "' name='board_name'>";
        ?>
    </form></div>
<h2>[<span id="newThread" onclick="createNewThread(getBoardId())">Start a New Thread</span>]</h2>
<div id="news">
    14/05/18 Started work on /a/<br>
    11/05/18 Created the polski page<br>
    10/05/18 Created the homepage of dawnchan<br>
    <div id="news-menu">[<span class="news-menu-option">Hide</span>] [<span class="news-menu-option">Show All</span>]</div>
</div>
<hr>
<form>
    <input value="Search OPs..."> [<span class="search-area">Catalog</span>] [<span class="search-area">Archive</span>]
</form>

<?php
require_once "../private/display_threads.php";

display_threads(2);

?><hr>

<footer>
    Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
</footer>
</body>
</html>
