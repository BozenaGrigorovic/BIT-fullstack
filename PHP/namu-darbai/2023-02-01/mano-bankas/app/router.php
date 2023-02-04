<?php 
    $APP['page'] = isset($_GET['page']) ? $_GET['page'] : 'titulinis';
    include('./views/template.php');
?>