<?php
    session_start();
function atualuzalivro(){
    $id_livro = (int) $_POST['id'];
    $titulo = $_POST["titulo"] ?? "";
    $autor = $_POST["autor"]  ?? "";
    $paginas = $_POST["paginas"] ?? "";
    $genero_id = isset($_POST["genero"]) ? intval($_POST['genero']) : "NULL";
   
    $status = "error";
    $message = "";

    if (!empty($id_livro)) {
        require_once("../../conf/con_bd.php");
         if ($con_bd !== false) {
            $titulo = mysqli_real_escape_string($con_bd, $titulo);
            $autor  = mysqli_real_escape_string($con_bd, $autor);
            $paginas = mysqli_real_escape_string($con_bd,$paginas);
            $generoVal = $genero_id ? $genero_id : "NULL";

             $sql_atualiza = "UPDATE 
                                 tb_livros
                             SET 
                                 titulo='$titulo',
                                 autor='$autor',
                                 paginas='$paginas',
                                 genero_id=$generoVal
                             WHERE
                                 id='".$id_livro."'";
             $result = mysqli_query($con_bd, $sql_atualiza);
             if($result ===true){
                $status = "success";
                if(!empty($_FILES['capa']['name'])){

                    $arr_capa_arquivo = $_FILES['capa'];

                    if(is_uploaded_file($arr_capa_arquivo['tmp_name'])){
                        $ext_file = pathinfo($arr_capa_arquivo['name'], PATHINFO_EXTENSION);
                        $nome_arquivo = "capa-livro-".$id_livro.".".$ext_file;
                        $path_capa = "../../uploads/capas/".$nome_arquivo;

                        if(move_uploaded_file($arr_capa_arquivo['tmp_name'], $path_capa)) {
                            $sql_update = "UPDATE tb_livros SET capa'".mysqli_real_escape_string($con_bd,$nome_arquivo);
                            mysqli_query($con_bd, $sql_update);
                        }
                    }
                }
                 $message = "Livro atualizado com sucesso!!!"; 
            } else {
                $error = mysqli_error($con_bd);
                $message = "Erro atualizando livro: " . $error;
            }
         }else{
            $message = "Erro de conexão com o banco.";
         }
    }else{
        $message = "Livro não encontrado.";
    }
    
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;

    header("Location: ../../form-atualiza-livro.php?id=".$id_livro);
    exit;
}

?>