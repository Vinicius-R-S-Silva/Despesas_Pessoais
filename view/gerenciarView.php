<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../model/gerenciarModel.php';

$model = new GerenciarModel();
$codUsuario = $_SESSION['codUsuario'];
$despesas = $model->listarDespesas($codUsuario);

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('" . $_SESSION['mensagem'] . "');</script>";
    unset($_SESSION['mensagem']);
}
?>

<div class="campo">
    <h2>Gerenciar Despesas</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($despesas as $d): ?>
        <tr>
            <form method="POST" action="../controller/gerenciarController.php">
                <input type="hidden" name="codDescDesp" value="<?= $d['codDescDesp'] ?>">
                <td><input type="text" name="nome" value="<?= $d['nome'] ?>"></td>
                <td><input type="number" step="0.01" name="valor" value="<?= $d['valor'] ?>"></td>
                <td><input type="date" name="data_pag" value="<?= $d['data_pag'] ?>"></td>
                <td>
                    <button type="submit" name="acao" value="alterar">Alterar</button>
                    <button type="submit" name="acao" value="excluir" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<style>
    .campo {
        background-color: #fff;
        padding: 2rem;
        border-radius: 10px;
        width: 100%;
        max-width: 900px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        margin: 0 auto;
    }

    h2 {
        color: #003c6d;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #003c6d;
        color: white;
        padding: 10px;
        text-align: left;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    button[type="submit"] {
        margin: 5px 0;
        padding: 0.5rem 1rem;
        background-color: #003c6d;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #0a2540;
    }

    td:last-child {
        display: flex;
        gap: 5px;
        justify-content: center;
    }
</style>
