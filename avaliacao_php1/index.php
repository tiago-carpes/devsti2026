<?php
    session_start();
    if (!isset($_SESSION['poligonos'])) {
        $_SESSION['poligonos'] = [];
        $_SESSION['i'] = 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Avaliação PHP 1</h1>
    <p>Insira abaixo as dimensões do polígono.</p>
    <form method="POST" action="">
        <label>Altura:</label>
        <input type="number" name="altura" required autocomplete="off">

        <label>Comprimento:</label>
        <input type="number" name="comprimento" required autocomplete="off">

        <button type="submit" name="calcular" id="cadastro">Calcular</button>
    </form>
    <form method="POST" action="">
        <button type="submit" name="mostrar">Mostrar informações</button>
        <button type="submit" name="limpar" class="vermelho">Limpar a sessão</button>
    </form>
    <?php
        if (isset($_POST['calcular'])) {
            $numero = $_SESSION['i']+1;
            $altura = $_POST['altura'];
            $comprimento = $_POST['comprimento'];
            $area = $altura*$comprimento;
            if ($altura==$comprimento) {
                $tipo = 'Quadrado';
            }
            else if ($altura > $comprimento) {
                $tipo = 'Retângulo Vertical';
            }
            else {
                $tipo = 'Retângulo Horizontal';
            }
            $novoPoligono = [
                'numero' => $numero,
                'altura' => $altura,
                'comprimento' => $comprimento,
                'area' => $area,
                'tipo' => $tipo
            ];
            $_SESSION['poligonos'][$_SESSION['i']] = $novoPoligono;
            $_SESSION['i'] += 1;
            echo "<h1>O polígono informado é um $tipo de área $area</h1>";
        }

        if (isset($_POST['mostrar'])) : ?>
            <?php if ($_SESSION['i'] != 0) : ?>
                <h1>Listagem das informações armazenadas:</h1>
                <div class="resultado">
                    <div class="interno">
                        <table>
                            <thead>
                                <tr>
                                    <th>Número do polígono</th>
                                    <th>Altura</th>
                                    <th>Comprimento</th>
                                    <th>Área</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php foreach ($_SESSION['poligonos'] as $p) : ?>
                                <tr>
                                    <td><?=$p['numero']?></td>
                                    <td><?=$p['altura']?></td>
                                    <td><?=$p['comprimento']?></td>
                                    <td><?=$p['area']?></td>
                                    <td><?=$p['tipo']?></td>
                                </tr>
                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php else: ?>
                <h1>Nenhum dado foi cadastrado ainda.</h1>
            <?php endif;
        endif;

        if (isset($_POST['limpar'])) {
            session_destroy();
            header("Location: index.php");
            exit;
        }
    ?>
</body>
</html>
