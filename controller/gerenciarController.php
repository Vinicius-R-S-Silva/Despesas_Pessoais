<?php
session_start();
require_once '../model/gerenciarModel.php';

$model = new GerenciarModel();

if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
    $codUsuario = $_SESSION['codUsuario'];

    if ($acao === 'excluir') {
        $codDescDesp = $_POST['codDescDesp'];
        $model->excluirDespesa($codDescDesp, $codUsuario);
        $_SESSION['mensagem'] = "Despesa excluída com sucesso!";
            header("Location: ../view/perfilUsuarioView.php?pagina=gerenciar_despesas");

            exit;
    }

    if ($acao === 'alterar') {
        $codDescDesp = $_POST['codDescDesp'];
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $data_pag = $_POST['data_pag'];

        $model->alterarDespesa($codDescDesp, $nome, $valor, $data_pag);
        $_SESSION['mensagem'] = "Despesa alterada com sucesso!";
    }

    header("Location: ../view/perfilUsuarioView.php?pagina=gerenciar_despesas");
    exit;
}
