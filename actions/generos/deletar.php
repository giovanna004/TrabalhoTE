<?php
    session_start();

    $id_genero = (int) $_POST['exclui_genero'];

    $status = "error";

    if (!empty($id_genero)) {
        require_once("../../conf/con_bd.php");

         if ($con_bd !== false) {

             $sql_delete = "DELETE FROM tb_generos WHERE id=".$id_genero;
             $result = mysqli_query($con_bd, $sql_delete);

             if($result ===true){
                $message = "Gênero deletado com sucesso.";
                $status = "success";
             } else {
                $error = mysqli_error($con_bd);
                $message = "O gênero não foi deletado." . $error;
            }
         }

    }else{
        $message = "Gênero não encontrado.";
    }
    
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;

    header("Location: ../../listar-generos.php");
    exit();

?>