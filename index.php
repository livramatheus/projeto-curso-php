<?php
require __DIR__ . './vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Página Inicial - Prefeitura Municipal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script src="script.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
    </head>
    <body class="<?= (isset($_COOKIE['isLight']) ? (filter_var($_COOKIE['isLight'], FILTER_VALIDATE_BOOLEAN) == true ? '' : 'dark') : '' ) ?>" >
        <?php
        
        Src\Componentes\Navbar::render();
        
        $x = 'light';

        if (isset($_COOKIE['isLight'])) {
            $x = !filter_var($_COOKIE['isLight'], FILTER_VALIDATE_BOOLEAN) ? 'dark' : 'light';
        }
        
        ?>

        <div class="card home">
            <div class="info-home">
                <h1>Olá Cidadão!</h1>
                <p>
                    O salário líquido é o valor disponível para o empregado depois
                    que os descontos legais são deduzidos da sua remuneração registrada
                    na Carteira de Trabalho.
                </p>
                <p>
                    Clique no botão para visualizar a folha de pagamento.
                </p>
                <a class="btn main-btn big-btn" href="consultar.php">Visualizar Folha de Pagamento</a>
            </div>
            <div class="img-home" 
                style="
                background: url(images/folha_<?= $x ?>.svg);
                background-repeat: no-repeat;
                background-position: center;
                background-size: 60%;">
            </div>
        </div>
        <?php Src\Componentes\Footer::render(); ?>
    </body>
</html>
