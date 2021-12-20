<?php
use Src\Classes\Cargo;

$oCargo = new Cargo();
$oCargo->gerenciaAcoes();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cargos - Prefeitura Municipal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./src/style/style.css" rel="stylesheet" type="text/css"/>
        <script src="./src/scripts/script.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
    </head>
    <body class="<?= (isset($_COOKIE['isLight']) ? (filter_var($_COOKIE['isLight'], FILTER_VALIDATE_BOOLEAN) == true ? '' : 'dark') : '' ) ?>" >
        
        <?php Src\Componentes\Navbar::render(); ?>
        
        <div class="flex-card">
            <div>
                <?php $oCargo->renderizaForm(); ?>
            </div>
            <div>
                <?php $oCargo->renderizaTabela(); ?>
            </div>
        </div>
        <?php Src\Componentes\Footer::render(); ?>
    </body>
</html>
