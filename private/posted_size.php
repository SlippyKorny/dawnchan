<?php

function linux_posted_size()
{
    $f = './assets/img/posted/';
    $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
    $size = fgets ( $io, 4096);
    $size = substr ( $size, 0, strpos ( $size, "\t" ) );
    pclose ( $io );
    return $size;
}

function windows_posted_size()
{
    $f = 'C:/xampp/htdocs/dawnchan/assets/img/posted';
    $obj = new COM ( 'scripting.filesystemobject' );

    if ( is_object ( $obj ) )
    {
        $ref = $obj->getfolder ( $f );
        return $ref->size;
        $obj = null;
    }
    else
    {
        echo 'can not create object';
        return null;
    }
}

?>