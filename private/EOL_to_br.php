<?php
    function EOL_to_br($string) {
        $new_string = "";
        $i = 0;
        $string_length = strlen($string);

        while ($i < $string_length)
        {
            if ($string{$i} != '\r' || $string{$i} != '\n')
                $new_string = $new_string . $string{$i};

            else if ($string{$i} == '\n')
                $new_string = $new_string . "<br>";

            $i++;
        }

        return $new_string;
    }
?>