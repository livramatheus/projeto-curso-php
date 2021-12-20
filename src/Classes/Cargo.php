<?php

namespace Src\Classes;
use PDO;
use Src\Classes\Conexao;

class Cargo {
    
    private $codigo;
    private $descricao;
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    private function getAll() {
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        
        $sSql = 'SELECT *
                   FROM FOLHA.TBCARGO;';
        
        $oRes = $oCnx->query($sSql);
        
        $aResultado = [];
        
        while ($aLinha = $oRes->fetch(PDO::FETCH_ASSOC)) {
            $oCargo = new Cargo();
            $oCargo->setCodigo($aLinha['carcodigo']);
            $oCargo->setDescricao($aLinha['cardescricao']);
            
            $aResultado[] = $oCargo;
        }
        
        return $aResultado;
    }
    
    
    public function renderizaTabela() {
        $aDados = $this->getAll();
        
        echo '<h2>Listagem de Cargos</h2>';
        echo '<table class="data-table">';
        echo '    <tr>';
        echo '        <th>Código</th>';
        echo '        <th>Descrição</th>';
        echo '        <th>Ação</th>';
        echo '    </tr>';
        
        foreach ($aDados as $oCargo) {
            echo '    <tr>';
            echo '        <td>' .$oCargo->getCodigo(). '</td>';
            echo '        <td>' .$oCargo->getDescricao(). '</td>';
            echo '        <td>
                              <form method="POST" action="?p=cargos&acao=deletar">
                                  <button type="submit" name="reg" value="' .$oCargo->getCodigo(). '">
                                      <img src="images/delete.svg" />
                                  </button>
                              <form>
                          </td>';
            echo '    </tr>';            
        }
        
        echo '</table>';
    }
    
    public function renderizaForm() {
        echo '<h2>Cadastro de Cargos</h2>';
        echo '<form class="form" method="POST" action="?p=cargos&acao=cadastrar">';
        echo '    <div class="item-form">';
        echo '        <label for="descricao">Nome do Cargo</label>';
        echo '        <input type="text" id="descricao" name="descricao" placeholder="Digite aqui..."/>';
        echo '    </div>';
        echo '    <div class="item-form">';
        echo '        <div class="buttons">';
        echo '            <button class="btn main-btn">Cadastrar</button>';
        echo '            <button type="reset" class="btn sec-btn">Cancelar</button>';
        echo '        </div>';               
        echo '    </div>';
        echo '</form>';
    }
    
    private function cadastrar() {
        $sSql = 'INSERT INTO FOLHA.TBCARGO (CARDESCRICAO)
                                    VALUES (?);';
        
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);
        
        $oTr->execute([$this->getDescricao()]);
    }
    
    private function deletar() {
        $sSql = 'DELETE
                   FROM FOLHA.TBCARGO
                  WHERE CARCODIGO = ?;';
        
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);
        
        $oTr->execute([$this->getCodigo()]);
    }
    
    public function gerenciaAcoes() {
        $sAcao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);
        
        switch ($sAcao) {
            case 'cadastrar':
                $this->setDescricao($_POST['descricao']);
                $this->cadastrar();
                break;
            
            case 'deletar':
                $this->setCodigo($_POST['reg']);
                $this->deletar();
                break;
            default:
                break;
        }
    }
    
}
