<?php
    if(empty($_SESSION['user']) OR $_SESSION['user']['role'] === '0') {
        header('Location: ?page=login');
        exit;
    }

    if(!empty($_POST)) {

        $query = vsprintf(
        "INSERT INTO songs (name, author, album, year, link)
        VALUES ('%s', '%s', '%s', '%s', '%s')", $_POST
        );

        $db->query($query);
    }

    $songs = $db->query("SELECT * FROM songs");
    $songs = $songs->fetch_all(MYSQLI_ASSOC);


?>
<div class="d-flex justify-content-between align-items-center mb-5">
    <h1 class="fs-3">Labas, <?= $_SESSION['user']['user_name'] ?>!</h1>
    <a href="?page=logout" class="btn btn-danger btn-sm">Atsijungti</a>
</div>

<?php if(!empty($songs)) : ?>
<table class="table text-white mb-5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Dainos pavadinimas</th>
            <th>Autorius</th>
            <th>Albumas</th>
            <th>Metai</th>
            <th>Nuoroda</th>
            <th>Įkėlimo data</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($songs as $song) : ?>
            <tr>
                <td><?=$song['id']?></td>
                <td><?=$song['name']?></td>
                <td><?=$song['author']?></td>
                <td><?=$song['album']?></td>
                <td><?=$song['year']?></td>
                <td><?=$song['link']?></td>
                <td><?=$song['created_at']?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>


<form method="POST">
    <div class="mb-3">
        <label>Dainos pavadinimas:</label>
        <input type="text" name="name" class="form-control" />
    </div>
    <div class="mb-3">
        <label>Dainos autorius:</label>
        <input type="text" name="author" class="form-control" />
    </div>
    <div class="mb-3">
        <label>Albumas:</label>
        <input type="text" name="album" class="form-control" />
    </div>
    <div class="mb-3">
        <label>Metai:</label>
        <input type="text" name="year" class="form-control" />
    </div>
    <div class="mb-3">
        <label>Youtube nuoroda:</label>
        <input type="text" name="link" class="form-control" />
    </div>
    <button class="btn btn-success">Pridėti dainą</button>
</form>