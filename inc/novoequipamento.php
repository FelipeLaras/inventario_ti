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
                        '" . $id_equipamento['id_equipamento'] . "', 
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

                //gambiarra pois estou com preguisa....(é eu sei o sistema é novo...... tô nem ai!)
                $updatenota = "UPDATE manager_inventario_equipamento SET numero_nota = '" . $_POST['numero_nota'] . "', data_nota = '" . $_POST['data_nota'] . "' WHERE id_equipamento = ".$id_equipamento['id_equipamento']."";

                if (!$resultnota = $conn->query($updatenota)) {

                    printf("Erro[3]: %s\n", $conn->error);
                    exit;
                }


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
                            printf('Erro[4]: %s\n Arquivo Invalido! - POR FAVOR INFORMAR UM ARQUIVO NO FORMATO: <span style="color: red">PDF</span><br />');
                            exit;
                        } else {
                            if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) { //aplicando o salvamento
                                echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
                            } else {
                                echo "Erro[5]: Arquivo não foi enviado! - CONTATO O ADMINISTRADOR DO SISTEMA<br />";
                                exit;
                            } //se caso não salvar vai mostrar o erro!
                        }
                    }
                } else {
                    printf('Erro[6]: Por favor inserir infomar uma nota no formato PDF para ser salvo!<br />');
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
                    '" . $id_equipamento['id_equipamento'] . "',
                    '" . $_SESSION['id'] . "', 
                    '" . $tipo_file . "', 
                    '" . $caminho_db . "', 
                    '" . $nome_db . "', 
                    '4', 
                    '" . $dataHoje . "'
                )";

                if (!$resultAnexo = $conn->query($queryAnexo)) {

                    printf("Erro[7]: %s\n", $conn->error);
                    exit;
                }
            }

            header('location: editequipamento.php?pagina=5&id_equip=' . $id_equipamento['id_equipamento'] . '');
        }
        break;

    case '2':
        # TABLET...

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

            printf("Erro[8]: %s\n", $conn->error);
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
                        '" . $id_equipamento['id_equipamento'] . "', 
                        '" . $id_acessorio . "'
                    )";

                    if (!$resultAcessorios = $conn->query($insertAcessorios)) {

                        printf("Erro[9]: %s\n", $conn->error);
                        exit;
                    }
                }
            }

            //nota fiscal
            if (!empty($_POST['numero_nota'])) {
                //gambiarra pois estou com preguisa....(é eu sei o sistema é novo...... tô nem ai!)
                $updatenota = "UPDATE manager_inventario_equipamento SET numero_nota = '" . $_POST['numero_nota'] . "', data_nota = '" . $_POST['data_nota'] . "' WHERE id_equipamento = ".$id_equipamento['id_equipamento']."";

                if (!$resultnota = $conn->query($updatenota)) {

                    printf("Erro[10]: %s\n", $conn->error);
                    exit;
                }

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
                            printf('Erro[11]: %s\n Arquivo Invalido! - POR FAVOR INFORMAR UM ARQUIVO NO FORMATO: <span style="color: red">PDF</span><br />');
                            exit;
                        } else {
                            if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) { //aplicando o salvamento
                                echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
                            } else {
                                echo "Erro[12]: Arquivo não foi enviado! - CONTATO O ADMINISTRADOR DO SISTEMA<br />";
                                exit;
                            } //se caso não salvar vai mostrar o erro!
                        }
                    }
                } else {
                    printf('Erro[13]: Por favor inserir infomar uma nota no formato PDF para ser salvo!<br />');
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
                    '" . $id_equipamento['id_equipamento'] . "',
                    '" . $_SESSION['id'] . "', 
                    '" . $tipo_file . "', 
                    '" . $caminho_db . "', 
                    '" . $nome_db . "', 
                    '4', 
                    '" . $dataHoje . "'
                )";

                if (!$resultAnexo = $conn->query($queryAnexo)) {

                    printf("Erro[14]: %s\n", $conn->error);
                    exit;
                }
            }

            header('location: editequipamento.php?pagina=5&id_equip=' . $id_equipamento['id_equipamento'] . '');
        }
        break;
    case '3':
        # CHIP...

        //Equipamento
        $insert = "INSERT INTO manager_inventario_equipamento 
        (
            usuario, 
            tipo_equipamento,
            filial,
            operadora,
            numero,
            planos_voz,
            planos_dados, 
            imei_chip, 
            status
        ) 
        VALUES 
        (
            '" . $_SESSION['id'] . "',
            '" . $_POST['tipo_equipamento'] . "',
            '" . $_POST['empresaChip'] . "',
            '" . $_POST['operadoraChip'] . "',
            '" . $_POST['numeroChip'] . "',
            '";

        $insert .= !empty($_POST['planosVoz']) ? $_POST['planosVoz'] : "---";

        $insert .=  "', '";

        $insert .= !empty($_POST['planosDados']) ? $_POST['planosDados'] : "---";

        $insert .=  "',";

        $insert .= "'" . $_POST['imeiChip'] . "',
            '" . $_POST['statusChip'] . "'
        )";

        if (!$result = $conn->query($insert)) {

            printf("Erro[15]: %s\n", $conn->error);
            exit;
        } else {

            //busca id do equipamento para usar na hora de salvar os acessorios e a nota fiscal
            $queryBusca = "SELECT max(id_equipamento) as id_equipamento FROM manager_inventario_equipamento";
            $resultBusca = $conn->query($queryBusca);
            $id_equipamento = $resultBusca->fetch_assoc();

            //nota fiscal
            if (!empty($_POST['numero_nota'])) {

                //gambiarra pois estou com preguisa....(é eu sei o sistema é novo...... tô nem ai!)
                $updatenota = "UPDATE manager_inventario_equipamento SET numero_nota = '" . $_POST['numero_nota'] . "', data_nota = '" . $_POST['data_nota'] . "' WHERE id_equipamento = ".$id_equipamento['id_equipamento']."";

                if (!$resultnota = $conn->query($updatenota)) {

                    printf("Erro[16]: %s\n", $conn->error);
                    exit;
                }

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
                            printf('Erro[17]: %s\n Arquivo Invalido! - POR FAVOR INFORMAR UM ARQUIVO NO FORMATO: <span style="color: red">PDF</span><br />');
                            exit;
                        } else {
                            if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) { //aplicando o salvamento
                                echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
                            } else {
                                echo "Erro[18]: Arquivo não foi enviado! - CONTATO O ADMINISTRADOR DO SISTEMA<br />";
                                exit;
                            } //se caso não salvar vai mostrar o erro!
                        }
                    }
                } else {
                    printf('Erro[19]: Por favor inserir infomar uma nota no formato PDF para ser salvo!<br />');
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
                    '" . $id_equipamento['id_equipamento'] . "',
                    '" . $_SESSION['id'] . "', 
                    '" . $tipo_file . "', 
                    '" . $caminho_db . "', 
                    '" . $nome_db . "', 
                    '4', 
                    '" . $dataHoje . "'
                )";

                if (!$resultAnexo = $conn->query($queryAnexo)) {

                    printf("Erro[20]: %s\n", $conn->error);
                    exit;
                }
            }

            header('location: editequipamento.php?pagina=5&id_equip=' . $id_equipamento['id_equipamento'] . '');
        }
        break;
    case '4':
        # MODEM...

        //Equipamento
        $insert = "INSERT INTO manager_inventario_equipamento 
        (
            usuario, 
            tipo_equipamento,
            filial,
            operadora,
            numero,
            planos_voz,
            planos_dados, 
            imei_chip, 
            status
        ) 
        VALUES 
        (
            '" . $_SESSION['id'] . "',
            '" . $_POST['tipo_equipamento'] . "',
            '" . $_POST['empresaChip'] . "',
            '" . $_POST['operadoraChip'] . "',
            '" . $_POST['numeroChip'] . "',
            '";

        $insert .= !empty($_POST['planosVoz']) ? $_POST['planosVoz'] : "---";

        $insert .=  "', '";

        $insert .= !empty($_POST['planosDados']) ? $_POST['planosDados'] : "---";

        $insert .=  "',";

        $insert .= "'" . $_POST['imeiChip'] . "',
            '" . $_POST['statusChip'] . "'
        )";

        if (!$result = $conn->query($insert)) {

            printf("Erro[21]: %s\n", $conn->error);
            exit;
        } else {

            //busca id do equipamento para usar na hora de salvar os acessorios e a nota fiscal
            $queryBusca = "SELECT max(id_equipamento) as id_equipamento FROM manager_inventario_equipamento";
            $resultBusca = $conn->query($queryBusca);
            $id_equipamento = $resultBusca->fetch_assoc();

            //nota fiscal
            if (!empty($_POST['numero_nota'])) {

                //gambiarra pois estou com preguisa....(é eu sei o sistema é novo...... tô nem ai!)
                $updatenota = "UPDATE manager_inventario_equipamento SET numero_nota = '" . $_POST['numero_nota'] . "', data_nota = '" . $_POST['data_nota'] . "' WHERE id_equipamento = ".$id_equipamento['id_equipamento']."";

                if (!$resultnota = $conn->query($updatenota)) {

                    printf("Erro[22]: %s\n", $conn->error);
                    exit;
                }

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
                            printf('Erro[23]: %s\n Arquivo Invalido! - POR FAVOR INFORMAR UM ARQUIVO NO FORMATO: <span style="color: red">PDF</span><br />');
                            exit;
                        } else {
                            if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) { //aplicando o salvamento
                                echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
                            } else {
                                echo "Erro[24]: Arquivo não foi enviado! - CONTATO O ADMINISTRADOR DO SISTEMA<br />";
                                exit;
                            } //se caso não salvar vai mostrar o erro!
                        }
                    }
                } else {
                    printf('Erro[25]: Por favor inserir infomar uma nota no formato PDF para ser salvo!<br />');
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
                    '" . $id_equipamento['id_equipamento'] . "',
                    '" . $_SESSION['id'] . "', 
                    '" . $tipo_file . "', 
                    '" . $caminho_db . "', 
                    '" . $nome_db . "', 
                    '4', 
                    '" . $dataHoje . "'
                )";

                if (!$resultAnexo = $conn->query($queryAnexo)) {

                    printf("Erro[26]: %s\n", $conn->error);
                    exit;
                }
            }

            header('location: editequipamento.php?pagina=5&id_equip=' . $id_equipamento['id_equipamento'] . '');
        }


        break;
    case '5':
        # RAMAL IP...

        //Equipamento
        $insert = "INSERT INTO manager_inventario_equipamento 
        (
            usuario, 
            tipo_equipamento, 
            modelo, 
            numero, 
            filial,
            locacao,
            status
        ) 
        VALUES 
        (
            '" . $_SESSION['id'] . "',
            '" . $_POST['tipo_equipamento'] . "',
            '" . $_POST['modeloRamal'] . "',
            '" . $_POST['numeroRamal'] . "',
            '" . $_POST['empresaRamal'] . "',
            '" . $_POST['locacaoRamal'] . "',
            '1'
        )";

        if (!$result = $conn->query($insert)) {

            printf("Erro[27]: %s\n", $conn->error);
            exit;

        }else{

            //busca id do equipamento para usar na hora de salvar os acessorios e a nota fiscal
            $queryBusca = "SELECT max(id_equipamento) as id_equipamento FROM manager_inventario_equipamento";
            $resultBusca = $conn->query($queryBusca);
            $id_equipamento = $resultBusca->fetch_assoc();

            header('location: editequipamento.php?pagina=5&id_equip=' . $id_equipamento['id_equipamento'] . '');
        }

        break;
    case '10':
        # SCANNER...

        //Equipamento
        $insert = "INSERT INTO manager_inventario_equipamento 
        (
            usuario, 
            tipo_equipamento, 
            modelo, 
            serialnumber,
            patrimonio, 
            filial,
            locacao,
            situacao,
            status";

        if ($_POST['situacaoscan'] == 4) {
            $insert .= ", fornecedor_scan, data_fim_contrato";
        } else if ($_POST['situacaoscan'] == 5) {
            $insert .= ", numero_nota, data_nota";
        }

        $insert .= ") 
        VALUES 
        (
            '" . $_SESSION['id'] . "',
            '" . $_POST['tipo_equipamento'] . "',
            '" . $_POST['modeloScan'] . "',
            '" . $_POST['serieScan'] . "',
            '" . $_POST['patrimonioScan'] . "',
            '" . $_POST['empresaScan'] . "',
            '" . $_POST['locacaoScan'] . "',
            '" . $_POST['situacaoscan'] . "',
            '1'";

        if ($_POST['situacaoscan'] == 4) {

            $insert .= ", '" . $_POST['fornecedorScan'] . "', '" . $_POST['dataFimContrato'] . "'";
        } else if ($_POST['situacaoscan'] == 5) {

            $insert .= ", '" . $_POST['numero_notaScan'] . "', '" . $_POST['data_notaScan'] . "'";
        }

        $insert .= ")";

        if (!$result = $conn->query($insert)) {

            printf("Erro[28]: %s\n", $conn->error);
            exit;
        } else {
            //busca id do equipamento para usar na hora de salvar os acessorios e a nota fiscal
            $queryBusca = "SELECT max(id_equipamento) as id_equipamento FROM manager_inventario_equipamento";
            $resultBusca = $conn->query($queryBusca);
            $id_equipamento = $resultBusca->fetch_assoc();

            //nota fiscal
            if (!empty($_POST['numero_nota'])) {

                //SUBINDO O ARQ PARA O SERVIDOR
                if ($_FILES['anexoScan'] != NULL) {
                    $tipo_file = $_FILES['anexoScan']['type']; //Pegando qual é a extensão do arquivo
                    $nome_db = $_FILES['anexoScan']['name'];
                    $caminho = "../documentos/notas/" . $_FILES['anexoScan']['name']; //caminho onde será salvo o FILE
                    $caminho_db = "../documentos/notas/" . $_FILES['anexoScan']['name']; //pasta onde está o FILE para salvar no Bando de dados

                    /*VALIDAÇÃO DO FILE*/
                    $sql_file = "SELECT type FROM manager_file_type WHERE type LIKE '" . $tipo_file . "'"; //query de validação 

                    $result =  $conn->query($sql_file); //aplicando a query

                    if ($tipo_file != NULL) {
                        /*TRABALHAMDO COM O RESULTADO DA VALIDAÇÃO*/
                        if (!$row = $result->fetch_assoc()) { //se é arquivo valido       
                            printf('Erro[29]: %s\n Arquivo Invalido! - POR FAVOR INFORMAR UM ARQUIVO NO FORMATO: <span style="color: red">PDF</span><br />');
                            exit;
                        } else {
                            if (move_uploaded_file($_FILES['anexoScan']['tmp_name'], $caminho)) { //aplicando o salvamento
                                echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
                            } else {
                                echo "Erro[30]: Arquivo não foi enviado! - CONTATO O ADMINISTRADOR DO SISTEMA<br />";
                                exit;
                            } //se caso não salvar vai mostrar o erro!
                        }
                    }
                } else {
                    printf('Erro[31]: Por favor inserir infomar uma nota no formato PDF para ser salvo!<br />');
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
                    '" . $id_equipamento['id_equipamento'] . "',
                    '" . $_SESSION['id'] . "', 
                    '" . $tipo_file . "', 
                    '" . $caminho_db . "', 
                    '" . $nome_db . "', 
                    '4', 
                    '" . $dataHoje . "'
                )";

                if (!$resultAnexo = $conn->query($queryAnexo)) {

                    printf("Erro[32]: %s\n", $conn->error);
                    exit;
                }
            }

            header('location: editequipamento.php?pagina=5&id_equip=' . $id_equipamento['id_equipamento'] . '');
        }

        break;
    case '11':
        # DVR...

        //Equipamento
        $insert = "INSERT INTO manager_inventario_equipamento 
        (
            usuario, 
            tipo_equipamento, 
            modelo,
            patrimonio, 
            serialnumber, 
            ip,
            locacao,
            status
        ) 
        VALUES 
        (
            '" . $_SESSION['id'] . "',
            '" . $_POST['tipo_equipamento'] . "',
            '" . $_POST['modeloDVR'] . "',
            '" . $_POST['patrimonioDVR'] . "',
            '" . $_POST['serieDVR'] . "',
            '" . $_POST['ipDVR'] . "',
            '" . $_POST['localizacaoDVR'] . "',
            '1'
        )";

        if (!$result = $conn->query($insert)) {

            printf("Erro[27]: %s\n", $conn->error);
            exit;

        }else{
            
            //busca id do equipamento para usar na hora de salvar os acessorios e a nota fiscal
            $queryBusca = "SELECT max(id_equipamento) as id_equipamento FROM manager_inventario_equipamento";
            $resultBusca = $conn->query($queryBusca);
            $id_equipamento = $resultBusca->fetch_assoc();

            header('location: editequipamento.php?pagina=5&id_equip=' . $id_equipamento['id_equipamento'] . '');
        }

        break;
}

$conn->close();
