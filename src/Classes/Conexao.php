<?php

namespace Src\Classes;
use PDO;

class Conexao {

    public function getConexao() {
        $x = explode('@', getenv('DATABASE_URL'));

        $y = explode(':', $x[0]);
        $z = explode(':', $x[1]);
        $a = explode('/', $z[1]);
        
        return new PDO('pgsql:host=' .$z[0]. ';dbname=' . $a[1], str_replace('//', '', $y[1]), $y[2]);
    }

}
