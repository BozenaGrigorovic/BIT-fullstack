<div class="container">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
    <?php foreach($navigation as $title => $link) : ?>
        <li class="nav-item"><a href="<?= $link ?>" class="text-decoration-none px-2"><?= $title ?></a></li>
    <?php endforeach; ?>
    </ul>
    <p class="text-center text-muted">© 2023 Mano Bankas, UAB</p>
  </footer>
</div>