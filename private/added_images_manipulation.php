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

function save_file($file, $image_path)
{
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    echo "tmp: " . $file_tmp_name ;
    echo "size: " . $file_size;

    if($file_error === 0)
    {
        if ($file_size < 20971520)
        {
            move_uploaded_file($file_tmp_name, $image_path);
            echo "success!";
        }
        else
            die("Your file is too big! (Max. 20MB)");
    }
    else
        die("There was an error uploading your file!");
}
?>