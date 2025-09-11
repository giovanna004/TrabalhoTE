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
    <title>Atualizar Livro</title>
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
                $dados_generos = [
                    'nome' => '',
                    'descricao' => ''
                ];
                $action = "actions/generos/cadastrar.php"; 

                if (isset($_GET['id'])) {
                    $genero_id = mysqli_real_escape_string($con_bd, $_GET['id']);
                    $sql = "SELECT nome, descricao FROM tb_generos WHERE id = $genero_id";
                    $result = mysqli_query($con_bd, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $dados_generos = mysqli_fetch_assoc($result);
                        $action = "actions/generos/atualizar.php?id=$genero_id"; 
                    }
                }
            ?>

            <form class="editar-genero" enctype="multipart/form-data" action="<?=$action?>" method="post">
                <fieldset>
                    <legend><?= (isset($_GET['id']) && is_numeric($_GET['id'])) ? "Editar Gênero" : "Cadastrar Gênero" ?></legend>
                    
                    <?php if (isset($genero_id)): ?>
                        <input type="hidden" name="id" value="<?=$genero_id?>">
                    <?php endif; ?>

                    <label for="genero-nome">Gênero:</label>
                    <input id="genero-nome" type="text" name="nome-genero" 
                        value="<?=$dados_generos['nome']?>" required />
                    
                    <label for="descricao-genero">Descrição:</label>
                    <input id="descricao-genero" type="text" name="descricao" 
                        value="<?=$dados_generos['descricao']?>" required />

                    <input type="submit" value="<?= (isset($_GET['id']) && is_numeric($_GET['id'])) ? "Editar" : "Cadastrar" ?>"/>
                </fieldset>
            </form>

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