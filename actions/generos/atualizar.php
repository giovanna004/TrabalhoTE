<?php
    session_start();

  
    $nome = $_POST["nome-genero"] ?? "";
    $descricao = $_POST["descricao"]  ?? "";
    $genero_id = isset($_POST["id"]) ? intval($_POST['id']) : "NULL";

    $status = "error";
    if ($genero_id > 0) {
        require_once("../../conf/con_bd.php");

         if ($con_bd !== false) {
            $nome = mysqli_real_escape_string($con_bd, $nome );
            $descricao  = mysqli_real_escape_string($con_bd,  $descricao);
            $generoVal = $genero_id ? $genero_id : "NULL";
             $sql_atualiza = "UPDATE 
                                 tb_generos
                             SET 
                                 nome='$nome',
                                 descricao='$descricao'
                             WHERE
                                 id='".$genero_id."'";
             $result = mysqli_query($con_bd, $sql_atualiza);
             if($result ===true){
                $status = "success";
                $message = "genero atualizado com sucesso!!!";
            } else {
                $message = "Para fazer o cadastro é necessário preencher os campos";
            }
         }else{
            $message = "Erro de conexão com o banco.";
         }
    }else{
        $message = "genero não encontrado.";
    }
    
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;

    header("Location: ../../listar-generos.php?entidade=livro&view=atualizacao");
    exit;

?>