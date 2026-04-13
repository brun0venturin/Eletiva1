<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atividade de Recomposição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Atividade de Recomposição</h1>
        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required="">
            </div>
            <div class="row inline-row mb-3">
                <div class="col-md-6">
                    <label for="num1" class="form-label">Número 1:</label>
                    <input type="number" id="num1" name="num1" class="form-control" required="">
                </div>
                <div class="col-md-6">
                    <label for="num2" class="form-label">Número 2:</label>
                    <input type="number" id="num2" name="num2" class="form-control" required="">
                </div>
            </div>
            <div class="mb-3">
                <label for="frase" class="form-label">Frase:</label>
                <input type="text" id="frase" name="frase" class="form-control" required="">
            </div>
            <div class="row inline-row mb-3">
                <div class="col-md-6">
                    <label for="escolha" class="form-label">Operação:</label>
                    <select id="escolha" name="escolha" class="form-select" required="">
                        <option value="soma">Soma</option>
                        <option value="media">Média</option>
                        <option value="tabuada">Tabuada</option>
                        <option value="palindromo">Verificar Palíndromo</option>
                        <option value="produto">Cadastrar Produto</option>
                    </select>
                </div>
                <div class="col-md-6 mt-4">
                    <button type="submit" class="btn btn-primary">Processar</button>
                </div>
            </div>
            
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $frase = $_POST['frase'];
            $opcao = $_POST['escolha'];

            switch ($opcao) {
                case "soma":
                    $resulsoma = $num1 + $num2;
                    echo "O resultado da soma de $num1 + $num2 é igual a $resulsoma";
                    break;

                case "media":
                    $media = ($num1 + $num2) / 2;
                    echo "Média é = $media";
                    break;

                case "tabuada":
                    for ($i = 1; $i <= 10; $i++) {
                        $resu = $num1 * $i;
                        echo "<p>$num1 x $i = $resu </p>";
                    }
                    break;

                case "palindromo":

                    $original = mb_strtolower($frase, 'UTF-8');

                    $invertida = "";

                    for ($i = mb_strlen($original, 'UTF-8') - 1; $i >= 0; $i--) {
                        $invertida .= mb_substr($original, $i, 1, 'UTF-8');
                    }

                    if ($original == $invertida) {
                        echo "A palavra $original é palíndromo!";
                    } else {
                        echo "A palavra $original não é palíndromo!";
                    }
                    break;

                case "produto":
                    $produtos = [
                        "001" => ["nome" => "Smartphone", "preco" => 3000],
                        "002" => ["nome" => "Notebook", "preco" => 4000],
                        "003" => ["nome" => "Videogame", "preco" => 5000]
                    ];
                    uasort($produtos, function ($a, $b) {
                        return strcmp($a["nome"], $b["nome"]);
                    });
                    echo"Produtos:";
                    echo "<p></p>";
                    foreach ($produtos as $codigo => $dados) {
                        echo "<p>Código: $codigo - Nome: {$dados['nome']} - Preço: R$ {$dados['preco']}</p>";
                    }
            } // Fim do Sw
        } //Fim do IF 
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>