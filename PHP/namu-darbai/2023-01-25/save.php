<?php 

function randomString($length = 3) {
    $string = 'abcdefghijklmnoprstquwvxyz';
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= $string[rand(0, strlen($string) - 1)];
    }

    return $result;
}

if(!is_file('./skaicius.txt')) {
    file_put_contents('./skaicius.txt', randomString());
} else {
    unlink('./skaicius.txt');
}

if(!is_file('./catch.php')) {
    file_put_contents('./catch.php', '<?php ?>');
}

?>