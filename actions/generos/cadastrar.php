<?php
    session_start();

    $genero = $_POST["nome"] ?? "";
    $descricao = $_POST["descricao"] ?? "";
    $genero_id = isset($_POST["genero"]) ? intval($_POST['genero']) : "NULL";

    $status = "error";
   
    if( !empty($genero) && !empty($descricao)) {

        require_once("../../conf/con_bd.php");

        if($con_bd !== false){

            $genero = mysqli_real_escape_string($con_bd, $genero);
            $descricao = mysqli_real_escape_string($con_bd, $descricao);
            $generoVal = $genero_id ? $genero_id : "NULL";

            $sql_insert = "INSERT INTO tb_genero(nome, descricao) VALUES ('$nome','$descricao');";
            $result = mysqli_query($con_bd, $sql_insert);

            if($result === true){
                $status = "success";
                echo  "genero cadastrado com sucesso!";
            }else {
                $message = mysqli_error($con_bd);
                $message = "Erro cadastrando genero: " . mysqli_error($con_bd);
            }
        } 
    } else{
         $message = "Para fazer o cadastro é necessário preencher os campos";
    }

$_SESSION['status'] = $status;
$_SESSION['message'] = $message;
header("Location: ../../form-cadastro-livros.php?entidade=livro&view=cadastro");

?>  