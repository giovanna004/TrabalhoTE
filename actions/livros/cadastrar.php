<?php
    session_start();

function cadastraLivro($titulo,$autor,$paginas,$genero_id = null,$capa=null){
   
        $titulo = $_POST["titulo"] ?? "";
        $autor = $_POST["autor"]  ?? "";
        $paginas = $_POST["paginas"] ?? "";
        $genero_id = isset($_POST["genero"]) ? intval($_POST['genero']) : "NULL";

        $status = "error";
        $message = "";
    
        if( !empty($titulo) && !empty($autor) && !empty($paginas)) {

            require_once("../../conf/con_bd.php");

            if($con_bd !== false){

                $titulo = mysqli_real_escape_string($con_bd, $titulo);
                $autor = mysqli_real_escape_string($con_bd, $autor);
                $paginas = mysqli_real_escape_string($con_bd, $paginas);
                $generoVal = $genero_id ? $genero_id : "NULL";
                

                $sql_insert = "INSERT INTO tb_livros(genero_id,titulo, autor, paginas) VALUES ($generoVal,'$titulo','$autor','$paginas');";

                $result = mysqli_query($con_bd, $sql_insert);

                if($result === true){

                    $status = "success";
                    if(!empty($_FILES['capa']['name'])){
                        $arr_capa_arquivo = $_FILES['capa'];

                        if(is_uploaded_file($arr_capa_arquivo['tmp_name'])){
                            
                            $ext_file = pathinfo($arr_capa_arquivo['name'], PATHINFO_EXTENSION);
                            $nome_arquivo = "capa-livro-".$capa_id.".".$ext_file;
                            $path_capa = "../../uploads/capas/".$nome_arquivo;

                            if(move_uploaded_file($arr_capa_arquivo['tmp_name'], $path_capa)) {
                                $sql_update = "UPDATE tb_livros SET capa='".mysqli_real_escape_string($con_bd,$nome_arquivo)."' WHERE id=$capa_id";
                                mysqli_query($con_bd, $sql_update);
                            }

                        }

                    }
                    $message = "Livro cadastrado com sucesso!";
                }else {
                    $message = "Erro cadastrando livro: " . mysqli_error($con_bd);
                }
            }else{
                $message = "Erro de  conexão  com o banco.";
            }
        } else{
            $message = "Para fazer o cadastro é necessário preencher os campos";
        }

    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;
    header("Location: ../../form-cadastro-livros.php?entidade=livro&view=cadastro");
    exit;
}
?>  