
<h1 class="page-header"><?= $titulo ?></h1>

<div id="<?= $nombre_tab ?>">
    <ul>
        <?php for ($i = 0; $i < count($pestanas); $i++): ?>
        <li<?php if ($i == 0): ?> class="k-state-active"<?php endif; ?>>
            <?= $pestanas[$i]['etiqueta'] ?>
        </li>
        <?php endfor; ?>
    </ul>
</div>

<script>
    $('#<?= $nombre_tab ?>').kendoTabStrip({
        animation: {
            open: { effects: 'fadeIn' }
        },
        contentUrls: [
            <?php foreach ($pestanas as $pestana): ?>
            url + '<?= $pestana['url'] ?>',
            <?php endforeach; ?>
        ]
    });
</script>
