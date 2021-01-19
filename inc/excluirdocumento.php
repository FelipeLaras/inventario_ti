<?php
require_once('../bd/conexao.php');

$updateDeletar = "UPDATE manager_inventario_anexo SET deletar = 1 WHERE id_anexo = ".$_GET['id']."";

if(!$result = $conn->query($updateDeletar)){
    printf('ERRO[1]: %s\n', $conn->error);
    exit;
}


header('Location: ../front/funcionariodocumentos.php?pagina=3');

$conn->close();

?>