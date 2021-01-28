<?php
session_start();
require_once('../bd/conexao.php');

//removendo Offfice

$update = "UPDATE manager_office SET id_equipamento = 0 WHERE id = '".$_GET['id_of']."'";

if(!$result = $conn->query($update)){
    printf('ERRO[1]: %s\n', $conn->error);
}else{
    header('location: ../front/editequipamento.php?pagina=5&id_equip='.$_GET['id_equip'].'');
}

$conn->close();