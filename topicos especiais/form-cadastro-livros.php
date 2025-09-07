<?php
    session_start();
    require_once('./conf/con_bd.php')
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <meta name="description" content="BookStan - Cadastro e Avaliações de Leitura">
    <link rel="stylesheet" type="text/css" href="style.css">
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
                <li><a href="home.html">Página Inicial</a></li>
                <li class="ativo"><a>Novo Livro</a></li>
                <li><a>Leituras Atuais</a></li>
                <li><a>Últimas Leituras</a></li>
                <li><a>Leituras Desejadas</a></li>
                <li><a>Avaliações</a></li>
            </ul>
        </nav>
        <div class="corpo">
            <form enctype="multipart/form-data" action="./actions/livros/cadastro.php" method="post">
                <fieldset>
                    <label for="imagem" class="upload-label">
                        Escolher Capa
                    </label>
                    <input id="imagem" name="capa" class="upload-input" type="file" accept="image/png, image/jpeg"/>

                    <legend>Dados do Livro</legend>
                    
                    <label for="titulo-livro">Título:</label>
                    <input id="titulo-livro" type="text" name="titulo"/>
                    
                    <label for="autor-livro">Autor:</label>
                    <input id="autor-livro" type="text" name="autor"/>
                    
                    <label for="paginas-livro">Número de Páginas:</label>
                    <input id="paginas-livro" type="number" name="paginas"/>
                    
                    <label for="lista-genero">Gênero:</label>
                    <select id="lista-genero" name="genero">
                        <option value="0"> - Selecione um gênero - </option>
                        <?php
                             $sql_generos = "SELECT * FROM tb_generos ORDER BY nome ASC;";

                             $result = mysqli_query($con_bd, $sql_generos);

                             while( $dados_generos = mysqli_fetch_assoc($result)){
                                ?>
                                <opction value="<?= $dados_generos['id'] ?>">
                                    <?= $dados_generos['cod']." - ".$dados_generos['nome']  ?>
                                </option>
                                <?php
                             }
                        ?>
                    </select>
                    
                    <input type="submit" value="Enviar"/>
                </fieldset>
            </form>
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