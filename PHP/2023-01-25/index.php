<?php
    echo '<h1>Labas Pasauli</h1>';
    $kintamasis = '<h2>Tai yra kintamojo reiksme</h2>';
    echo $kintamasis;
    $kintamasis = 10;
    echo '<h3>' . $kintamasis . '</h3>';
    //Inkrementas
    $kintamasis++;
    echo '<h3>' . $kintamasis . '</h3>';
    //Dekrementas
    $kintamasis--;
    echo '<h3>' . $kintamasis . '</h3>';
    //Sudetis
    $kintamasis += 10;
    echo '<h3>' . $kintamasis . '</h3>';
    //Atimtis
    $kintamasis -= 3;
    echo '<h3>' . $kintamasis . '</h3>';


    //Masyvai

    $masyvas = array('raktinis_zodis' => 'jo reiksme'); //Klasikinis aprasymas


    //Masyvo atvaizdavimas

    print_r($masyvas);

    echo '<br />';

    var_dump($masyvas);


    $masyvas = array(15, 20, 14, 8, 96, 87);

    echo '<br />';

    var_dump($masyvas);

    $masyvas = [15.89, 4.56, 5, 8, 5.15];

    echo '<br />';

    var_dump($masyvas);

    $masyvas = [1 => 15.89, 3 => 4.56, 5 => 5, 8 => 8, 96 => 5.15];

    echo '<br />';

    var_dump($masyvas);

    echo '<br />';

    //Atskitos reiksmes paemimas

    echo $masyvas[96];

    // reiksmes pasalinimas

    unset($masyvas[96]);

    echo '<br />';

    var_dump($masyvas);

    //reiksmes pakeitimas

    $masyvas[3] = 'pakeista reiksme';

    echo '<br />';

    var_dump($masyvas);


    //Naujos reiksmes pridejimas

    $masyvas[] = 'tai nauja prideta reiksme';

    echo '<br />';

    var_dump($masyvas);

    $masyvas['raktazodis'] = 'tai nauja prideta reiksme su raktazodziu';

    echo '<br />';

    var_dump($masyvas);


    //ciklai

    for($i = 0; $i < 100; $i++) {
        echo $i . 'cikle aprasyta eilute ir sugeneruotas skaicius ' . rand(100, 999) . ' <br />';
    }








?>