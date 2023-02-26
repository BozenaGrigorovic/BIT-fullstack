<?php 

    // print_r($_SESSION['user']);
    // exit;

    if(!empty($_SESSION['user'])) {
        if($_SESSION['user']['role'] === '1') {
            header('Location: ?page=admin');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    }

    if(!empty($_POST)) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $user = $db->query("SELECT id, user_name, role FROM users WHERE email = '{$email}' and password = '{$password}' ");
        // print_r($user->num_rows); - rodo kiek surado eiluciu duomenu bazeje
        $params = [
            'page' => 'login',
            'message' => 'Toks vartotojas nerastas',
            'status' => 'danger'
        ];

        if($user->num_rows === 0) {
            header('Location: ?' . http_build_query($params));
            exit;
        }

        $user = $user->fetch_array(MYSQLI_ASSOC);
        // print_r($user);
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['role'] = $user['role'];
        $_SESSION['user']['user_name'] = $user['user_name'];

        header('Location: index.php');
        exit;
    }
?>



<?php if(isset($_GET['message'])) : ?>
    <div class="alert alert-<?=$_GET['status']?>">
        <?=$_GET['message']?>
    </div>
<?php endif; ?>
<h1 class="text-white text-center my-5 fs-2">Prisijungti</h1>
<form method="POST" class="col-4 mx-auto text-center">
    <div class="mb-3">
        <label>El. pašto adresas</label>
        <input type="email" name="email" placeholder="pavyzdys@pavyzdys.lt" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Slaptažodis</label>
        <input type="password" name="password" class="form-control" required />
    </div>
    <button class="btn btn-success mb-5">Prisijungti</button>
</form>
<div class="text-center mx-auto fs-6">
    <a href="?page=register" class="text-white">Registruotis</a>
</div>