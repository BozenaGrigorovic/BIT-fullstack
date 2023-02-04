<?php 
redirectIfNotLoggedIn();

$user = $APP['data'][0];

// print_r($user);
?>

<div class="container px-4 py-5">
    <h2 class="pb-2 border-bottom"><?= $user['name'] ?> <?=$user['last_name']?></h2>

    <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
      <div class="col d-flex flex-column align-items-start gap-2">
        <h3 class="fw-bold"><?=$user['iban']?></h3>
        <p class="text-muted">Mano Bankas sąskaitos numeris</p>
        <a href="?page=logout" class="btn btn-primary btn-lg">Atsijungti</a>
      </div>

      <div class="col">
        <div class="row row-cols-1 row-cols-sm-2 g-4">
          <div class="col d-flex flex-column gap-2">
            <div class="d-inline-flex" style="font-size:40px; color:blue;">
                <i class="bi bi-wallet-fill"></i>
            </div>
            <h4 class="fw-semibold mb-0">Balansas</h4>
            <p class="text-muted" style="font-size:30px;"><?=$user['balance']?> €‎</p>
          </div>
      </div>
    </div>
  </div>
