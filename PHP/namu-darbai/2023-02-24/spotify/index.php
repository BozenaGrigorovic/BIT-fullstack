<?php 

    session_start();

    try {
        $db = new mysqli('localhost', 'root', '', 'spotify');
    } catch(Exception $error) {
        echo '<h2>Nepavyko prisijungti prie duomenų bazės</h2>';
        exit;
    }




    $page = isset($_GET['page']) ? $_GET['page'] : '';

    include './views/partials/header.php';

    switch($page) {
        case 'register':
            include './views/pages/register.php';
            break;
        case 'login':
            include './views/pages/login.php';
            break;
        case 'admin':
            include './views/pages/admin.php';
            break;
        case 'logout':
            include './views/pages/logout.php';
            break;
        default:
            include './views/pages/main.php';
    }

    include './views/partials/footer.php';
?>


