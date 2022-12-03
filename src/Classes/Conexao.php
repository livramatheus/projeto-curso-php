<?php

namespace Src\Classes;
use PDO;

class Conexao {

    public function getConexao() {
        $x = explode('@', getenv('DATABASE_URL'));

        $y = explode(':', $x[0]);
        $z = explode(':', $x[1]);
        $a = explode('/', $z[1]);

        $host = $z[0];
        $port = $a[0];
        $pass = $y[2];
        $user = str_replace('//', '', $y[1]);
        $base = $a[1];

        return new PDO("pgsql:host=$host;port=$port;dbname=$base;", $user, $pass);
    }

}
