<?php

namespace Src\Classes;
use PDO;
use Src\Classes\Conexao;

class Cidade {

    private $codigo;
    private $nome;
    private $estado;

    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
    private function getAll() {
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        
        $sSql = 'SELECT *
                   FROM FOLHA.TBCIDADE;';
        
        $oRes = $oCnx->query($sSql);
        
        $aResultado = [];
        
        while ($aLinha = $oRes->fetch(PDO::FETCH_ASSOC)) {
            $oCidade = new Cidade();
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oCidade->setNome($aLinha['cidnome']);
            $oCidade->setEstado($aLinha['cidestado']);
            
            $aResultado[] = $oCidade;
        }
        
        return $aResultado;
    }
    
    public function renderizaTabela() {
        $aDados = $this->getAll();
        
        echo '<h2>Listagem de Cidades</h2>';
        echo '<table class="data-table">';
        echo '    <tr>';
        echo '        <th>Código</th>';
        echo '        <th>Nome</th>';
        echo '        <th>Estado</th>';
        echo '        <th>Ação</th>';
        echo '    </tr>';
        
        foreach ($aDados as $oCidade) {
            echo '    <tr>';
            echo '        <td>' .$oCidade->getCodigo(). '</td>';
            echo '        <td>' .$oCidade->getNome(). '</td>';
            echo '        <td>' .$oCidade->getEstado(). '</td>';
            echo '        <td>
                              <form method="POST" action="?p=cidades&acao=deletar">
                                  <button type="submit" name="reg" value="' .$oCidade->getCodigo(). '">
                                      <img src="images/delete.svg" />
                                  </button>
                              <form>
                          </td>';
            echo '    </tr>';            
        }
        
        echo '</table>';
    }
    
    public function renderizaForm() {
        echo '<div>';
        echo '    <h2>Cadastro de Cidades</h2>';
        echo '    <form class="form" method="POST" action="?p=cidades&acao=cadastrar">';
        echo '        <div class="item-form">';
        echo '            <label for="nome">Cidade</label>';
        echo '            <input type="text" required id="nome" name="nome" placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <label for="estado">Estado</label>';
        echo '            <input type="text" required id="estado" name="estado" placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <div class="buttons">';
        echo '                <button class="btn main-btn">Cadastrar</button>';
        echo '                <button type="reset" class="btn sec-btn">Cancelar</button>';
        echo '            </div>';
        echo '        </div>';
        echo '    </form>';
        echo '</div>';
    }
    
    private function cadastrar() {
        $sSql = 'INSERT INTO FOLHA.TBCIDADE (CIDNOME, CIDESTADO)
                                     VALUES (?, ?);';
        
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);
        
        $oTr->execute([$this->getNome(), $this->getEstado()]);
    }
    
    private function deletar() {
        $sSql = 'DELETE
                   FROM FOLHA.TBCIDADE
                  WHERE CIDCODIGO = ?;';
        
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);
        
        $oTr->execute([$this->getCodigo()]);
    }

    public function gerenciaAcoes() {
        $sAcao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);
        
        switch ($sAcao) {
            case 'cadastrar':
                $this->setNome($_POST['nome']);
                $this->setEstado($_POST['estado']);
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
