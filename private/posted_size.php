<?php

function echo_posted_size()
{
    $file_reader = fopen("assets/dirSize", "r");
    echo fgets($file_reader);
    fclose($file_reader);
}

?>