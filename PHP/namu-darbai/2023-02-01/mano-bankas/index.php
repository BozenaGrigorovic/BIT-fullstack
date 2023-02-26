<?php 
session_start();
$APP = [];
$APP['_ROOT_'] = '/BIT-fullstack/PHP/namu-darbai/2023-02-01/mano-bankas/';
$APP['data'] = json_decode(file_get_contents('database.json'));

// print_r($_SESSION);

include('./app/functions.php');
include ('./app/router.php');