<?php

namespace Src\Classes;

use PDO;
use Src\Classes\Conexao;
use Src\Classes\Cidade;
use Src\Classes\Cargo;

class Funcionario {

    /** @var Cidade */
    private $Cidade;

    /** @var Cargo */
    private $Cargo;
    private $matricula;
    private $nome;
    private $senha;
    private $nascimento;
    private $sexo;
    private $salario;

    public function getCidade() {
        return $this->Cidade;
    }

    public function getCargo() {
        return $this->Cargo;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNascimento() {
        return $this->nascimento;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setCidade(Cidade $Cidade) {
        $this->Cidade = $Cidade;
    }

    public function setCargo(Cargo $Cargo) {
        $this->Cargo = $Cargo;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
    }

    private function getAll() {
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();

        $sSql = 'SELECT funmatricula,
                        funnome,
                        funnascimento,
                        funsexo,
                        funsalario,
                        tbcidade.cidnome,
                        tbcidade.cidestado,
                        tbcargo.cardescricao
                   FROM FOLHA.TBFUNCIONARIO
                        JOIN FOLHA.TBCIDADE
                        USING(CIDCODIGO)
                        JOIN FOLHA.TBCARGO
                        USING(CARCODIGO);';

        $oRes = $oCnx->query($sSql);

        $aResultado = [];

        while ($aLinha = $oRes->fetch(PDO::FETCH_ASSOC)) {
            $oFuncionario = new Funcionario();
            $oCargo = new Cargo();
            $oCidade = new Cidade();

            $oFuncionario->setMatricula($aLinha['funmatricula']);
            $oFuncionario->setNome($aLinha['funnome']);
            $oFuncionario->setNascimento($aLinha['funnascimento']);
            $oFuncionario->setSexo($aLinha['funsexo']);
            $oFuncionario->setSalario($aLinha['funsalario']);

            $oCargo->setDescricao($aLinha['cardescricao']);
            $oCidade->setNome($aLinha['cidnome']);
            $oCidade->setEstado($aLinha['cidestado']);

            $oFuncionario->setCargo($oCargo);
            $oFuncionario->setCidade($oCidade);

            $aResultado[] = $oFuncionario;
        }

        return $aResultado;
    }

    public function renderizaTabela() {
        $aDados = $this->getAll();

        echo '<h2>Listagem de Cargos</h2>';
        echo '<table class="data-table">';
        echo '    <tr>';
        echo '        <th>Matrícula</th>';
        echo '        <th>Nome</th>';
        echo '        <th>Data Nascimento</th>';
        echo '        <th>Sexo</th>';
        echo '        <th>Salário Base</th>';
        echo '        <th>Cidade</th>';
        echo '        <th>Estado</th>';
        echo '        <th>Cargo</th>';
        echo '        <th>Ação</th>';
        echo '    </tr>';

        foreach ($aDados as $oFuncionario) {
            echo '    <tr>';
            echo '        <td>' . $oFuncionario->getMatricula() . '</td>';
            echo '        <td>' . $oFuncionario->getNome() . '</td>';
            echo '        <td>' . $oFuncionario->getNascimento() . '</td>';
            echo '        <td>' . ($oFuncionario->getSexo() == '1' ? 'Masculino' : 'Feminino') . '</td>';
            echo '        <td>' . $oFuncionario->getSalario() . '</td>';
            echo '        <td>' . $oFuncionario->getCidade()->getNome() . '</td>';
            echo '        <td>' . $oFuncionario->getCidade()->getEstado() . '</td>';
            echo '        <td>' . $oFuncionario->getCargo()->getDescricao() . '</td>';
            echo '        <td>
                              <form method="POST" action="?p=funcionarios&acao=deletar">
                                  <button type="submit" name="reg" value="' .$oFuncionario->getMatricula(). '">
                                      <img src="images/delete.svg" />
                                  </button>
                              <form>
                          </td>';
            echo '    </tr>';
        }

        echo '</table>';
    }

    public function renderizaForm() {
        echo '<h2>Cadastro de Funcionários</h2>';
        echo '<form class="form flex-form" method="POST" action="?p=funcionarios&acao=cadastrar">';
        echo '    <div>';
        echo '        <div class="item-form">';
        echo '            <label for="nome">Nome</label>';
        echo '            <input type="text" id="nome" name="nome" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <label for="sexo">Sexo</label>';
        echo '            <select name="sexo" id="sexo" required>';
        echo '                <option value="" selected>Selecione...</option>';
        echo '                <option value="1">Masculino</option>';
        echo '                <option value="2">Feminino</option>';
        echo '            </select>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <label for="salario">Salário Base</label>';
        echo '            <input type="number" id="salario" name="salario" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <label for="matricula">Matrícula</label>';
        echo '            <input type="number" id="matricula" name="matricula" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="buttons">';
        echo '            <button class="btn main-btn">Cadastrar</button>';
        echo '            <button type="reset" class="btn sec-btn">Cancelar</button>';
        echo '        </div>';
        echo '    </div>';
        echo '    <div>';
        echo '        <div class="item-form">';
        echo '            <label for="nascimento">Data de Nascimento</label>';
        echo '            <input type="date" id="nascimento" name="nascimento" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <label for="cidade">Cidade</label>';
        echo '            <input type="number" id="cidade" name="cidade" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <label for="cargo">Cargo</label>';
        echo '            <input type="number" id="cargo" name="cargo" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '        <div class="item-form">';
        echo '            <label for="senha">Senha</label>';
        echo '            <input type="password" id="senha" name="senha" required placeholder="Digite aqui..."/>';
        echo '        </div>';
        echo '    </div>';
        echo '</form>';
    }

    public function cadastrar() {
        $sSql = 'INSERT INTO folha.tbfuncionario(
                             funmatricula, funnome, funsenha, funnascimento, funsexo, funsalario, 
                             cidcodigo, carcodigo)
                     VALUES (?, ?, ?, ?, ?, ?, 
                             ?, ?);';

        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);
        
        $aParams = [
            $this->getMatricula(), $this->getNome(), $this->getSenha(), $this->getNascimento(),
            $this->getSexo(), $this->getSalario(), $this->getCidade()->getCodigo(), $this->getCargo()->getCodigo()
        ];
        
        $oTr->execute($aParams);
    }
    
    private function deletar() {
        $sSql = 'DELETE
                   FROM FOLHA.TBFUNCIONARIO
                  WHERE FUNMATRICULA = ?;';
        
        $oConexao = new Conexao();
        $oCnx = $oConexao->getConexao();
        $oTr = $oCnx->prepare($sSql);
        
        $oTr->execute([$this->getMatricula()]);
    }
    
    public function gerenciaAcoes() {
        $sAcao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);

        switch ($sAcao) {
            case 'cadastrar':
                $this->setNome($_POST['nome']);
                $this->setSexo($_POST['sexo']);
                $this->setSalario($_POST['salario']);
                $this->setMatricula($_POST['matricula']);
                $this->setNascimento($_POST['nascimento']);
                $this->setSenha(md5($_POST['senha']));

                $oCidade = new Cidade();
                $oCidade->setCodigo($_POST['cidade']);
                $this->setCidade($oCidade);

                $oCargo = new Cargo();
                $oCargo->setCodigo($_POST['cargo']);
                $this->setCargo($oCargo);

                $this->cadastrar();
                break;

            case 'deletar':
                $this->setMatricula($_POST['reg']);
                $this->deletar();
                break;
            default:
                break;
        }
    }

}
