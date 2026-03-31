<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapa 04</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-3">
        <h1>Mapa 04</h1>

        <form method="post">

            <?php
            for ($i = 0; $i < 5; $i++) {
            ?>
                <div class="border p-3 mb-3">
                    <h5>Item <?= $i + 1 ?></h5>

                    <div class="mb-3">
                        <label class="form-label">Nome do item:</label>
                        <input type="text" name="nome[]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preço:</label>
                        <input type="number" step="0.01" name="preco[]" class="form-control" required>
                    </div>
                </div>
            <?php
            }
            ?>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomes = $_POST["nome"];
            $precos = $_POST["preco"];

            $mapa = [];

            $tamanho = count($nomes);

            for ($i = 0; $i < $tamanho; $i++) {

                $preco = $precos[$i];

                $preco = $preco * 1.15;

                $mapa[$nomes[$i]] = $preco;
            }


            asort($mapa);

            echo "Resultados:<br>";

            foreach ($mapa as $nome => $preco) {

                echo "Nome: ", $nome, "<br>";
                echo "Preço com imposto: R$ " . number_format($preco, 2, ',', '.'), "<br>";
            }
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>