<?php
require_once __DIR__ . "/../configuracaBanco/connection.php";

class GerenciarModel {
    private $pdo;

    public function __construct() {
        $conexao = new BancoDados();
        $this->pdo = $conexao->getConnection();
    }

    public function listarDespesas($codUsuario) {
        $query = "SELECT dd.codDescDesp, dd.nome, dd.valor, dd.data_pag 
                  FROM despesas d
                  JOIN descricaodespesas dd ON d.codDescDesp = dd.codDescDesp
                  WHERE d.codUsuario = :codUsuario";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirDespesa($codDescDesp, $codUsuario) {
        $this->pdo->prepare("DELETE FROM pagamento_despesa WHERE codDescDesp = :cod")
                  ->execute([':cod' => $codDescDesp]);

        $stmt = $this->pdo->prepare("DELETE FROM despesas WHERE codDescDesp = :cod AND codUsuario = :user");
        $stmt->bindParam(':cod', $codDescDesp);
        $stmt->bindParam(':user', $codUsuario);
        $stmt->execute();

        $stmt = $this->pdo->prepare("DELETE FROM descricaodespesas WHERE codDescDesp = :cod");
        $stmt->bindParam(':cod', $codDescDesp);
        return $stmt->execute();
    }

    public function alterarDespesa($codDescDesp, $nome, $valor, $data_pag) {
        $query = "UPDATE descricaodespesas 
                  SET nome = :nome, valor = :valor, data_pag = :data_pag 
                  WHERE codDescDesp = :codDescDesp";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':data_pag', $data_pag);
        $stmt->bindParam(':codDescDesp', $codDescDesp);
        return $stmt->execute();
    }
}
