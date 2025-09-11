<?php
    session_start();

    if (isset($_SESSION['message'])) {
        echo "<div class='alert {$_SESSION['status']}'>
                {$_SESSION['message']}
            </div>";
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    }
    
    require_once('./conf/con_bd.php')
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Livro</title>
    <meta name="description" content="BookStan - Editar livros">
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
                <li><a href="home.php">Página Inicial</a></li>
                <li><a href="form-cadastro-livros.php">Novo Livro</a></li>
                <li><a href="listar-generos.php">Gêneros Literários</a></li>
                <li><a>Leituras Desejadas</a></li>
                <li><a>Avaliações</a></li>
            </ul>
        </nav>
        <div class="corpo">
            <?php
                if(isset($_GET['id'])){
                    $livro_id = mysqli_real_escape_string($con_bd, $_GET['id']);
                    $sql = "SELECT l.*, g.nome AS genero_nome
                            FROM tb_livros l
                            JOIN tb_generos g ON g.id = l.genero_id
                            WHERE l.id =".$livro_id;
                    $result = mysqli_query($con_bd, $sql);

                    if(mysqli_num_rows($result) > 0){
                        $dados_livros = mysqli_fetch_array($result);

                    }
            ?>

            <form class="visualizar-livro" enctype="multipart/form-data" action="actions\livros\listar.php" method="post">
                <fieldset>
                    <legend><?=$dados_livros['titulo']?></legend>

                    <input type="hidden" name="id" value="<?=$dados_livros['id']?>"/>

                    <?php
                            if(!empty($dados_livros['capa'])): ?>
                                <img class="capa-visualiza" src="uploads/capas/<?=$dados_livros['capa']?>" alt="Capa do livro" style="max-width: 200px; display: block; margin-top: 10px; ">
                            
                    <?php endif; ?>
                    
                    <label for="autor-livro">Autor:</label>
                    <input id="autor-livro" type="text" value="<?=$dados_livros['autor']?>" name="autor" readonly/>
                    
                    <label for="paginas-livro">Número de Páginas:</label>
                    <input id="paginas-livro" type="number" value="<?=$dados_livros['paginas']?>"  name="paginas" readonly/>
                    
                    
                    <label for="lista-genero">Gênero:</label>
                    <input  id="lista-genero" value="<?=$dados_livros['genero_nome']?>" name="genero" readonly/>

                    <div class="acoes">
                        <button type="submit" name="exclui_livro" value="<?= $dados_livros['id'] ?>" class="acao excluir" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                        <a href="form-atualiza-livro.php?id=<?= $dados_livros['id'] ?>" class="acao editar">Editar</a>
                    </div>
                           
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
            <p>Trabalho de Tópicos especiais e Desenvolvimento de Sistemas I</p>
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