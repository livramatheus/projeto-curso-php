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
        echo '    <a class="logo" href="?p=home">';
        echo '        <img src="./images/logo.svg" alt="Logo"/>';
        echo '        <p>Prefeitura Municipal de <span class="nome-municipio">Um Lugar Fictício</span></p>';
        echo '    </a>';
        echo '    <div class="nav-menu">';
        echo '        <a href="?p=home">Início</a>';
        echo '        <a href="?p=cidades">Cidades</a>';
        echo '        <a href="?p=cargos">Cargos</a>';
        echo '        <a href="?p=funcionarios">Funcionários</a>';
        echo '        <a href="?p=calcular">Calcular Pagamento</a>';
        echo '        <a href="?p=consultar">Visualizar Pagamento</a>';
        echo '        <img src="images/' . $icon . '.svg" alt="dark_theme" class="theme-btn"/>';
        echo '    </div>';
        echo '</nav>';

        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

}
