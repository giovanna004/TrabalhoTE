<?php
    session_start();

    $id_livro = (int) $_GET['id'];
    $titulo = $_POST["titulo-livro"] ?? "";
    $autor = $_POST["autor-livro"]  ?? "";
    $paginas = $_POST["paginas-livro"] ?? "";

    $status = "error";

    if (!empty($nome) && !empty($rga)) {
        require_once("../../conf/con_bd.php");

         if ($con_bd !== false) {
             $titulo = mysqli_real_escape_string($con_bd, $nome);
             $autor  = mysqli_real_escape_string($con_bd, $rga);
             $paginas = mysqli_real_escape_string($con_bd,$paginas);

             $sql_insert = "UPDATE 
                                 tb_livros
                             SET 
                                 titulo='$titulo',
                                 autor='$autor',
                                 paginas='$paginas'
                             WHERE
                                 id='".$id_livro."'";
             $result = mysqli_query($con_bd, $sql_insert);
             if($result ===true){
                  $message = "Livro atualizado com sucesso!!!";
                  $status = "success";
             } else {
                $error = mysqli_error($con_bd);
                $message = "Erro atualizando livro: " . $error;
            }
         }

    }else{
        $message = "Para fazer o cadastro é necessário preencher os campos";
    }
    
$_SESSION['status'] = $status;
$_SESSION['message'] = $message;

header("Location: ../../form-atualiza-livro.php?id=".$id_livro);
?>