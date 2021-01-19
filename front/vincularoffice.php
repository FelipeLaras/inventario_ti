<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

session_start();
require_once('header.php');
require_once('../inc/pesquisas.php');
require_once('../bd/conexao.php');
require_once('../inc/dropdown.php');

//EQUIPAMENTO
$queryEquipamento .= " WHERE MIE.deletar = 0 AND MIE.tipo_equipamento IN (8,9)";
$resultEquipamento = $conn->query($queryEquipamento);

//FUNCIONÁRIO
$queryColaborador .= " WHERE MIF.deletar = 0 ORDER BY MIF.nome ASC";
$resultFuncionario = $conn->query($queryColaborador);

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <a href="listequipamentos.php?pagina=5"><i class="fas fa-laptop"></i> Equipamentos</a> /
    <a href="office.php?pagina=5"><i class="fas fa-laptop"></i> Office</a> /
    <i class="fas fa-laptop-medical"></i> Vincular ao Equipamento
  </h1>
  <hr />
  <!-- /.container-fluid -->
  <form action="../inc/vincularoffice.php?id_equip=<?= $_GET['id'] ?>" method="POST" autocomplete="off">
    <div>
      <!-- Page Heading -->
      <h1 class="h6 mb-2 text-gray-800"><i class="fas fa-angle-double-right"></i> Escolha o Equipamento [Patrimônio]? <span class="colorRed">*</span> </h1>
      <div class="col-md-4 py-4 input-group">
        <select name="equip" class="form-control" required>
          <option value="">---</option>
          <?php

          while ($equipamentos = $resultEquipamento->fetch_assoc()) {
            echo '
                <option value="' . $equipamentos['id_equipamento'] . '">' . $equipamentos['patrimonio'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-icon-split textCenterTela mb-5">
      <span class="icon text-white-50">
        <i class="fas fa-laptop-medical"></i>
      </span>
      <span class="text">Vincular Office</span>
    </button>
  </form>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>TI Grupo Servopa - Qualquer dúvida ligue no 110-2151</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="adicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Localizar Funcionário</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../inc/pesquisaFuncionario.php" method="POST" autocomplete="off">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Digite o CPF" id="RegraValida" name="cpf" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" onblur="ValidarCPF(this)">

            <span class="small-lither">Veja se ja está cadastrado!</span><br />
            <span class="text-danger" style="display: none;" id="cpfInvalido"><i class="fas fa-times-circle"></i> CPF Invalido!</span>
            <span class="text-success" style="display: none;" id="cpfValido"><i class="fas fa-check-circle"></i> CPF OK!</span>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-info" id="procurar" type="submit" disabled="false">Procurar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>

</html>