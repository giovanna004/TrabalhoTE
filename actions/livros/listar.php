<?php
session_start();
require_once("../../conf/con_bd.php");
   
function listarlivros($con_bd,$id_livro,$dadoslivro,$arquivocapa){
        $status = "error";
        $message = "";

        if (!empty($id_livro) &&  $con_bd!==false) {
            
            if ($con_bd !== false) {
                $titulo = mysqli_real_escape_string($con_bd, $dadoslivro['titulo'] ?? "");
                $autor  = mysqli_real_escape_string($con_bd, $dadoslivro['autor'] ?? "");
                $paginas = mysqli_real_escape_string($con_bd,$dadoslivro['paginas'] ?? "");
                $genero_id = isset($dadoslivro['genero']) ? intval($dadoslivro['genero']) : "NULL";
            

                $sql_lista = "SELECT id, titulo, capa FROM tb_livros";

                $result = mysqli_query($con_bd, $sql_lista);

                if($result){
                    $status = "success";
                
                    if(isset($arquivocapa) && is_array($arquivocapa)){
                        if(is_uploaded_file($arquivocapa['tmp_name'])){
                            $ext_file = pathinfo($arquivocapa['name'], PATHINFO_EXTENSION);
                            $path_capa = "../../uploads/capas/capa-livro-".$id_livro.".".$ext_file;
                            if(move_uploaded_file($arquivocapa['tmp_name'], $path_capa)) {
                                $sql_update = "UPDATE tb_livros SET capa='$path_capa' WHERE id=$id_livro";
                                mysqli_query($con_bd, $sql_update);
                            }
                        }

                    }
                    $message = "Livro listado com sucesso!!!";
                } else {
                    $error = mysqli_error($con_bd);
                    $message = "Erro listando livro: " . $error;
                }
        }else{
            $message = "ID do livro não fornecido.";
        }
        return [
            "status" => $status,
            "message" => $message
        ];
    }
}

$id_livro = (int) ($_POST['id'] ?? 0);
$dadoslivro = [
    "titulo" => $_POST['titulo'] ?? "",
    "autor" => $_POST['auto'] ?? "",
    "paginas" => $_POST['paginas'] ?? "",
    "genero" => $_POST['genero'] ?? null
];



$result = listarlivros($con_bd,$id_livro,$dadoslivro,$_FILES['capa'] ?? null);

$_SESSION['status'] = $result['status'];
$_SESSION['message'] = $result['message'];

header("Location: ../../form-atualiza-livro.php?id=".$id_livro);

exit;