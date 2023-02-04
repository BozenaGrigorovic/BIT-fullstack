<?php 

    function randomString($length = 3) {
        $string = 'abcdefghijklmnoprstquwvxyz';
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $string[rand(0, strlen($string) - 1)];
        }

        return $result;
    }

    function randomStringCompare() {
        $string1 = randomString();
        $string2 = file_get_contents('./skaicius.txt');
        $counter = 0;
        while($string1 != $string2) {
            echo $string1 . ' / ' . $string2 . '<br />';
            $string1 = randomString();
            ++$counter;
        } 
        echo 'Operations count: ' . $counter . '<br / >Equal strings found :' . $string1 . '/' . $string2;
    }

    echo randomStringCompare();
?>