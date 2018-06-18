<?php
function get_extension($original_file_name)
{
    for ($i = 0; $i < strlen($original_file_name); $i++)
    {
        if ($original_file_name{$i} == '.')
            return substr($original_file_name, $i, strlen($original_file_name)-1);
    }
}

function get_image_no()
{
    $fileReader = fopen("../assets/data", "r") or die ("Unable to open the file");
    $lastimageNo = fgets($fileReader);
    $lastimageNo = intval($lastimageNo);
    $lastimageNo++;
    fclose($fileReader);

    $fileWriter = fopen("../assets/data", "w+") or die ("Unable to open the file");
    fwrite($fileWriter, $lastimageNo);
    return $lastimageNo;
}
?>