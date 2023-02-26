<?php 
// echo '<pre>';
// print_r($APP['data']);
// print_r($_POST);
if (isset($_POST['id']) && isset($_POST['password'])) {
  if (checkLogin($_POST, $APP['data'])) {
    redirectIfLoggedIn();
  }
}

redirectIfLoggedIn();

?>

<div class="col-3 mx-auto text-center">

  <form method="POST">
    <img class="mb-4" src="./assets/media/astronaut.jpg" alt="" width="120">
    <h1 class="h3 mb-3 fw-normal">Įveskite prisijungimo duomenis</h1>

    <?php if($message = getErrorMessage('login')): ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

    <div class="form-floating">
      <input type="text" name="id" class="form-control" placeholder="Vartotojo vardas">
      <label>Vartotojo vardas</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <label>Slaptažodis</label>
    </div>
    <button class="w-100 mt-1 btn btn-lg btn-info" type="submit">Prisijungti</button>
  </form>
</div>