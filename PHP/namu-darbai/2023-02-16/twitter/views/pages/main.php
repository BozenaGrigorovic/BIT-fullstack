<?php 
    if(!isset($_SESSION['user'])) {
        header('Location: ?page=login');
        exit;
    }

    $data = json_decode(file_get_contents('./database.json'), true);

    $tweets = $data['tweets'];

    $order = isset($_GET['order']) ? $_GET['order'] : 'asc';    

    if($order === 'desc') {
        usort($tweets, function($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($b < $a) ? -1 : 1;
        });
    }


    if(!empty($_POST)) {
        $data['tweets'][] = [
            'message' => $_POST['tweet'],
            'created_at' => date('Y-m-d h:i:s'),
            'author' => $_SESSION['user']['id']
        ];


        // print_r($_FILES);

        if(!empty($_FILES['tweet-photo']['tmp_name'])) {
            if(!is_dir('./uploads')) {
                mkdir('./uploads');
            }

            $filename = explode('.', $_FILES['tweet-photo']['name']);
            $filename = time() . '.' . $filename[count($filename) - 1];

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!in_array($_FILES['tweet-photo']['type'], $allowedTypes)) {
                $params = [
                    'message' => 'Blogas failo formatas',
                    'status' => 'danger'
                ];
                header('Location: ?' . http_build_query($params));
                exit;
            }

            move_uploaded_file($_FILES['tweet-photo']['tmp_name'], './uploads/' . $filename);
            $data['tweets'][count($data['tweets']) - 1]['image'] = $filename;
        }
        
        file_put_contents('./database.json', json_encode($data));


        $params = [
            'message' => 'Žinutė paskelbta',
            'status' => 'success'
        ];

        header('Location: ?' . http_build_query($params));

        exit;
    }
?>

<h3>Žinutės turinys</h3>
<form method="POST" enctype="multipart/form-data">
    <textarea name="tweet" class="form-control my-3" max-length="144"></textarea>
    <input type="file" name="tweet-photo" class="form-control" />
    <button class="btn btn-info mb-5">Siųsti</button>
</form>
<div class="d-flex justify-content-between mt-5">
    <h1>Naujausios žinutės</h1>
    <form>
        <select name="order" class="form-control">
            <option value="asc">Nuo seniausių</option>
            <option value="desc">Nuo naujausių</option>
        </select>
        <button class="btn btn-sm btn-primary">Rūšiuoti</button>
    </form>
</div>
<?php foreach($tweets as $tweet): ?>
    <div class="card mb-2">
        <div class="card-body">
            <?php if(isset($tweet['image'])) : ?>
            <img src="uploads/<?=$tweet['image'] ?>" class="card-img-top" />
            <?php endif; ?>
            <h5 class="card-title mb-2"><?= $tweet['author'] ?></h5>
            <p class="card-text"><?= nl2br($tweet['message']) ?></p>            
            <p class="card-text"><small class="text-muted"><?= $tweet['created_at'] ?></small></p>
        </div>
    </div>
<?php endforeach; ?>