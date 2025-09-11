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
    <title>Gêneros</title>
    <meta name="description" content="BookStan - Cadastro e Avaliações de Leitura">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="website icon" type="png" href="imagens/icon.png">
    <link rel="website icon" type="png" href="imagens/icon.png">
</head>
<body>
    <header class="cabecalho">
        <div>
            <a class="titulo">BookStan</a>
            <a class="subtitulo">Cadastro e Avaliações de Leitura</a>
        </div>
    </header>

    <main class="conteudo">
        <nav class="navegacao"></div>
            <ul>
                <li><a href="home.php">Página Inicial</a></li>
                <li><a href="form-cadastro-livros.php">Novo Livro</a></li>
                <li class="ativo"><a>Gêneros Literários</a></li>
                <li><a>Leituras Desejadas</a></li>
                <li><a>Avaliações</a></li>
                
            </ul>
        </nav>

        <div class="corpo">
            <div class="estante">
                <div class="livro">
                    <a href="form-cadastro-livros.php">
                        <img class="adiciona" src="imagens/adicionar.png" alt="adicionar">
                    </a>
                </div>

                <?php
                    require_once("conf/con_bd.php");

                    if($con_bd !== false) {

                        $sql = "SELECT id, nome, descricao FROM tb_generos";
                        $result = mysqli_query($con_bd, $sql);

                        if($result && $result -> num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="genero">';
                                    echo '<p>' . htmlspecialchars($row['nome']) . '</p>';
                                    echo '<a href="listar-livros.php?id='.$row['id'].'" class="acao visualizar">
                                        <p>' . htmlspecialchars($row['descricao']) . '</p>
                                    </a>';
                                    echo '<form action="actions/generos/deletar.php" method="POST">
                                        <button type="submit" name="exclui_genero" value="'.$row['id'].'" class="acao excluir" onclick="return confirm(\'Tem certeza que deseja excluir este gênero?\');">
                                                <img src="imagens/excluir.png" alt="excluir">
                                        </button>
                                     </form>';
                                    echo '<a href="form-generos.php?id='.$row['id'].'" class="acao editar">Editar</a>';
                                echo '</div>';
                            }
                        }

                    } else {
                        $message = mysqli_error($con_bd);
                    }

                ?>
                
            </div>

        </div>
    </main>

    <footer class="rodape">
        <div class="conteudo-rodape">
            <p>Trabalho de Tópicos especiais e Desenvolvimento de Sistemas I</p>
            <p>Realizado por Giovanna Salvador e Emilly Rodrigues</p>
            <p>&copy; 2024 BookStan. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>