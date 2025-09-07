<?php
    session_start();

    $titulo = $_POST["titulo-livro"] ?? "";
    $autor = $_POST["autor-livro"]  ?? "";
    $paginas = $_POST["paginas-livro"] ?? "";
    $genero_id = $_POST["lista-genero"] ? intval($_POST['lista-genero']) : 'null';

    


    $status = "error";
   
    if( !empty($titulo) && !empty($autor) && !empty($paginas)) {
        require_once("../../conf/con_bd.php");

        if($con_bd !== false){
            $titulo = mtsqli_real_escape_string($con_bd, $titulo);
            $autor = mtsqli_real_escape_string($con_bd,$autor);
            $paginas = mtsqli_real_escape_integer($con_bd,$paginas);

            $sql_insert = "INSERT INTO tb_livros(genero_id,titulo, autor, pagina, genero) VALUES ($genero_id,'$titulo','$autor','$paginas');";

            $result = mysqli_query($con_bd, $sql_insert);

            if($result === true){
                $message =  "Livro cadastrado com sucesso!";
            }else {
                $error = mysqli_error($con_bd);
                $message = "Erro cadastrando livro: " . $error;
            }
        } 
    } else{
         $message = "Para fazer o cadastro é necessário preencher os campos";
    }

$_SESSION['status'] = $status;
$_SESSION['message'] = $message;
header("Location: ../../index.php?entidade=livro&view=cadastro");
?>