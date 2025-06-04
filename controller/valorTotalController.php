<?php
require_once __DIR__ . "/../model/ValorTotalModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['codUsuario'])) {
    die("Usuário não autenticado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataInicio = $_POST["dataInicio"];
    $dataFim = $_POST["dataFim"];
    $codUsuario = $_SESSION['codUsuario'];

    $model = new ValorTotalModel();
    
    
    $valorTotal = $model->calcularTotal($codUsuario, $dataInicio, $dataFim);
    
    
    $despesas = $model->listarDespesas($codUsuario, $dataInicio, $dataFim);

    if ($valorTotal > 0) {
        $dataHoje = date('Y-m-d');
        $model->valorFinal($codUsuario, $dataHoje, $valorTotal, $dataInicio, $dataFim);
        
        echo "<h3>Pagamento registrado com sucesso! Valor Total: R$ " . number_format($valorTotal, 2, ',', '.') . "</h3>";
        
        <div class="campo">
        <h2>Cadastro de Despesas</h2>
    
        <form action="../controller/cadastroController.php" method="POST">
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" required>
    
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" id="categoria" required>
    
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" required>
    
            <label for="data_pag">Data de Vencimento:</label>
            <input type="date" name="data_pag" id="data_pag" required>
    
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    
    <style>
        .campo {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
    
        h2 {
            color: #003c6d;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    
        label {
            display: block;
            text-align: left;
            margin-top: 0.8rem;
            font-weight: bold;
            color: #333;
        }
    
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
    
        button[type="submit"] {
            margin-top: 1.5rem;
            width: 100%;
            padding: 0.75rem;
            background-color: #003c6d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    
        button[type="submit"]:hover {
            background-color: #0a2540;
        }
    </style>
    
        if (!empty($despesas)) {
            echo "<h4>Despesas do período:</h4>";
            echo "<table border='1' style='width:100%; border-collapse: collapse; margin-top: 20px;'>";
            echo "<thead>
                    <tr>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Categoria</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            
            foreach ($despesas as $despesa) {
                echo "<tr>
                        <td>" . htmlspecialchars($despesa['data']) . "</td>
                        <td>" . htmlspecialchars($despesa['descricao']) . "</td>
                        <td>R$ " . number_format($despesa['valor'], 2, ',', '.') . "</td>
                        <td>" . htmlspecialchars($despesa['categoria']) . "</td>
                      </tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        }
    } 
    else {
        echo "Nenhuma despesa encontrada no período selecionado.";
    }
}
?>