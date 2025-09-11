<?php
    session_start();

    $id_livro = (int) $_POST['id'];
    $titulo = $_POST["titulo"] ?? "";
    $autor = $_POST["autor"]  ?? "";
    $paginas = $_POST["paginas"] ?? "";
    $genero_id = isset($_POST["genero"]) ? intval($_POST['genero']) : "NULL";
   
    if(!empty($_FILES['capa']['name'])){
        $capa= basename($_FILES['capa']['name']); 
    }

    $status = "error";

    if (!empty($id_livro)) {
        require_once("../../conf/con_bd.php");

         if ($con_bd !== false) {
            $titulo = mysqli_real_escape_string($con_bd, $titulo);
            $autor  = mysqli_real_escape_string($con_bd, $autor);
            $paginas = mysqli_real_escape_string($con_bd,$paginas);
            $generoVal = $genero_id ? $genero_id : "NULL";
           

             $sql_lista = "SELECT  * FROM tb_livros WHERE id='".$id_livro."'";

             $result = mysqli_query($con_bd, $sql_lista);

             if($result ===true){
                $status = "success";
               
                if(isset($_FILES['capa']) && is_array($_FILES['capa'])){

                    $arr_capa_arquivo = $_FILES['capa'];

                    if(is_uploaded_file($arr_capa_arquivo['tmp_name'])){
                        
                        $ext_file = pathinfo($arr_capa_arquivo['name'], PATHINFO_EXTENSION);
                        $path_capa = "../../uploads/capas/capa-livro-".$id_livro.".".$ext_file;

                        if(move_uploaded_file($arr_capa_arquivo['tmp_name'], $path_capa)) {
                            $sql_update = "UPDATE tb_livros SET capa='$path_capa' WHERE id=$id_livro";
                            $result_update = mysqli_query($con_bd, $sql_update);
                        }

                    }

                }
                 $message = "Livro listado com sucesso!!!";
                
             } else {
                $error = mysqli_error($con_bd);
                $message = "Erro listando livro: " . $error;
            }
         }

    }else{
        $message = "ID do livro não fornecido.";
    }
    
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;

    header("Location: ../../form-atualiza-livro.php?id=".$id_livro);
    exit();
?>