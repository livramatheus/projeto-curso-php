<?php
require __DIR__ . './vendor/autoload.php';
use Src\Classes\Funcionario;

$oFuncionario = new Funcionario();
$oFuncionario->gerenciaAcoes();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Funcionários - Prefeitura Municipal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script src="script.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
    </head>
    <body class="<?= (isset($_COOKIE['isLight']) ? (filter_var($_COOKIE['isLight'], FILTER_VALIDATE_BOOLEAN) == true ? '' : 'dark') : '' ) ?>" >
        
        <?php Src\Componentes\Navbar::render(); ?>

        <div class="card-horizontal">
            <?php $oFuncionario->renderizaForm(); ?>
        </div>

        <div class="card-horizontal">
            <?php $oFuncionario->renderizaTabela(); ?>
        </div>
        
        <?php Src\Componentes\Footer::render(); ?>
    </body>
</html>
