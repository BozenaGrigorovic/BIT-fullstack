<?php

// 2023-01-23 namų darbai
// 1 užduotis

$masyvas = array();

for($i = 0; $i < 30; $i++) {
    $masyvas[] = rand(5, 25);
}

echo '<h3>1 užduotis</h3>';

print_r($masyvas);

echo '<br/>';

// 2 užduotis

function randomAbcd() {
    $letters = 'ABCD';
    $randomString = '';
    for ($i = 0; $i < 4; $i++) {
        $randomString .= $letters[rand(0, 3)];
    }

    return $randomString;
}

$masyvas = [];

for ($i = 0; $i < 200; $i++) {
    $masyvas[] = randomAbcd();
}

echo '<h3>2 užduotis</h3>';

print_r($masyvas);

//3 užduotis

echo '<h3>3 užduotis</h3>';

// $masyvas1 = [];
// $masyvas2 = [];
// $masyvas3 = [];

$letters = 'ABCD';

for ($i = 0; $i < 200; $i++) {
    $masyvas1[] = $letters[rand(0, 3)];
}
for ($i = 0; $i < 200; $i++) {
    $masyvas2[] = $letters[rand(0, 3)];
}
for ($i = 0; $i < 200; $i++) {
    $masyvas3[] = $letters[rand(0, 3)];
}
for ($i = 0; $i < 200; $i++) {
    $masyvasSudetas[] = $masyvas1[$i] . $masyvas2[$i] . $masyvas3[$i];
}

print_r($masyvasSudetas);




//4 užduotis

echo '<h3>4 užduotis</h3>';

$size = 100;
$result = '';

for ($i = 0; $i <= $size; $i++) {
    for($x = 0; $x <= $size; $x++) {
        if ($x === $i || $x === ($size - $i)) {
            $result .= '<span style="color: red;">*</span>';
        } else{
            $result .= '*';
        }}
        $result .= '</br>';
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .square {
            line-height: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="square"><?= $result ?></div>    
</body>
</html>





