<?php


    $id_livro = (int) $_GET['id'];

    $sql_livro = "SELECT * FROM tb_livros WHERE id=".$id_livro;

    $result = mysqli_query($con_bd,$sql_livro);

?>

    <?= isset($_SESSION["message"]) ? $_SESSION["message"] : "" ?>
    <?php

        unset($_SESSION["message"]);

    ?>

    <?php

        if (mysqli_num_rows($result) > 0) {

            $dados_aluno = mysqli_fetch_assoc($result);

    ?>


    <form 
     action="./actions/alunos/atualizar.php?id=<?= $dados_aluno['id'] ?>" 
     method="POST">
        <input type="hidden" name="id-aluno" value="<?= $dados_aluno['id'] ?>">
        RGA: <input type="text" name="rga-aluno"
        value="<?= $dados_aluno['rga'] ?>" />
        <br>
        Nome: <input type="text" name="nome-aluno"
        value="<?= $dados_aluno['nome'] ?>" />
        <br>
        <button type="submit">Atualizar</button>
    </form>

    <?php
        }
    ?>