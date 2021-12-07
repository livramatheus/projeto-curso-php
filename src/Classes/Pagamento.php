<?php

namespace Src\Classes;

use PDO;
use Src\Classes\Conexao;
use Src\Classes\Funcionario;

class Pagamento {

    /** @var Funcionario */
    private $Funcionario;
    private $mes;
    private $ano;
    private $proventos;
    private $descontos;
    private $liquido;

    public function getFuncionario() {
        return $this->Funcionario;
    }

    public function getMes() {
        return $this->mes;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getProventos() {
        return $this->proventos;
    }

    public function getDescontos() {
        return $this->descontos;
    }
    
    public function getLiquido() {
        return $this->liquido;
    }
    
    public function setFuncionario(Funcionario $Funcionario) {
        $this->Funcionario = $Funcionario;
    }

    public function setMes($mes) {
        $this->mes = $mes;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function setProventos($proventos) {
        $this->proventos = $proventos;
    }

    public function setDescontos($descontos) {
        $this->descontos = $descontos;
    }
    
    public function setLiquido($liquido) {
        $this->liquido = $liquido;
    }
    
    public function renderizaFormConsulta() {
        echo '<div class="small-card">';
        echo '    <div>';
        echo '        <h2>Consulta de Pagamento</h2>';
        echo '        <form class="form small-form" method="POST" action="?acao=consultar">';
        echo '            <div class="item-form form-half">';
        echo '                <label for="mes">Mês</label>';
        echo '                <select name="mes" id="mes" required >';
        echo '                    <option value="" selected>Selecione...</option>';
        echo '                    <option value="1">Janeiro</option>';
        echo '                    <option value="2">Fevereiro</option>';
        echo '                    <option value="3">Março</option>';
        echo '                    <option value="4">Abril</option>';
        echo '                    <option value="5">Maio</option>';
        echo '                    <option value="6">Junho</option>';
        echo '                    <option value="7">Julho</option>';
        echo '                    <option value="8">Agosto</option>';
        echo '                    <option value="9">Setembro</option>';
        echo '                    <option value="10">Outubro</option>';
        echo '                    <option value="11">Novembro</option>';
        echo '                    <option value="12">Dezembro</option>';
        echo '                </select>';
        echo '            </div>';
        echo '            <div class="item-form form-half">';
        echo '                <label for="ano">Ano</label>';
        echo '                <input type="number" id="ano" name="ano" required placeholder="Digite aqui..."/>';
        echo '            </div>';
        echo '            <div class="item-form form-full">';
        echo '                <label for="matricula">Matrícula Funcionário</label>';
        echo '                <input type="number" id="matricula" name="matricula" required placeholder="Digite aqui..."/>';
        echo '            </div>';
        echo '            <div class="item-form form-full">';
        echo '                <label for="senha">Senha</label>';
        echo '                <input type="password" id="senha" name="senha" required placeholder="Digite aqui..."/>';
        echo '            </div>';
        echo '            <div class="item-form form-half">';
        echo '                <button class="btn main-btn">Consultar</button>';
        echo '            </div>';
        echo '            <div class="item-form form-half">';
        echo '                <button type="reset" class="btn sec-btn">Cancelar</button>';
        echo '            </div>';
        echo '        </form>';
        echo '    </div>';
        echo '</div>';
    }
    
    public function renderizaForm() {
        echo '<div>';
        echo '    <h2>Lançamento de Folha de Pagamento</h2>';
        echo '    <form class="form small-form" method="POST" action="?acao=lancar">';
        echo '        <div class="item-form form-half">';
        echo '            <label for="mes">Mês</label>';
        echo '            <select id="mes" name="mes" required>';
        echo '                <option value="" selected>Selecione...</option>';
        echo '                <option value="1">Janeiro</option>';
        echo '                <option value="2">Fevereiro</option>';
        echo '                <option value="3">Março</option>';
        echo '                <option value="4">Abril</option>';
        echo '                <option value="5">Maio</option>';
        echo '                <option value="6">Junho</option>';
        echo '                <option value="7">Julho</option>';
        echo '                <option value="8">Agosto</option>';
        echo '                <option value="9">Setembro</option>';
        echo '                <option value="10">Outubro</option>';
        echo '                <option value="11">Novembro</option>';
        echo '                <option value="12">Dezembro</option>';
        echo '            </select>';
        echo '        </div>';
        echo '        <div class="item-form form-half">';
        echo '            <label for="ano">Ano</label>';
        echo '            <input type="number" id="ano" name="ano" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form form-full">';
        echo '            <label for="matricula">Matrícula Funcionário</label>';
        echo '            <input type="number" id="matricula" name="matricula" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form form-half">';
        echo '            <label for="proventos">Proventos</label>';
        echo '            <input type="number" id="proventos" name="proventos" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form form-half">';
        echo '            <label for="descontos">Descontos</label>';
        echo '            <input type="number" id="descontos" name="descontos" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form form-half">';
        echo '            <button class="btn main-btn">Cadastrar</button>';
        echo '        </div>';
        echo '        <div class="item-form form-half">';
        echo '            <button type="reset" class="btn sec-btn">Cancelar</button>';
        echo '        </div>';
        echo '    </form>';
        echo '</div>';
    }

    private function lancar() {
        $sSql = 'INSERT INTO folha.tbpagamento(
                             pagmes, pagano, funmatricula, proventos, descontos)
                      VALUES (?, ?, ?, ?, ?);';

        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);

        $aParams = [
            $this->getMes(), $this->getAno(), $this->getFuncionario()->getMatricula(),
            $this->getProventos(), $this->getDescontos()
        ];

        $oTr->execute($aParams);
    }

    private function consultar() {
        $sSql = "SELECT TBPAGAMENTO.PAGMES,
                        TBPAGAMENTO.PAGANO,
                        TBPAGAMENTO.PROVENTOS,
                        TBPAGAMENTO.DESCONTOS,
                        TBFUNCIONARIO.FUNSALARIO,
                        (TBFUNCIONARIO.FUNSALARIO + TBPAGAMENTO.PROVENTOS - TBPAGAMENTO.DESCONTOS) AS LIQUIDO,
                        TBFUNCIONARIO.FUNMATRICULA,
                        TBFUNCIONARIO.FUNNOME
                   FROM FOLHA.TBPAGAMENTO
                        JOIN FOLHA.TBFUNCIONARIO ON
                        TBPAGAMENTO.FUNMATRICULA = TBFUNCIONARIO.FUNMATRICULA
                  WHERE TBFUNCIONARIO.FUNMATRICULA = ?
                    AND FUNSENHA = ?
                    AND PAGMES = ?
                    AND PAGANO = ?;";

        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);

        $aDados = [
            $this->Funcionario->getMatricula(),
            $this->Funcionario->getSenha(),
            $this->getMes(),
            $this->getAno()
        ];
        
        $oTr->execute($aDados);
        $aResultado = $oTr->fetch(PDO::FETCH_ASSOC);
        
        if ($oTr->rowCount() > 0) {
            $oConsulta = new Pagamento();
            $oConsulta->setMes($aResultado['pagmes']);
            $oConsulta->setAno($aResultado['pagano']);
            $oConsulta->setProventos($aResultado['proventos']);
            $oConsulta->setDescontos($aResultado['descontos']);
            $oConsulta->setLiquido($aResultado['liquido']);

            $oFuncionario = new Funcionario();
            $oFuncionario->setMatricula($aResultado['funmatricula']);
            $oFuncionario->setNome($aResultado['funnome']);
            $oFuncionario->setSalario($aResultado['funsalario']);

            $oConsulta->setFuncionario($oFuncionario);

            $this->renderizaFolhaPagamento($oConsulta);
        } else {
            $this->renderizaMensagemErro('Ocorreu um erro ao buscar a folha de pagamento com os parâmetros epecificados.');
        }
    }
    
    private function renderizaMensagemErro($sMsg) {
        echo '<div class="erro-wrapper">';
        echo '    <div class="erro">';
        echo '        <div class="erro-header">';
        echo '            <div class="erro-header-title">';
        echo '                <h2>Erro!</h2>';
        echo '                <img src="./images/exclamation-circle.svg" alt="Alert!" />';
        echo '            </div>';
        echo '            <img src="./images/close.svg" alt="Close" class="erro-close"/>';
        echo '        </div>';
        echo '        <div class="erro-body">' .$sMsg. '</div>';
        echo '        <a class="btn main-btn erro-nova-consulta">Nova Consulta</a>';
        echo '    </div>';
        echo '</div>';
    }
    
    private function renderizaFolhaPagamento(Pagamento $oDados) {
        echo '<div class="card-horizontal">';
        echo '    <h2>Folha de Pagamento</h2>';
        echo '    <table class="folha-table">';
        echo '        <tr>';
        echo '            <th colspan="3">Recibo de Pagamento</th>';
        echo '        </tr>';
        echo '        <tr>';
        echo '            <th colspan="2">Matrícula/Funcionário: ' .$oDados->getFuncionario()->getMatricula(). '/' .$oDados->getFuncionario()->getNome(). '</th>';
        echo '            <th colspan="2">Mês/Ano: ' .$oDados->getMes(). '/' .$oDados->getAno(). '</th>';
        echo '        </tr>';
        echo '        <tr>';
        echo '            <th>Descrição</th>';
        echo '            <th>Proventos</th>';
        echo '            <th>Descontos</th>';
        echo '        </tr>';
        echo '        <tr>';
        echo '            <td>Salário Base</td>';
        echo '            <td>' .$oDados->getFuncionario()->getSalario(). '</td>';
        echo '            <td></td>';                
        echo '        </tr>';
        echo '        <tr>';
        echo '            <td>Proventos</td>';
        echo '            <td>' .$oDados->getProventos(). '</td>';
        echo '            <td></td>';
        echo '        </tr>';
        echo '        <tr>';
        echo '            <td>Descontos</td>';
        echo '            <td></td>';
        echo '            <td>' .$oDados->getDescontos(). '</td>';
        echo '        </tr>';
        echo '        <tr>';
        echo '            <td colspan="2"></td>';
        echo '            <td>' .$oDados->getLiquido(). '</td>';
        echo '        </tr>';
        echo '    </table>';
        echo '</div>';
    }
    
    public function gerenciaAcoes() {
        $sAcao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);

        switch ($sAcao) {
            case 'lancar':
                $this->setMes($_POST['mes']);
                $this->setAno($_POST['ano']);
                $this->setProventos($_POST['proventos']);
                $this->setDescontos($_POST['descontos']);

                $oFuncionario = new Funcionario();
                $oFuncionario->setMatricula($_POST['matricula']);
                $this->setFuncionario($oFuncionario);

                $this->lancar();
                break;
            case 'consultar':
                $this->setMes($_POST['mes']);
                $this->setAno($_POST['ano']);

                $oFuncionario = new Funcionario();
                $oFuncionario->setMatricula($_POST['matricula']);
                $oFuncionario->setSenha(md5($_POST['senha']));
                $this->setFuncionario($oFuncionario);
                
                $this->consultar();
                break;
            default:
                break;
        }
    }

}
