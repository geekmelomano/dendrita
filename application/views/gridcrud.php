
<?php if (isset($titulo)) { ?>
    <h1 class="page-header"><?= $titulo ?></h1>
<?php } ?>

<div id="<?= $grid ?>"></div>

<script>$(<?= $funcion ?>);</script>
