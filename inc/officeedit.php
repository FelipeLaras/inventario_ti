<?php
require_once('../bd/conexao.php');


if (!empty($_GET['id'])) {
    $updateOffice = "UPDATE manager_office SET 
    versao = " . $_POST['versao'] . ",
    serial = '" . $_POST['serial'] . "',
    fornecedor = '" . $_POST['fornecedor'] . "',
    empresa = " . $_POST['empresa'] . "
    WHERE id= " . $_GET['id'] . "";

    if (!$result = $conn->query($updateOffice)) {
        printf('ERRO[1]: %s\n', $conn->error);
    } else {
        header('location: ../front/officeedit.php?pagina=5&id=' . $_GET['id'] . '');
    }
} else {

    //SUBINDO ARQUIVO
    if ($_FILES['anexo'] != NULL) {

        $tipo_file = $_FILES['anexo']['type']; //Pegando qual é a extensão do arquivo
        $nome_db = $_FILES['anexo']['name'];
        $caminho = "../documentos/notas/" . $_FILES['anexo']['name']; //caminho onde será salvo o FILE
        $caminho_db = "../documentos/notas/" . $_FILES['anexo']['name']; //pasta onde está o FILE para salvar no Bando de dados

        /*VALIDAÇÃO DO FILE*/
        $sql_file = "SELECT type FROM manager_file_type WHERE type LIKE '" . $tipo_file . "'"; //query de validação 

        $result =  $conn->query($sql_file); //aplicando a query

        if ($tipo_file != NULL) {
            /*TRABALHAMDO COM O RESULTADO DA VALIDAÇÃO*/
            if (!$row = $result->fetch_assoc()) { //se é arquivo valido       
                printf('Erro[2]: %s\n Arquivo Invalido! - POR FAVOR INFORMAR UM ARQUIVO NO FORMATO: <span style="color: red">PDF</span><br />');
                exit;
            } else {
                if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) { //aplicando o salvamento
                    echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho . "<br />";
                } else {
                    echo "Erro[3]: Arquivo não foi enviado! - CONTATO O ADMINISTRADOR DO SISTEMA<br />";
                } //se caso não salvar vai mostrar o erro!
            }
        }

        //SALVANDO NO BANCO DE DADOS
        $insert = "INSERT INTO manager_office (id_equipamento, locacao, empresa, versao, serial, fornecedor, numero_nota, file_nota, file_nota_nome, data_nota) 
        VALUES 
        ('0',
        '" . $_POST['empresa'] . "', 
        '" . $_POST['empresa'] . "', 
        '" . $_POST['versao'] . "',
        '" . $_POST['serial'] . "',
        '" . $_POST['fornecedor'] . "',
        '" . $_POST['numero_nota'] . "',
        '" . $caminho_db . "',
        '" . $nome_db . "', 
        '" . $_POST['data_nota'] . "')";

        if (!$result = $conn->query($insert)) {
            printf('ERRO[4]: %s\n', $conn->error);
        } else {
            //caso já tenha um id de equipamento será vinculado ao mesmo!

            if(!empty($_GET['id_equip'])){
                $queryOffice = "SELECT max(id) AS id FROM manager_office";
                $resultOffice = $conn->query($queryOffice);
                $idOffice = $resultOffice->fetch_assoc();
    
                //salvando
                $updateEquipamento = "UPDATE manager_office SET id_equipamento = '".$_GET['id_equip']."' WHERE id = '".$idOffice['id']."'";
                if(!$resultUPdate = $conn->query($updateEquipamento)){
                    printf('ERRO[5]: não foi possivel vincular equipamento pelo seguinte erro: %s\n', $conn->error);
                    exit;
                }else{
                    header('location: ../front/editequipamento.php?pagina=5&id_equip='.$_GET['id_equip'].'');
                }
            }else{
                header('location: ../front/office.php?pagina=5');
            }            
        }
    }
}

$conn->close();
