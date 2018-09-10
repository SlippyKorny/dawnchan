<!doctype HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dawnchan</title>

    <!--Favicons-->
    <link rel="shortcut icon" href="assets/img/Favicon/favicon.ico" type="image/x-icon">
<!--    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://developer.cdn.mozilla.net/static/img/favicon144.a6e4162070f4.png">-->
<!--    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://developer.cdn.mozilla.net/static/img/favicon114.0e9fabd44f85.png">-->
<!--    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://developer.cdn.mozilla.net/static/img/favicon72.8ff9d87c82a0.png">-->
<!--    <link rel="apple-touch-icon-precomposed" href="https://developer.cdn.mozilla.net/static/img/favicon57.a2490b9a2d76.png">-->

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <a href="index.php"><img src="assets/img/Main%20logo/dawn_2018.png"></a>
    <div id="boards">
        <div class="my-header">Boards</div>
        <div id="board-column-container">
        <div class="board-column">
            <u><b>Japanese Culture</b></u>
            <ul>
                <li><a href="public/a.php">Anime & Manga</a></li>
                <li><a href="public/jp.php">Otaku culture</a></li>
            </ul>
            <u><b>Video Games</b></u>
            <ul>
                <li><a href="public/v.php">Video Games</a></li>
                <li><a href="public/vp.php">Pokémon</a></li>
            </ul>
        </div>
        <div class="board-column">
            <u><b>Interests</b></u>
            <ul>
                <li><a href="public/co.php">Comics & Cartoons</a></li>
                <li><a href="public/g.php">Technology</a></li>
                <li>Television & Film</li>
                <li>Weapons</li>
                <li>Science & Math</li>
                <li>History & Humanities</li>
            </ul>
        </div>
        <div class="board-column">
            <u><b>Creative</b></u>
            <ul>
                <li>Wallpapers</li>
                <li>Photography</li>
                <li>Music</li>
            </ul>
            <u><b>Misc.</b></u><span class="nsfw">(NSFW)</span>
            <ul>
                <li>Random</li>
                <li>ROBOT9001</li>
            </ul>
        </div>
            <div style="clear: both"></div>
        </div>

    </div>

    <div style="margin-top: 300px"></div>

    <div id="recent-threads">
        <div class="my-header">Recent threads</div>
             <?php
                require_once "private/display_threads.php";
                display_recent_threads();
                global $conn;
                mysqli_close($conn);
             ?>
            <div style="clear: both"></div>
        </div>

    <div style="margin-top: 5px"></div>
    <div id="stats">
        <div class="my-header">Stats</div>
        <div class="stat"><b>Total Threads:</b> <?php
            require_once "private/get_db_data.php";
            echo get_how_many_threads();
            ?></div>
        <div class="stat"><b>Total Posts:</b> <?php
            require_once "private/get_db_data.php";
            echo get_how_many_posts();
            ?></div>
        <div class="stat"><b>Active Content:</b>
            <?php
               require_once "private/posted_size.php";
               echo echo_posted_size();
            ?>MB
        </div>
        <div style="clear: both"></div>
    </div>

    <hr>
    <div id="option-buttons">
        <a href="index.php"><button>Home</button></a>
        <a href="log_in.php"><button>Log-in</button></a>
        <a href="public/polski.html"><button>Polski</button></a>
        <div style="clear: both;"></div>
    </div>
    <br>
    <div id="links">
        <a href="https://twitter.com/PolishedSlipper">Creator's twitter</a> • <a href="admin.php">Admin Panel</a> • <a>Feedback</a> • <a>Legal</a> • <a>Contact</a>
    </div>
    <footer>
        Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
    </footer>
</body>
</html>
