<?php
    if(!empty($_POST)) {

        $data['users'] = [];

        if(file_exists('./database.json')) {
        $data = json_decode(file_get_contents('./database.json'), true);
        };

        $params = [
            'page' => 'register',
            'message' => 'Toks vartotojo ID jau egzistuoja',
            'status' => 'danger'
        ];

        $emailExists = array_filter($data['users'], function($user) {
            if($user['email'] === $_POST['email']) return true;

            return false;
        });

        if(!empty($emailExists)) {
            $params['message'] = 'Toks vartotojo el. paštas yra užregistruotas';
        }

        if(isset($data['users'][$_POST['id']]) OR !empty($emailExists)) {
            header('Location: ?'. http_build_query($params));
            exit;
        }

        $_POST['created_at'] = date('Y-m-d h:i:s');
        $_POST['password'] = md5($_POST['password']);

        $data['users'][$_POST['id']] = $_POST;

        file_put_contents('./database.json', json_encode($data));

        $params = [
            'page' => 'login',
            'message' => 'Registracija sėkminga',
            'status' => 'success'
        ];

        header('Location: ?' . http_build_query($params));
    }
?>


<h1 class="mb-3" style="font-size:25px;">Registracija</h1>

<form method="POST">
    <div class="mb-3">
        <label>Vatotojo ID</label>
        <input type="text" name="id" placeholder="@" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>El. pašto adresas</label>
        <input type="email" name="email" placeholder="pavyzdys@pavyzdys.lt" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Slaptažodis</label>
        <input type="password" name="password" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Vardas</label>
        <input type="text" name="first_name" placeholder="Vardenis" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Pavardė</label>
        <input type="text" name="last_name" placeholder="Pavardenis" class="form-control" required />
    </div>
    <button class="btn btn-info">Registruotis</button>
</form>