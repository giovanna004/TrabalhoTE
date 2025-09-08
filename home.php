<?php

    session_start();
    require_once('./conf/con_bd.php');
    require_once('./conf/map.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <meta name="description" content="BookStan - Cadastro e Avaliações de Leitura">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="website icon" type="png" href="imagens/icon.png">
</head>
<body>
    <header class="cabecalho">
        <div>
            <a class="titulo">BookStan</a>
            <a class="subtitulo">Cadastro e Avaliações de Leitura</a>
        </div>
    </header>

    <main class="principal">
        <nav class="navegacao"></div>
            <ul>
                <li class="ativo"><a>Página Inicial</a></li>
                <li><a href="form-cadastro-livros.php">Novo Livro</a></li>
                <li><a>Leituras Atuais</a></li>
                <li><a>Leituras Desejadas</a></li>
                <li><a>Avaliações</a></li>
                
            </ul>
        </nav>

        <div class="corpo">
            <div class="estante">
                <legend>Minha Estante</legend>

                <div class="livro">
                    <a href="form-cadastro-livros.php">
                        <img class="adiciona" src="imagens/adicionar.png" alt="adicionar">
                    </a>
                </div>

                <?php
                    require_once("conf/con_bd.php");

                    if($con_bd !== false) {

                        $sql = "SELECT titulo, capa FROM tb_livros";
                        $result = mysqli_query($con_bd, $sql);

                        if($result === true && $result -> num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="livro">';
                                echo '<img src"' .htmlspecialchars($row['capa']) . '"alt ="' . htmlspecialchars_decode($row['titulo']) . '">';
                                echo '</div>';
                            }
                        }

                    } else {
                        $message = mysqli_error($con_bd);
                    }

                ?>
                
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        </div>
    </main>

    <footer class="rodape">
        <div class="conteudo-rodape">
            <p>Trabalho</p>
            <p>Tópicos especiais e Desenvolvimento de Sistemas I</p>
            <p>Realizado por Giovanna Salvador e Emilly Rodrigues</p>
            <p>&copy; 2024 BookStan. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>