<?php

namespace Src\Classes;
use PDO;
use Src\Classes\Conexao;

class Conexao {

    public function getConexao() {
        return new PDO('pgsql:host=localhost;dbname=' . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
    }

}
