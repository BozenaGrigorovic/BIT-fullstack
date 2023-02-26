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
        $exists = false;
        foreach ($data as $user) {
                // echo gettype($request['id']);
                // echo gettype($request['password']);
            if($user->id == $request['id'] AND 
            $user->password == $request['password']) {
                setLoggedIn($user);
                $exists = true;
            }
        }
        if (!$exists) {
            $_SESSION['error_login'] = 'wrong username or password';
        } 
        return $exists;
    } 
}


function logout(){
    unset($_SESSION['logged']);
    unset($_SESSION['id']);
}

function redirectIfNotLoggedIn($type = null){
    global $APP;

    if (isset($_SESSION['logged'])) {
        if ($type == 'admin' && $_SESSION['id']->role != 1) {
            header('Location: '.$APP['_ROOT_'].'index.php');
        } else if ($type == 'user' && $_SESSION['id']->role != 0){
            header('Location: '.$APP['_ROOT_'].'index.php');
        }
    } else {
        header('Location: '.$APP['_ROOT_'].'index.php');
    }
}
function redirectIfLoggedIn(){
    if (!isset($_SESSION['id'])) {
        return;
    }
    if ($_SESSION['id']->role == 1) {
        header('Location: '.$APP['_ROOT_'].'index.php?page=admin');
    } else if ($_SESSION['id']->role == 0){
        header('Location: '.$APP['_ROOT_'].'index.php?page=user');
    }
}


function deleteUser($data, $id){
    unset($data[$id]);
    file_put_contents('database.json', json_encode(array_values($data)));
    header('Location: ?page=admin');
    exit;

}





