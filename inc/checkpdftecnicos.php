<?php
/* ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL); */

require_once('../bd/conexao.php');
require_once('pesquisas.php');

//EQUIPAMENTO
if ($_GET['id_fun'] == NULL) {
    $queryEquipamento .= $_GET['query'];
    $funcionario = $_GET['query'];
} else {
    $queryEquipamento .= " WHERE MIE.id_funcionario = ".$_GET['id_fun']."";
    $funcionario = " WHERE MIF.id_funcionario = ".$_GET['id_fun']."";
}

$resultEquip = $conn->query($queryEquipamento);


//FUNCIONARIO
$queryColaboradorPDF .= $funcionario." LIMIT 1";
$resultColaborador = $conn->query($queryColaboradorPDF);
$colaborador = $resultColaborador->fetch_assoc();

//OBSERVAÇÕES
$queryOBS = "SELECT * FROM manager.manager_inventario_obs WHERE id_funcionario = ".$colaborador['id_funcionario']." ORDER BY id_obs DESC LIMIT 1";
$resultOBS = $conn->query($queryOBS);
$obs = $resultOBS->fetch_assoc();


/*CORPO DO PDF*/
$html = "
<html>
<head>
	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' integrity='sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf' crossorigin='anonymous'>	
	<link rel='stylesheet' href='../css/checklist.css' crossorigin='anonymous'>		
</head>
<body>
	<div id='logo2'>
		<img class='logo2' src='../img/logo2.png' width='130' alt='Logo'>
	</div>

	<div id='logo'>
		<img class='logo' src='../img/logo.png' width='150' alt='Logo'>
	</div>
	
	<div id='alerta'>
		<p id='titulo_alerta'>&ldquo; É OBRIGATÓRIO A DEVOLUÇÃO DESTE DOCUMENTO ASSINADO PARA O DEPARTAMENTO DO T.I &rdquo;</p>
		<p id='sub_alerta'>Caso não consiga entregar o documento fisicamente pode ser escaneado e enviado por e-mail.</p>
	</div>

	<div id='tabela'>
		<table class='table table-sm'>
			<thead>
				<tr>
					<th colspan='4'>DEVOLUÇÃO RH (Cheklist)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class='linha_table' scope='row'>FUNCIONÁRIO:</td>
					<td class='info_user'>".$colaborador['nome']."</td>
					<td class='linha_table'>CPF:</td>
					<td class='info_user'>".$colaborador['cpf']."</td>
				</tr>
				<tr>
					<td class='linha_table'>DEPARTAMENTO:</td>
					<td class='info_user'>".$colaborador['departamento']."</td>
					<td class='linha_table'>FUNÇÃO:</td>
					<td class='info_user'>".$colaborador['funcao']."</td>
				</tr>
				<tr>
					<td class='linha_table'>FILIAL:</td>
					<td colspan='4' class='info_user'>".$colaborador['empresa']."</td>
				</tr>
			<tbody>
		</table>
	</div>

	<div id='equipamento_title'>
		<p class='text-left'><u>Lista dos Equipamentos:</u></p>
	</div>";

	while($equipamento = $resultEquip->fetch_assoc()){
		//Sistema Operacional
		$queryso = "SELECT MSO.versao AS id_versao, MDSO.nome AS versao FROM  manager_sistema_operacional MSO LEFT JOIN manager_dropsistemaoperacional MDSO ON (MSO.versao = MDSO.id) WHERE MSO.id_equipamento = ".$equipamento['id_equipamento']."";
		$resultMSO = $conn->query($queryso);
		$mso = $resultMSO->fetch_assoc();

		//Office
		$queryoffice = "SELECT MO.versao AS id_versao, MDO.nome AS versao FROM manager_office MO LEFT JOIN manager_dropoffice MDO ON (MO.versao = MDO.id) WHERE MO.id_equipamento = ".$equipamento['id_equipamento']."";
		$resultoffice = $conn->query($queryoffice);
		$office  = $resultoffice->fetch_assoc();

		$html .= "<div class='row'>
		<div class='col-sm'>
			<p class='font-weight-light'>
				Equipamento:...... ".$equipamento['tipo_equipamento']." <span style='font-size: 8px;'>(".$equipamento['situacao'].")</span><br />
				Modelo:...... ".$equipamento['modelo']."<br />						
				Número:...... ".$equipamento['numero']."<br />
				Patrimônio:...... ".$equipamento['patrimonio']."<br />
				N. Série:...... ".$equipamento['serialnumber']."<br />
				Hard Disk:...... ".$equipamento['hd']."<br />
				Processador:...... ".$equipamento['processador']."<br />
				Memoria:...... ".$equipamento['memoria']."<br />
				Sistema Operacional:...... ".$mso['versao']."<br />
				Office:...... ".$office['versao']."<br />
			</p>
		</div>
	</div>";
	}

				
$html .= 
	"<p class='text-left'>Na condição de empregado(a) da filial <b>".$colaborador['empresa']."</b>, estou devolvendo neste ato os equipamentos descritos conforme a cima.</p>
	<p class='text-left'><u>CHECAR ITENS NA DEVOLUÇÃO</u></p>
	<div id='tabela_devolucao'>

		<table style='font-size: 8px; border: 1px solid #dee2e6'>
		  <thead>
			<tr>
			  <th>Checar</th>
			  <th style='padding-right: 6px;border: solid 1px #dee2e6;'>Status</th>
			  <th style='padding-right: 300px;'>Observacao + Valor do Conserto</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>Senha de Desbloqueio</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Dados Pessoais</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Carregador</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Fone de Ouvido</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Cabos</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Botões Faltantes</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Tela Trincada</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Tela Trincada</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Danos por Queda</td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Umidade</td>
			  <td></td>
			  <td></td>
			</tr>
		  </tbody>
		</table>

	</div>
	<div style='margin-top: 20px'>
		<p class='text-left'>Para os fins do par. 1° do Art. 462 a CLT, desde já autorizo o desconto nas minhas verbas rescisórias, afim de ressarcir os danos acima.</p>
	</div>
	<div id='termo_data'>
		<p class='text-center'>____________, ____ de _____________ de ________</p>
	</div>
	<br>
	<div id='assinatura'>
		<p class='text-left'>______________________________</p>
		<p class='text-left' style='margin-top: -18px;'>".$colaborador['empresa']."</p>
		<p class='text-left'>______________________________</p>
		<p class='text-left' style='margin-top: -18px;'>".$colaborador['nome']."</p>
	</div>
</body>
</html>";

require_once '../dompdf/autoload.inc.php';
require_once '../dompdf/lib/html5lib/Parser.php';
require_once '../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once '../dompdf/lib/php-svg-lib/src/autoload.php';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('checkList_' . $colaborador['nome'] . '.pdf', array("Attachment" => 1));//1 - Download 0 - Previa

$conn->close();
?>
