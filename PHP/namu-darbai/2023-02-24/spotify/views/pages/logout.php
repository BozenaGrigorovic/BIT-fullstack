<?php 
//  unset($_SESSION['user']['id']);
//  unset($_SESSION['user']['user_name']);
//  unset($_SESSION['user']['role']);

    session_destroy();

    header('Location: ?page=login');
?>