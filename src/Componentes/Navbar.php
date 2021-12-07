<?php

namespace Src\Componentes;

class Navbar {

    public static function render() {
        if (isset($_COOKIE['isLight'])) {
            $icon = (!filter_var($_COOKIE['isLight'], FILTER_VALIDATE_BOOLEAN) ? 'sun' : 'moon');
        } else {
            $icon = 'moon';
        }

        ob_start();

        echo '<nav class="navbar">';
        echo '    <a class="logo" href="index.php">';
        echo '        <img src="./images/logo.svg" alt="Logo"/>';
        echo '        <p>Prefeitura Municipal de <span class="nome-municipio">Um Lugar Fictício</span></p>';
        echo '    </a>';
        echo '    <div class="nav-menu">';
        echo '        <a href="index.php">Início</a>';
        echo '        <a href="cidades.php">Cidades</a>';
        echo '        <a href="cargos.php">Cargos</a>';
        echo '        <a href="funcionarios.php">Funcionários</a>';
        echo '        <a href="calcular.php">Calcular Pagamento</a>';
        echo '        <a href="consultar.php">Visualizar Pagamento</a>';
        echo '        <img src="images/' . $icon . '.svg" alt="dark_theme" class="theme-btn"/>';
        echo '    </div>';
        echo '</nav>';

        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

}
