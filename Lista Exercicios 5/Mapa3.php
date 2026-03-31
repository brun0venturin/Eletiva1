<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapa 03</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-3">
        <h1>Mapa 03</h1>

        <form method="post">

            <?php
            for ($i = 0; $i < 5; $i++) {
            ?>
                <div class="border p-3 mb-3">
                    <h5>Produto <?= $i + 1 ?></h5>

                    <div class="mb-3">
                        <label class="form-label">Nome do produto:</label>
                        <input type="text" name="nome[]" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Código:</label>
                            <input type="number" name="codigo[]" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Preço:</label>
                            <input type="number" step="0.01" name="preco[]" class="form-control" required>
                        </div>
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
            $codigos = $_POST["codigo"];
            $precos = $_POST["preco"];

            $mapa = [];

            for ($i = 0; $i < count($codigos); $i++) {

                $preco = $precos[$i];

                if ($preco > 100) {
                    $preco = $preco * 0.9;
                }

                $mapa[$codigos[$i]] = [
                    "nome" => $nomes[$i],
                    "preco" => $preco
                ];
            }


            uasort($mapa, function ($a, $b) {
                return strcmp($a["nome"], $b["nome"]);
            });

            echo "Resultados:<br>";

            foreach ($mapa as $codigo => $produto) {
                 
                echo "Código: ", $codigo,"<br>";
                echo "Nome: ", ($produto["nome"]), "<br>";
                echo "Preço: R$ " . number_format($produto["preco"], 2, ',', '.'),"<br>";
                echo "<br>";
            }
               

        }
        ?>

    </div>
</body>

</html>