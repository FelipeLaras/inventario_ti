<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */
//aplicando para usar varialve em outro arquivo
session_start();
//chamando conexão com o banco
require_once('../bd/conexao.php');
require_once('pesquisas.php');


if(!empty($_POST['username'])){
	$usuario = $_POST['username'];
	$senha = md5($_POST['password']);

}else{	
	$usuario = $_SESSION["mail"];
	$senha = $_SESSION["senha"];
}

//criando a query de pesquisa
$queryUsuarios .= "	WHERE profile_mail = '".$usuario ."' AND profile_password = '".$senha."'";

//Aplicando a query
$result = $conn->query($queryUsuarios);

//salvando em uma array
$row_user = $result->fetch_assoc();

//verificando se o usuário está ativo no sistema
if(empty($row_user['profile_name'])){

	header('location: ../index.php?erro=1');//usuário não encontrado

}else{
	if($row_user['profile_deleted'] == 1){

		header('location: ../index.php?erro=2');//usuário desativado

	}else{

		//USUÁRIO
		$_SESSION["perfil"] = $row_user["id_perfil"];		
		$_SESSION["nome_perfil"] = $row_user["nome_perfil"];
		$_SESSION["id"] = $row_user["id_profile"];
		$_SESSION["nome"] = $row_user["profile_name"];
		$_SESSION["mail"] = $row_user["profile_mail"];
		$_SESSION["senha"] = $row_user["profile_password"];
		$_SESSION["colorHeader"] = $row_user["color_header"];

		//PERMISSÕES
		$_SESSION["emitir_check_list"] = $row_user["emitir_check_list"];
		$_SESSION["editar_historico"] = $row_user["editar_historico"];
		$_SESSION["editar_cadastroFuncionario"] = $row_user["editar_cadastro_funcionario"];
		$_SESSION["ativar_cpf"] = $row_user["ativar_cpf"];
		$_SESSION["desativar_cpf"] = $row_user["desativar_cpf"];
		
		//ENTRA NO SISTEMAS
		header('location: ../front/front.php?pagina=1');
	}

}

//fecha o banco
$conn->close();
?>