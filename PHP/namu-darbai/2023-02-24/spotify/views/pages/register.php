<?php

if(!empty($_POST)) {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $params = [
        'page' => 'login',
        'message' => 'Vartotojas sėkmingai sukurtas',
        'status' => 'success'
    ];

    if($db->query("INSERT INTO users (user_name, email, password) VALUES ('{$user_name}', '{$email}', '{$password}')")) {
        
        header('Location: ?' . http_build_query($params));
    }
}

?>

<?php if(isset($_GET['message'])) : ?>
    <div class="alert alert-<?=$_GET['status']?>">
        <?=$_GET['message']?>
    </div>
<?php endif; ?>
<h1 class="text-white text-center my-5 fs-2">Registracija</h1>
<form method="POST" class="col-4 mx-auto text-center">
    <div class="mb-3">
        <label>Vartotojo vardas:</label>
        <input type="text" name="user_name" placeholder="@" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>El. pašto adresas</label>
        <input type="email" name="email" placeholder="pavyzdys@pavyzdys.lt" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Slaptažodis</label>
        <input type="password" name="password" class="form-control" required />
    </div>
    <button class="btn btn-success mb-5">Registruotis</button>
</form>