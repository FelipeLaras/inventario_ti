<?php
/*
CPU E NOTEBOOK ESTÃO SENDO TRATAOS EM OUTRA TELA, 
veja o form do campo input Patrimonio desses dois equipamentos
*/
session_start();
require_once('../bd/conexao.php');

//DATA DE HOJE
$dataHoje = date('d/m/Y');


switch ($_POST['tipo_equipamento']) {
    case '1':
        # CELULAR...

        //Equipamento
        $insert = "INSERT INTO manager_inventario_equipamento 
        (
            usuario, 
            tipo_equipamento, 
            modelo, 
            patrimonio, 
            filial, 
            estado, 
            imei_chip, 
            status, 
            valor
        ) 
        VALUES 
        (
            '" . $_SESSION['id'] . "',
            '" . $_POST['tipo_equipamento'] . "',
            '" . $_POST['modelo'] . "',
            '" . $_POST['patrimonio'] . "',
            '" . $_POST['empresa'] . "',
            '" . $_POST['estado'] . "',
            '" . $_POST['imei'] . "',
            '" . $_POST['status'] . "',
            '" . $_POST['valor'] . "'
        )";

if (!$result = $conn->query($insert)) {

            printf("Erro[1]: %s\n", $conn->error);
            exit;
        } else {

            //busca id do equipamento para usar na hora de salvar os acessorios e a nota fiscal
            $queryBusca = "SELECT max(id_equipamento) as id_equipamento FROM manager_inventario_equipamento";
            $resultBusca = $conn->query($queryBusca);
            $id_equipamento = $resultBusca->fetch_assoc();

            //acessorios
            if (isset($_POST['acessorio'])) {
                foreach ($_POST['acessorio'] as $id_acessorio) {
                    $insertAcessorios = "INSERT INTO manager_inventario_acessorios 
                    (
                        id_equipamento, 
                        tipo_acessorio
                    ) 
                    VALUES 
                    (
                        '" . $id_equipamento . "', 
                        '" . $id_acessorio . "'
                    )";

                    if (!$resultAcessorios = $conn->query($insertAcessorios)) {

                        printf("Erro[2]: %s\n", $conn->error);
                        exit;
                    }
                }
            }

            //nota fiscal
            if (!empty($_POST['numero_nota'])) {
                //SUBINDO O ARQ PARA O SERVIDOR
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
                            printf('Erro[3]: %s\n Arquivo Invalido! - POR FAVOR INFORMAR UM ARQUIVO NO FORMATO: <span style="color: red">PDF</span><br />');
                            exit;
                        } else {
                            if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) { //aplicando o salvamento
                                echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
                            } else {
                                echo "Erro[4]: Arquivo não foi enviado! - CONTATO O ADMINISTRADOR DO SISTEMA<br />";
                                exit;
                            } //se caso não salvar vai mostrar o erro!
                        }
                    }
                } else {
                    printf('Erro[5]: Por favor inserir infomar uma nota no formato PDF para ser salvo!<br />');
                    exit;
                }

                //salvando no banco de dados
                $queryAnexo = "INSERT INTO manager_inventario_anexo 
                ( 
                    id_equipamento,
                    usuario, 
                    tipo_anexo, 
                    caminho, 
                    nome, 
                    tipo, 
                    data_criacao
                ) 
                VALUES 
                ( 
                    '" . $id_equipamento . "',
                    '" . $_SESSION['id'] . "', 
                    '" . $tipo_file . "', 
                    '" . $caminho_db . "', 
                    '" . $nome_db . "', 
                    '4', 
                    '" . $dataHoje . "'
                )";

                if (!$resultAnexo = $conn->query($queryAnexo)) {

                    printf("Erro[6]: %s\n", $conn->error);
                    exit;
                }
            }

            header('location: editequipamento.php?pagina=5&id_equip='.$id_equipamento.'');
        }
        break;

    case '2':
        # TABLET...
        echo "tab";
        break;
    case '3':
        # CHIP...

        echo "chip";
        break;
    case '4':
        # MODEM...
        echo "modem";
        break;
    case '5':
        # RAMAL IP...
        echo "ramal ip";
        break;
    case '10':
        # SCANNER...
        echo "scanner";
        break;
    case '11':
        # DVR...
        echo "dvr";
        break;
}


$conn->close();
