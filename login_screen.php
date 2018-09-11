<!doctype HTML>
<html lang="en">
<head>
    <?php
      session_start();
      if(isset($_SESSION['username']))
        header("Location: public/normal_user_panel.php");
    ?>
    <meta charset="utf-8">
    <title>Dawnchan administration panel</title>

    <!--Favicons-->
    <link rel="shortcut icon" href="assets/img/Favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<a href="index.php"><img src="assets/img/Main%20logo/dawn_2018.png"></a>
<div id="recent-threads">
    <div class="my-header">Please enter your login credentials</div>
    <form action="private/account_validation.php" method="post">
        <h3>Username: </h3><input name="username">
        <h3>Password: </h3><input name="password" type="password"><br><br>
        <button>Log in</button><br><br>
        <a href="public/registration.php">No account?</a>
    </form>
    <div style="clear: both"></div>
</div>
<footer>
    Copyright © 2018 Dawnchan community. All rights reserved. Made by Kornel Domeradzki
</footer>
</body>
</html>
