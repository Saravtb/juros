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
                // Fórmula para calcular os juros
                $capital = isset($_POST['capital']) ? floatval($_POST['capital']) : 0;
                $taxa = isset($_POST['taxa']) ? floatval($_POST['taxa']) / 100 : 0; // Conversão para decimal
                $tempo = isset($_POST['tempo']) ? intval($_POST['tempo']) : 0;

                if ($capital > 0 && $taxa > 0 && $tempo > 0) {
                    // Calculando juros: J = C * i * N
                    $juros = $capital * $taxa * $tempo;
                    echo "<h2>Cálculo de Juros:</h2>";
                    echo "<p>Juros gerados: R$ " . number_format($juros, 2, ',', '.') . "</p>";
                } else {
                    echo "<h2>Erro:</h2>";
                    echo "<p>Por favor, preencha os campos corretamente.</p>";
                }

            } elseif ($calculo === 'capital') {
                // Fórmula para calcular o capital
                $juros = isset($_POST['juros']) ? floatval($_POST['juros']) : 0;
                $taxa = isset($_POST['taxa']) ? floatval($_POST['taxa']) / 100 : 0; // Conversão para decimal
                $tempo = isset($_POST['tempo']) ? intval($_POST['tempo']) : 0;

                if ($juros > 0 && $taxa > 0 && $tempo > 0) {
                    // Fórmula: C = J / (i * N)
                    $capital = $juros / ($taxa * $tempo);
                    echo "<h2>Cálculo de Capital:</h2>";
                    echo "<p>Capital inicial necessário: R$ " . number_format($capital, 2, ',', '.') . "</p>";
                } else {
                    echo "<h2>Erro:</h2>";
                    echo "<p>Por favor, preencha os campos de Juros, Taxa e Tempo corretamente.</p>";
                }

            } elseif ($calculo === 'taxa') {
                // Fórmula para calcular a taxa
                $capital = isset($_POST['capital']) ? floatval($_POST['capital']) : 0;
                $juros = isset($_POST['juros']) ? floatval($_POST['juros']) : 0;
                $tempo = isset($_POST['tempo']) ? intval($_POST['tempo']) : 0;

                if ($capital > 0 && $juros > 0 && $tempo > 0) {
                    // Fórmula: i = J / (C * N) * 100
                    $taxa = ($juros / ($capital * $tempo)) * 100;
                    echo "<h2>Cálculo de Taxa de Juros:</h2>";
                    echo "<p>Taxa de Juros: " . number_format($taxa, 2, ',', '.') . " %</p>";
                } else {
                    echo "<h2>Erro:</h2>";
                    echo "<p>Por favor, preencha os campos de Capital, Juros e Tempo corretamente.</p>";
                }

            } elseif ($calculo === 'prazo') {
                // Fórmula para calcular o prazo
                $capital = isset($_POST['capital']) ? floatval($_POST['capital']) : 0;
                $juros = isset($_POST['juros']) ? floatval($_POST['juros']) : 0;
                $taxa = isset($_POST['taxa']) ? floatval($_POST['taxa']) / 100 : 0;

                if ($capital > 0 && $juros > 0 && $taxa > 0) {
                    // Fórmula: N = J / (C * i)
                    $tempo = $juros / ($capital * $taxa);
                    echo "<h2>Cálculo de Prazo:</h2>";
                    echo "<p>Tempo necessário: " . number_format($tempo, 0, ',', '.') . " meses</p>";
                } else {
                    echo "<h2>Erro:</h2>";
                    echo "<p>Por favor, preencha os campos corretamente.</p>";
                }
            }

            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
