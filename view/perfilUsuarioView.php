<?php
session_start();
require_once '../model/PerfilUsuarioModel.php';

$model = new PerfilUsuarioModel();
$usuario = $model->getPerfilUsuario();
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('" . $_SESSION['mensagem'] . "');</script>";
    unset($_SESSION['mensagem']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - <?php echo htmlspecialchars($usuario['nome'] ?? ''); ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: url('../images/image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            width: 180px; /* Diminuída */
            background-color: rgba(0, 60, 109, 0.9);
            height: 100vh;
            padding: 2rem 1rem;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 0.75rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #0a2540;
        }

        .main-content {
            margin-left: 180px; /* Ajustado junto com o sidebar */
            width: calc(100% - 180px);
            position: relative;
            z-index: 2;
            min-height: 100vh;
        }

        header {
            position: fixed;
            top: 0;
            left: 180px; /* Alinhado com sidebar */
            right: 0;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 0 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .user-settings span {
            font-weight: bold;
        }

        .feed-container {
            width: 70%;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 6rem auto 2rem auto; /* Empurra para baixo do header */
            position: relative;
            z-index: 1;
        }

        .publication-list {
            list-style: none;
            padding: 0;
        }

        .publication-item {
            margin-bottom: 1.5rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .publication-item p {
            margin: 0;
            font-size: 1.1rem;
        }

        .publication-item small {
            display: block;
            margin-top: 0.5rem;
            color: #888;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                flex-direction: row;
                justify-content: space-around;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            header {
                left: 0;
            }

            .feed-container {
                width: 95%;
                margin: 6rem auto;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="perfilUsuarioView.php">Inicio</a>
    <a href="?pagina=cadastrar_despesas">Cadastrar despesas</a>
    <a href="?pagina=gerenciar_despesas">Gerenciar Despesas</a>
    <a href="?pagina=ver_historico">Relatórios</a>
    <a href="../view/loginView.php">Sair</a>
</div>

<div class="main-content">
    <header>
        <div class="user-settings">
            <span>Bem-vindo, <?php echo isset($usuario['nome']) ? htmlspecialchars($usuario['nome']) : ''; ?>!</span>
        </div>
    </header>

    <div class="feed-container"> 
        <?php
        if (isset($_GET['pagina']) && $_GET['pagina'] === 'cadastrar_despesas') {
            include 'cadastroview.php';
        }
        elseif (isset($_GET['pagina']) && $_GET['pagina'] === 'gerenciar_despesas') {
            include 'gerenciarView.php';
        }
        elseif (isset($_GET['pagina']) && $_GET['pagina'] === 'ver_historico') {
            include 'tabelaView.php';
        }
        ?>
    </div>
</div>

</body>
</html>
