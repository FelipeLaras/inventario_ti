<?php
session_start();
require_once('../bd/conexao.php');

//DATA DE HOJE
$dataHoje = date('d/m/Y');

//removendo Offfice

$update = "UPDATE manager_office SET id_equipamento = '".$_POST['equip']."' WHERE id = '" . $_GET['id'] . "'";

if (!$result = $conn->query($update)) {
    printf('ERRO[1]: %s\n', $conn->error);
} else {

    $insertLog = "INSERT INTO manager_log (id_equipamento,  data_alteracao, usuario, tipo_alteracao) 
                    VALUES ('" . $_POST['equip'] . "', '" . $dataHoje . "', '" . $_SESSION["id"] . "', '15')";

    if (!$log = $conn->query($insertLog)) {
        printf('Erro[2]: %s\n', $conn->error);
    } else {
        header('location: ../front/editequipamento.php?pagina=5&id_equip=' . $_POST['equip'] . '');
    }
}

$conn->close();