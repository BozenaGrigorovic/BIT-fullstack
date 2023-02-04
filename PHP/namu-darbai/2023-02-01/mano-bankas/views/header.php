<?php 

$navigation = [
    'Titulinis' => 'index.php',
    'Kortelės' => '?page=korteles',
    'Paskolos' => '?page=paskolos',
    'Pensija' => '?page=pensija',
    'Internetinis Bankas' => '?page=internetinis-bankas'
]

?>


<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

        <?php foreach($navigation as $title => $link) : ?>
          <li><a href="<?=$link ?>" class="text-decoration-none px-2"><?= $title ?></a></li>
        <?php endforeach; ?>
        </ul>

        <div class="text-end">
          <a href="#" class="d-block text-decoration-none">
            <h3 style="font-size: 20px;">Mano Bankas</h3>
          </a>
        </div>
      </div>
    </div>
  </header>