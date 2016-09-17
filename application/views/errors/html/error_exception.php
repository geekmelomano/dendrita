<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">
    <h4>Se ha encontrado una excepción no detectada</h4>
    <p>Tipo: <?php echo get_class($exception); ?></p>
    <p>Mensaje: <?php echo $message; ?></p>
    <p>Nombre de archivo: <?php echo $exception->getFile(); ?></p>
    <p>Número de línea: <?php echo $exception->getLine(); ?></p>

    <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
        <p>Backtrace:</p>
        <?php foreach ($exception->getTrace() as $error): ?>
            <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
                <p style="margin-left:10px">
                    Archivo: <?php echo $error['file']; ?><br />
                    Línea: <?php echo $error['line']; ?><br />
                    Función: <?php echo $error['function']; ?>
                </p>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
</div>
