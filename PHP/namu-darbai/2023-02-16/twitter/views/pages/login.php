<?php 
    if(!empty($_POST)) {

        $params = [
            'page' => 'login',
            'message' => 'Duomenų bazės failas nerastas',
            'status' => 'danger'
        ];


        if(!file_exists('./database.json')) {
            header('Location: ?' . http_build_query($params));
            exit;
        }
    

    $data = json_decode(file_get_contents('./database.json'), true);

    $userExists = array_filter($data['users'], function($user) {
        if($user['id'] === $_POST['id'] AND $user['password'] === md5($_POST['password']))
        return true;

        return false;
    });

    if(empty($userExists)) {
        $params['message'] = 'Neteisingi prisijungimo duomenys';
        header('Location: ?' . http_build_query($params));
        exit;
    }

    $_SESSION['user'] = $userExists[array_key_first($userExists)];

    header('Location: ?page=/');
}


?>


<h1 class="mb-3" style="font-size:25px;">Prisijungimo puslapis</h1>

<form method="POST">
    <div class="mb-3">
        <label>Vatotojo ID</label>
        <input type="text" name="id" placeholder="@" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Slaptažodis</label>
        <input type="password" name="password" class="form-control" required />
    </div>
    <button class="btn btn-info">Prisijungti</button>
</form>