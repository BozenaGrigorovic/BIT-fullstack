<?php 
session_start();
$APP = [];
$APP['_ROOT_'] = '/BIT-fullstack/PHP/namu-darbai/2023-02-01/mano-bankas/';

// print_r($_SESSION);

include('./app/data.php');
include('./app/functions.php');
include ('./app/router.php');