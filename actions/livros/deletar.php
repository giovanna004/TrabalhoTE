<?php
    session_start();

    $id_livro = (int) $_POST['exclui_livro'];

    $status = "error";

    if (!empty($id_livro)) {
        require_once("../../conf/con_bd.php");

         if ($con_bd !== false) {

             $sql_delete = "DELETE FROM tb_livros WHERE id=".$id_livro;
             $result = mysqli_query($con_bd, $sql_delete);

             if($result ===true){
                $message = "Livro deletado com sucesso.";
                $status = "success";
             } else {
                $error = mysqli_error($con_bd);
                $message = "O livro não foi deletado." . $error;
            }
         }

    }else{
        $message = "Livro não encontrado.";
    }
    
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;

    header("Location: ../../home.php");
    exit();

?>