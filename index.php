<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Financeira</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function atualizarCampos() {
            const calculo = document.getElementById('calculo').value;
            const campos = {
                juros: ['capital', 'taxa', 'tempo'],
                capital: ['juros', 'taxa', 'tempo'],
                taxa: ['capital', 'juros', 'tempo'],
                prazo: ['capital', 'juros', 'taxa']
            };

            // Ocultar todos os campos inicialmente, exceto o select
            document.querySelectorAll('.input-group').forEach(grupo => {
                grupo.style.display = 'none';
            });

            // Exibir o grupo do select sempre
            document.getElementById('grupo-calculo').style.display = 'block';

            // Exibir apenas os campos necessários para o cálculo selecionado
            if (campos[calculo]) {
                campos[calculo].forEach(campo => {
                    document.getElementById(`grupo-${campo}`).style.display = 'block';
                });
            }
        }
    </script>
</head>
<body onload="atualizarCampos()">
    <div class="container">
        <h1>🧮 Calculadora Financeira</h1>
        <form method="POST">
            <div class="input-group" id="grupo-calculo">
                <label for="calculo">Escolha o que calcular:</label>
                <select name="calculo" id="calculo" onchange="atualizarCampos()">
                    <option value="juros">Juros</option>
                    <option value="capital">Capital</option>
                    <option value="taxa">Taxa de Juros</option>
                    <option value="prazo">Prazo</option>
                </select>
            </div>

            <div class="input-group" id="grupo-capital">
                <label for="capital">Capital (R$):</label>
                <input type="number" name="capital" id="capital" step="0.01">
            </div>

            <div class="input-group" id="grupo-taxa">
                <label for="taxa">Taxa de Juros (%):</label>
                <input type="number" name="taxa" id="taxa" step="0.01">
            </div>

            <div class="input-group" id="grupo-juros">
                <label for="juros">Juros (R$):</label>
                <input type="number" name="juros" id="juros" step="0.01">
            </div>

            <div class="input-group" id="grupo-tempo">
                <label for="tempo">Tempo (meses):</label>
                <input type="number" name="tempo" id="tempo">
            </div>

            <button type="submit">Calcular</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calculo'])) {
            $calculo = $_POST['calculo'];
            echo "<div class='resultado'>";
            if ($calculo === 'juros') {
                echo "<h2>Cálculo de Juros:</h2>";
                echo "<p>Implemente aqui o cálculo de juros.</p>";
            } elseif ($calculo === 'capital') {
                echo "<h2>Cálculo de Capital:</h2>";
                echo "<p>Implemente aqui o cálculo de capital.</p>";
            } elseif ($calculo === 'taxa') {
                echo "<h2>Cálculo de Taxa de Juros:</h2>";
                echo "<p>Implemente aqui o cálculo da taxa.</p>";
            } elseif ($calculo === 'prazo') {
                echo "<h2>Cálculo de Prazo:</h2>";
                echo "<p>Implemente aqui o cálculo do prazo.</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>

