<?php 

redirectIfNotLoggedIn('admin');

$action = isset($_GET['action']) ? $_GET['action'] : '';


if(isset($_SESSION['id']) and $_SESSION['id']->role == 0 ){
    header('Location: '.$APP['_ROOT_'].'index.php?page=user');
}

if($action == 'new_user') {
     if(count($_POST) != 0) {
        $APP['data'][] = $_POST;
        file_put_contents('database.json', json_encode($APP['data']));
        header('Location: '.$APP['_ROOT_'].'index.php?page=admin');
        exit;
}
}

if($action == 'delete') {
    deleteUser($APP['data'], $_GET['id']);
    exit;
}

if($action == 'edit') {
    if(count($_POST) != 0) {
       $APP['data'][$_GET['id']] = $_POST;
       file_put_contents('database.json', json_encode($APP['data']));
       header('Location: '.$APP['_ROOT_'].'index.php?page=admin');
       exit;
}
}



?>
<div class="d-flex justify-content-between align-items-center">
    <h1>Admino puslapis</h1>
    <div>
        <a href="?page=admin&action=new_user" class="btn btn-info">Pridėti vartotoją</a>
        <a href="?page=logout" class="btn btn-light">Atsijungti</a>
    </div>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Sąskaitos numeris</th>
                <th>Likutis</th>
                <th>Tipas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($APP['data'] as $index => $user): ?>
                <tr>
                    <td><?=$user->id?></td>
                    <td><?=$user->name?></td>
                    <td><?=$user->last_name?></td>
                    <td><?=$user->iban?></td>
                    <td style="text-align:right;"><?= $user->balance == '' ? '-' : $user->balance.' €';?></td>
                    <td><?php if ($user->role == 1) {echo 'Administratorius';} else {echo 'Klientas';} ?></td>
                    <td><a href="?page=admin&id=<?=$index?>&action=delete" class="btn btn-danger">Pašalinti</a>
                    <a href="?page=admin&id=<?=$index?>&action=edit" class="btn btn-warning">Redaguoti</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if(isset($_GET['action']) and $_GET['action'] == 'new_user'): ?>
    <div style="margin-top:100px;">
        <h4>Pridėti naują vartotoją</h4>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Vartotojo ID</label>
                <input type="text" name="id" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Slaptažodis</label>
                <input type="text" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Vardas</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Pavardė</label>
                <input type="text" name="last_name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Sąskaitos numeris</label>
                <input type="text" name="iban" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Balansas</label>
                <input type="number" step="0.01" name="balance" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Vartotojo teisės</label>
                <select name="role" class="form-control">
                    <option value="0">Klientas</option>
                    <option value="1">Administratorius</option>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-info">Pridėti</button>
            </div>
        </form>
        <?php endif; ?>

        <?php if (isset($_GET['action']) and $_GET['action'] == 'edit') : ?>
            <h4>Redaguoti vartotoją</h4>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Vartotojo ID</label>
                <input type="text" name="id" class="form-control" value="<?=$APP['data'][$_GET['id']]->id ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Slaptažodis</label>
                <input type="text" name="password" class="form-control" value="<?=$APP['data'][$_GET['id']]->password ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Vardas</label>
                <input type="text" name="name" class="form-control" value="<?=$APP['data'][$_GET['id']]->name ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Pavardė</label>
                <input type="text" name="last_name" class="form-control" value="<?=$APP['data'][$_GET['id']]->last_name ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Sąskaitos numeris</label>
                <input type="text" name="iban" class="form-control" value="<?=$APP['data'][$_GET['id']]->iban ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Balansas</label>
                <input type="number" step="0.01" name="balance" class="form-control" value="<?=$APP['data'][$_GET['id']]->balance ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Vartotojo teisės</label>
                <select name="role" class="form-control" value="<?=$APP['data'][$_GET['id']]->role ?>">
                    <option value="0">Klientas</option>
                    <option value="1">Administratorius</option>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-warning">Išsaugoti</button>
            </div>
        </form>        
            
        <?php endif ; ?>
    </div>