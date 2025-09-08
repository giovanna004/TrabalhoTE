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
            $titulo = mysqli_real_escape_string($con_bd, $titulo);
            $autor = mysqli_real_escape_string($con_bd,$autor);
            $paginas = mysqli_real_escape_string($con_bd,$paginas);
            

            $sql_insert = "INSERT INTO tb_livros(genero_id,titulo, autor, pagina, genero) VALUES ($genero_id,'$titulo','$autor','$paginas');";

            $result = mysqli_query($con_bd, $sql_insert);

            if($result === true){

                if(isset($_FILES['capa']) && is_array($_FILES['capa'])){

                    $capa_id = mysqli_insert_id($con_bd);

                    $arr_capa_arquivo = $_FILES['capa'];
                    if(is_uploaded_file($arr_capa_arquivo['tmp_name'])){
                        
                        $ext_file = pathinfo($arr_capa_arquivo['name'], PATHINFO_EXTENSION);
                        $path_capa = "../../uploads/capas/capa-livro-".$capa_id.".".$ext_file;

                        if(move_uploaded_file($arr_capa_arquivo['tmp_name'],$path_capa)){
                            $sql_update = "UPDATE tb_livros SET capa='$path_capa' WHERE id=$capa_id;";
                            $result_update = mysqli_query($con_bd, $sql_update);
                        }


                    }

                }
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