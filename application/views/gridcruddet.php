
<?php if (isset($titulo)): ?>
<h1 class="page-header"><?= $titulo ?></h1>
<?php endif; ?>

<div id="grid<?= $nombre ?>"></div>

<script type="text/x-kendo-template" id="tmpl<?= $nombre ?>Det">
    <h4><?= $subtitulo ?></h4>
    <div class="grid<?= $nombre_det ?>"></div>
</script>

<script>$(iniciarConf<?= $nombre ?>);</script>
