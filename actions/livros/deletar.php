<?php
 session_start();

function deletalivro($id_livro){
        $status = "error";
        $message = "";

        if (!empty($id_livro)) {
            require_once("../../conf/con_bd.php");

            if ($con_bd !== false) {
                
                $sql_delete = "DELETE FROM tb_livros WHERE id=".intval($id_livro);
                $result = mysqli_query($con_bd, $sql_delete);

                if($result ===true){
                    $message = "Livro deletado com sucesso!";
                    $status = "success";
                } else {
                    $error = mysqli_error($con_bd);
                    $message = "Livro não foi deletado " . $error;
                }
            }else{
                $message = "Erro de conexão com o banco.";
            }
        }else{
            $message = "Livro não encontrado.";
        }
        
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;

    header("Location: ../../home.php");
    exit;
}

if(isset($_POST['exclui_livro'])){
    $id = (int) $_POST['exclui_livro'];
    deletalivro($id); 
}

?>