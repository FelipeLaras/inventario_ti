<?php
require_once('../bd/google.php');

if (!empty($_GET['id'])) {

    /* EDITANDO UMA PESQUISA */


    //SUBINDO O ARQ PARA O SERVIDOR
    if (!empty($_FILES['anexo'])) {
        $tipo_file = $_FILES['anexo']['type']; //Pegando qual é a extensão do arquivo
        $nome_db = $_FILES['anexo']['name'];
        $caminho = "../documentos/pesquisa/" . $_FILES['anexo']['name']; //caminho onde será salvo o FILE
        $caminho_db = "../documentos/pesquisa/" . $_FILES['anexo']['name']; //pasta onde está o FILE para salvar no Bando de dados

        /*VALIDAÇÃO DO FILE*/
        $sql_file = "SELECT * FROM google_validacao_arquivo WHERE tipo_arquivo LIKE '" . $tipo_file . "'"; //query de validação 

        $result =  $conn_db->query($sql_file); //aplicando a query

        if (!empty($tipo_file)) {
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
    }

    //EDITANDO NO BANCO AGORA

    $update = "UPDATE google SET 
                    titulo = '".$_POST['titulo']."', 
                    body = '".$_POST['body']."', 
                    caminho = '".$caminho_db."' 
                WHERE cod_tabela = ".$_GET['id']."";

    if(!$result = $conn_db->query($update)){
        printf('Erro[1]: %s\n',$conn_db->error);
    }

} else {

    /* CRIANDO UMA PESQUISA */

}
