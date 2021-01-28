<?php
//chamando a sessão
session_start();
//chamar o banco
require_once('../bd/conexao.php');
require_once('pesquisas.php');

/*--------------------------------------------------------------------*/
$queryso .= " WHERE MSO.id_equipamento = '" . $_GET['id_equip'] . "'";

if (!$result_windows = $conn->query($queryso)) {
  printf('ERRO[1]: %s\n', $conn->error);
} else {
  $windows_row = $result_windows->fetch_assoc();
}

$body = "
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Modelo Windows</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
  <style type='text/css'>
    th, .user {
        text-align: center !important;
    }
    .font{
        font-size: 11px;
    }
  </style>
</head>
<body>
<div class='container'>            
  <table class='table table-bordered'>
    <thead>
      <tr>
        <th colspan='2'><img class='logo' src='../img/logo.png' width='150' alt='Logo'></th>
        <th colspan='3'>Ficha do Windows</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan='5'>Empresa: <span class='font'>" . $windows_row['empresa'] . "</span></td> 
      </tr>
      <tr>
        <td colspan='5'>Localização: <span class='font'>" . $windows_row['locacao'] . "</span></td>
      </tr>
      <tr>
        <td colspan='3'>Nota Fiscal: <span class='font'>" . $windows_row['numero_nota'] . "</span></td>
        <td colspan='2'>Data: <span class='font'>" . $windows_row['data_criacao'] . "</span></td>
      </tr>
      <tr>
        <td colspan='5'>Software: <span class='font'>" . $windows_row['versao'] . "</span></td>
      </tr>
      <tr>
        <td colspan='5'>Fornecedor: <span class='font'>" . $windows_row['fornecedor'] . "</span></td>
      </tr>
      <tr>
        <th>Patrimônio</th>
        <th colspan='2'>Usuário</th>
        <th colspan='2'>Departamento</th>
      </tr>";

//coletando todos os id's que possuim esse mesmo numero de nota fiscal
$queryNota = "SELECT id_equipamento FROM manager_sistema_operacional WHERE numero_nota = '" . $windows_row['numero_nota'] . "'";
$resultQueryNota = $conn->query($queryNota);

while ($id_equipamento = $resultQueryNota->fetch_assoc()) {
  $in .=  "'" . $id_equipamento['id_equipamento'] . "',";
}
$in .= "''";

$queryEquipamento .= " WHERE MIE.id_equipamento in (" . $in . ")";

$result_user_windows = $conn->query($queryEquipamento);

while ($windows_user = $result_user_windows->fetch_assoc()) {
  $body .= "          
                <tr>
                    <td class='user font'>" . $windows_user['patrimonio'] . "</td>
                    <td colspan='2' class='user font'>" . $windows_user['nome_funcionario'] . "</td>
                    <td colspan='2' class='user font'>" . $windows_user['departamento'] . "</td>
                </tr>";
} //end While query

$body .= "
    </tbody> 
  </table>
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

$dompdf->loadHtml($body);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('modeloNota_'.$windows_row['numero_nota'].'', array("Attachment" => 1));//1 - Download 0 - Previa
