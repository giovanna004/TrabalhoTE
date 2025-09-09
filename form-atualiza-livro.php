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
    <meta name="description" content="BookStan - Editar livros">
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
                <li><a href="home.php">Página Inicial</a></li>
                <li class="ativo"><a>Novo Livro</a></li>
                <li><a>Leituras Atuais</a></li>
                <li><a>Leituras Desejadas</a></li>
                <li><a>Avaliações</a></li>
            </ul>
        </nav>
        <div class="corpo">
            <?php
                if(isset($_GET['id'])){
                    $livro_id = mysqli_real_escape_string($con_bd, $_GET['id']);
                    $sql = "SELECT * FROM tb_livros WHERE id=".$livro_id;
                    $result = mysqli_query($con_bd, $sql);

                    if(mysqli_num_rows($result) > 0){
                        $dados_livros = mysqli_fetch_array($result);

                    }
            ?>

            <form enctype="multipart/form-data" action="actions\livros\cadastrar.php" method="post">
                <fieldset>
                    <legend>Editar dados do Livro</legend>
                    
                    <label for="imagem" class="upload-label">
                        Escolher Capa
                    </label>
                    <input id="imagem" name="capa" class="upload-input" value="<?=$dados_livros['capa']?>" type="file" accept="image/png, image/jpeg"/>
                    <span id="nome-arquivo" class="nome-arquivo">Nenhum arquivo escolhido.</span>

                    
                    <label for="titulo-livro">Título:</label>
                    <input id="titulo-livro" type="text" value="<?=$dados_livros['titulo']?>" name="titulo"/>
                    
                    <label for="autor-livro">Autor:</label>
                    <input id="autor-livro" type="text" value="<?=$dados_livros['autor']?>" name="autor"/>
                    
                    <label for="paginas-livro">Número de Páginas:</label>
                    <input id="paginas-livro" type="number" value="<?=$dados_livros['pagina']?>"  name="paginas"/>
                    
                    
                    <label for="lista-genero">Gênero:</label>
                    <select id="lista-genero" name="genero" >
                        <option value="<?=$dados_livros['genero_id']?>"> - Selecione um gênero - </option>
                        <?php
                          
                            $sql_generos = "SELECT * FROM tb_generos ORDER BY nome ASC";

                            $result = mysqli_query($con_bd, $sql_generos);

                            while ($dados_generos = mysqli_fetch_assoc($result)) {
                                ?>
                        <option value="<?= $dados_generos['id'] ?>">
                            <?= $dados_generos['nome'] ?>
                        </option>
                                <?php
                            }
                        ?>
                    </select>
                    <input type="submit" value="Editar"/>
                </fieldset>
            </form>
            <?php
                }else{
                    echo "<h5>Livro não encontrado.</h5>";
                }
            ?>
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
    <script>
        const inputImagem = document.getElementById('imagem');
        const nomeArquivoSpan = document.getElementById('nome-arquivo');

        inputImagem.addEventListener('change', () => {
            if (inputImagem.files.length > 0) {
                nomeArquivoSpan.textContent = inputImagem.files[0].name;
            } else {
                nomeArquivoSpan.textContent = 'Nenhum arquivo escolhido.';
            }
        });
    </script>
</body>
</html>