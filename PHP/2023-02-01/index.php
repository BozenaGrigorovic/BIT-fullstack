<?php


function rrmdir($d) {
    if(!is_dir($d)) {
        if($d === basename(__FILE__)) {
            header('Location: ?dir=' . $dir . '&m=Cannot delete main file');
        } else {
            unlink($d);
        }
    } else {
        $objects = scandir($d);
        foreach ($objects as $object) {
          if ($object != "." && $object != "..") {
            if (filetype($d."/".$object) == "dir") 
               rrmdir($d."/".$object); 
            else unlink($d."/".$object);
          }
        }
        reset($objects);
        rmdir($d);
      } 
     };



$dir = './';
$back_link = '';

if(isset($_GET['dir']) AND $_GET['dir'] != '') {
    $dir = $_GET['dir'];

    $path_array = explode('/', $dir);

    if($dir != './') {
        if(count($path_array) > 1) {
            unset($path_array[count($path_array) - 1]);
            $back_link = implode('/', $path_array);
        } else {
            $back_link = './';
        }
    }
}


if(isset($_POST['data_type']) AND $_POST['data_type'] === '1') {
    if(isset($_POST['folder_name']) AND $_POST['folder_name'] != '') {
        mkdir($dir . '/' . $_POST['folder_name']);
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }
} else {
    if(isset($_POST['file_name']) AND $_POST['file_name'] != '') {
        file_put_contents($dir . '/' . $_POST['file_name'], $_POST['file_contents']);
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['new_name']) AND $_POST['new_name'] != '') {
    $file_path = explode('/', $_GET['edit']);
    unset($file_path[count($file_path) - 1]);
    $file_path[] = $_POST['new_name'];

    $to = implode('/', $file_path);

    rename($_GET['edit'], $to);

    header('Location: ?dir=' . $dir);

}

if( isset($_GET['delete']) AND $_GET['delete'] != '') {
    rrmdir($_GET['delete']);
    header('Location: ?dir=' . $dir);

}



// print_r($_FILES);

if(isset($_FILES['file_upload']) AND count($_FILES['file_upload']) > 1 ) {
    $tmpFile = $_FILES['file_upload']['tmp_name'];
    $target = $dir === './' ? $_FILES['file_upload']['name'] : $dir . '/' . $_FILES['file_upload']['name'];
    move_uploaded_file($tmpFile, $target);
}


$data = scandir($dir);

// print_r($data);

if(isset($_POST['check_list'])) {
    foreach($_POST['check_list'] as $d) {
        rrmdir($d);
    }
    header('Location: ?dir=' . $dir);
}




unset($data[0]);
unset($data[1]);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <h1>File manager</h1>
        <?php if(isset($_GET['m']) AND $_GET['m'] != '') { ?>
            <div class="alert alert-danger"><?= $_GET['m'] ?></div>
        <?php } ?>
        <form method="POST">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($back_link) { ?>
                    <tr>
                        <td colspan="2"><a href="?dir=<?= $back_link ?>">Back to parent directory</a></td>
                    </tr>
                <?php } ?>
                <?php foreach($data as $item) { 
                    // print_r($item);
                    $path = $dir === './' ? $item : $dir . '/' . $item;
                    $icon = 'folder';

                    $formats = [
                        'txt' => 'file-earmark-font',
                        'pdf' => 'file-pdf-fill',
                        'jpg' => 'file-image',
                        'svg' => 'filetype-svg',
                        'mp3' => 'file-music',
                        'php' => 'filetype-php',
                        'css' => 'filetype-css',
                        'json' => 'filetype-json',
                        'zip' => 'file-earmark-zip',
                        'html' => 'filetype-html',
                    ];

                    if(!is_dir($path)) {
                        $icon = 'file-earmark-check';

                        $file_name = explode('.', $item);
                        $file_name = $file_name[count($file_name) - 1];

                        if(array_key_exists($file_name, $formats)) {
                            $icon = $formats[$file_name];
                        }
                    }

                    ?>
                <tr>
                    <td>
                        <input type="checkbox" name="check_list[]" value="<?= $path ?>" />
                        <i class="bi bi-<?= $icon ?>"></i>
                        <?= (is_dir($path)) ? '<a href="?dir=' . $path . '">' . $item . '</a>' : $item ?>
                    </td>
                    <td>
                        <a href="?edit=<?= $path ?>&dir=<?= $dir ?>" class="btn btn-success">Edit</a>
                        <a href="?delete=<?= $path ?>&dir=<?= $dir ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="mb-3">
                <button class="btn btn-danger">Delete Selected</button>
            </div>
        </form>
        <?php if (isset($_GET['edit'])) { ?>

            <h2>Edit file name</h2>
            <div class="mb-3">
                <form method="POST">
                    <label>New Name</label>
                    <input type="text" name="new_name" class="form-control" />
                </form>
            </div>

        <?php } else { ?>



        <h2>Create New</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Select data type</label>
                <select name="data_type" class="form-control">
                    <option value="1">Folder</option>
                    <option value="2">File</option>
                    <option value="3">Upload</option>
                </select>
            </div>
            <div class="folder">
                <div class="mb-3">
                    <label>Folder name</label>
                    <input type="text" name="folder_name" class="form-control" />
                </div>
            </div>
            <div class="file">
                <div class="mb-3">
                    <label>File name</label>
                    <input type="text" name="file_name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label>File contents</label>
                    <textarea name="file_contents" class="form-control"></textarea>
                </div>
            </div>
            <div class="upload">
                <div class="mb-3">
                    <label>Select file to upload</label>
                    <input type="file" name="file_upload" class="form-control" />
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
    <script>
        document.querySelector('.file').style.display = 'none';
        document.querySelector('.upload').style.display = 'none';

        document.querySelector('[name="data_type"]').addEventListener('change', (e) => {
            if (e.target.value === '1') {
                document.querySelector('.file').style.display = 'none';
                document.querySelector('.upload').style.display = 'none';
                document.querySelector('.folder').style.display = 'block';
            } else if (e.target.value === '2'){
                document.querySelector('.file').style.display = 'block';
                document.querySelector('.upload').style.display = 'none';
                document.querySelector('.folder').style.display = 'none';
            } else {
                document.querySelector('.file').style.display = 'none';
                document.querySelector('.upload').style.display = 'block';
                document.querySelector('.folder').style.display = 'none';
            }
        });
    </script>
    <?php } ?>

</body>
</html>