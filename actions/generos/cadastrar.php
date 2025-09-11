<?php
    session_start();

    $genero = $_POST["nome-genero"] ?? "";
    $descricao = $_POST["descricao"] ?? "";

    $status = "error";
   
    if( !empty($genero) && !empty($descricao)) {

        require_once("../../conf/con_bd.php");

        if($con_bd !== false){

            $genero = mysqli_real_escape_string($con_bd, $genero);
            $descricao = mysqli_real_escape_string($con_bd, $descricao);

            $sql_insert = "INSERT INTO tb_generos(nome, descricao) VALUES ('$genero','$descricao');";
            $result = mysqli_query($con_bd, $sql_insert);

            if($result === true){
                $status = "success";
                echo  "Gênero cadastrado com sucesso!";
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
header("Location: ../../listar-generos.php?entidade=livro&view=cadastro");

?>  