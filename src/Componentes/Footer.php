<?php

namespace Src\Componentes;

class Footer {

    public static function render() {
        ob_start();

        echo '<footer>';
        echo '    <span>Projeto desenvolvido para o Curso PHP</span>';
        echo '</footer>';

        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

}
