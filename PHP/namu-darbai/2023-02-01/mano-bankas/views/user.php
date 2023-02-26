<?php 
redirectIfNotLoggedIn('user');

$user = $_SESSION['id'];

$action = isset($_GET['action']) ? $_GET['action'] : '';

$recipient = array_filter($APP['data'], function($users) {
  if($users->role != '1' AND $users->iban != '' AND $users->id != $_SESSION['id']->id)
    return $users; 
});

if(!empty($_POST) AND $action === 'new_transfer') {

  $transferCost = 0.43;
  if($_POST['amount'] == '') {
    header('Location: ?page=user&action=new_transfer&message=Įveskite pavedimo sumą&status=danger');
  }
  if($_POST['amount'] + $transferCost > $user->balance) {
    header('Location: ?page=user&action=new_transfer&message=Nepakankamas sąskaitos likutis&status=danger'); 
  }

  foreach($APP['data'] as $index => $user) {
    if($_POST['recipient'] == $user->iban) {
      $APP['data'][$index]->balance += $_POST['amount'];
    }

    if($_SESSION['id']->id == $user->id) {
      $APP['data'][$index]->balance -= $_POST['amount'] + 0.43;
    }
  }

  file_put_contents('database.json', json_encode($APP['data']));

  header('Location: ?page=user&message=Pavedimas sėkmingai atliktas&status=success');

  exit;

}

// print_r($_SESSION);

// print_r($recipient);
// print_r($user);
?>

<div class="container px-4 py-5">
  <div class="d-flex align-items-center justify-content-between">
    <?php if (isset($_GET['message'])) : ?>
      <div class="alert alert-<?= $_GET['status'] ?>">
        <?= $_GET['message'] ?>
    </div>
      <?php endif; ?>
    <h2 class="pb-2 border-bottom"><?= $user->name ?> <?=$user->last_name?></h2>
    <div class="text-align-right">
      <a href="?page=logout" class="btn btn-info btn-sm">Pavedimų istorija</a>
      <a href="?page=user&action=new_transfer" class="btn btn-warning btn-sm">Naujas pavedimas</a>
      <a href="?page=logout" class="btn btn-primary btn-sm">Atsijungti</a>

    </div>
</div>

    <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
      <div class="col d-flex flex-column align-items-start gap-2">
        <h3 class="fw-bold"><?=$user->iban?></h3>
        <p class="text-muted">Mano Bankas sąskaitos numeris</p>
      </div>

      <div class="col">
        <div class="row row-cols-1 row-cols-sm-2 g-4">
          <div class="col d-flex flex-column gap-2">
            <div class="d-inline-flex" style="font-size:40px; color:blue;">
                <i class="bi bi-wallet-fill"></i>
            </div>
            <h4 class="fw-semibold mb-0">Balansas</h4>
            <p class="text-muted" style="font-size:30px;"><?=$user->balance?> €‎</p>
          </div>
      </div>
    </div>

    <?php if($action == 'new_transfer') : ?>
      <div class="col-5">
      <h3>Naujas pavedimas</h3>

        <form method="POST">
          <div class="mb-3 mt-5">
            <label>Gavėjas</label>
            <select name="recipient" class="form-control" onchange="insertValue(event)">
              <option value="" disabled selected></option>
              <?php foreach($recipient as $account): ?>
                <option value="<?=$account->iban?>"><?=$account->name.' '.$account->last_name?></option>
              <?php endforeach; ?>
              </select>
          </div>
          <div class="mb-3">
            <label>Gavėjo sąskaitos numeris</label>
            <input id="recipientsIban" name="rec_iban" type="text" disabled value="" class="form-control"/>
          </div>
          <div class="mb-3">
            <label>Pavedimo suma</label>
            <input type="number" step="0.01" name="amount" class="form-control" min="1" max="<?=floatval($user->balance) - 0.43 ?>" />
          </div>
          <button class="btn btn-warning">Siųsti</button>
        </form>

      </div>



      <?php endif; ?>
  </div>

  <script>
    const insertValue = (event) => {
      document.getElementById('recipientsIban').value = event.target.value
    }
  </script>