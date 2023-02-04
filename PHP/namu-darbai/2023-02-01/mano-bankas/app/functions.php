<?php

function getErrorMessage($key) {
    if (isset($_SESSION['error_'.$key])) {
        $msg = $_SESSION['error_'.$key];
        unset($_SESSION['error_'.$key]);
        return $msg;
    }
    return '';
}

function setLoggedIn($id) {
    $_SESSION['logged'] = true;
    $_SESSION['id'] = $id; 
}

function checkLogin($request, $data) {
    if(isset($request['id']) and $request['id'] != '') {
        foreach ($data as $user) {
            if($request['id'] == $user['id'] and $request['password'] == $user['password']) {
                setLoggedIn($user['id']);
                return true;
            } else {
                $_SESSION['error_login'] = 'wrong username or password';
                return false;
            }
        } 
    } 
}

function logout(){
    unset($_SESSION['logged']);
    unset($_SESSION['id']);
}

function redirectIfNotLoggedIn(){
    if( !isset($_SESSION['logged'])){
        header('Location: '.$APP['_ROOT_'].'index.php');
    }
}



