<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mano Bankas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <style>
        a {
            color: black;
        }
        a:hover {
            color: pink;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include('views/header.php'); ?>
        <main>
            <?php include("views/".$APP['page'].".php"); ?>
        </main>
        <?php include('views/footer.php'); ?>
    </div>
</body>
</html>