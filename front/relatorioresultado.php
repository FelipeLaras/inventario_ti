<?php
session_start();
require_once('header.php');
require_once('../inc/pesquisas.php');
require_once('../bd/conexao.php');


?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <a href="relatorios.php?pagina=6"><i class="fas fa-file-contract"></i> Relatórios</a> /
    <i class="fas fa-tag"></i> Resultado
  </h1>
  <!-- Page Heading -->
  <hr />
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Relatório Colaboradores</h1>
    <a href="#" class="btn btn-sm btn-success" title="imprimir PDF" style="margin-left: 64%;"><i class="fas fa-print"></i></a>
    <a href="#" class="btn btn-sm btn-success" title="Exportar Excel"><i class="fas fa-file-excel"></i></a>
  </div>
  <!-- Page Heading -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tag"></i> Resultado
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered small-lither" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>NOME</th>
              <th>C.P.F</th>
              <th>FUNÇÃO</th>
              <th>DEPARTAMENTO</th>
              <th>EMPRESA</th>
              <th>EQUIPAMENTOS</th>
              <th class="maior">STATUS</th>
              <th class="maior">AÇÃO</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>NOME</th>
              <th>C.P.F</th>
              <th>FUNÇÃO</th>
              <th>DEPARTAMENTO</th>
              <th>EMPRESA</th>
              <th>EQUIPAMENTOS</th>
              <th class="maior">STATUS</th>
              <th class="maior">AÇÃO</th>
            </tr>
          </tfoot>
          <tbody>
            <?php

            while ($colaborador = $resultColaborador->fetch_assoc()) {

              $validarEquip = "SELECT id_equipamento FROM manager_inventario_equipamento WHERE id_funcionario = " . $colaborador['id_funcionario'] . " AND tipo_equipamento IN (";

              $queryEquipamentoUsuario = "SELECT * FROM manager_profile_equip WHERE id_profile = " . $_SESSION['id'] . "";
              $rs = $conn->query($queryEquipamentoUsuario);

              while ($permissaoEquip = $rs->fetch_assoc()) {
                $validarEquip .= $permissaoEquip['id_equipamento'] . ',';
              }

              $validarEquip .= "'')";

              $resultValidar = $conn->query($validarEquip);

              if ($validar = $resultValidar->fetch_assoc()) {
                echo '<tr>';
                echo $colaborador['id_funcionario'] != NULL ?  '<td>' . $colaborador['id_funcionario'] . '</td>' :  '<td>----------</td>';
                echo $colaborador['nome'] != NULL ?  '<td>' . $colaborador['nome'] . '</td>' :  '<td>----------</td>';
                echo $colaborador['cpf'] != NULL ?  '<td>' . $colaborador['cpf'] . '</td>' :  '<td>----------</td>';
                echo $colaborador['funcao'] != NULL ?  '<td>' . $colaborador['funcao'] . '</td>' :  '<td>----------</td>';
                echo $colaborador['departamento'] != NULL ?  '<td>' . $colaborador['departamento'] . '</td>' :  '<td>----------</td>';
                echo $colaborador['empresa'] != NULL ?  '<td>' . $colaborador['empresa'] . '</td>' :  '<td>----------</td>';

                //quantidade equipamentos
                $queryQuantidadeEquipamentos = "SELECT 
              COUNT(*) AS quantidade, MDE.nome AS equipamento
              FROM
              manager_inventario_equipamento MIE
              LEFT JOIN
              manager_dropequipamentos MDE ON (MIE.tipo_equipamento = MDE.id_equip) 
              WHERE MIE.id_funcionario = " . $colaborador['id_funcionario'] . " AND MIE.deletar = 0 AND MIE.tipo_equipamento in (";

                $eq = "SELECT * FROM manager_profile_equip WHERE deletar = 0 AND id_profile = " . $_SESSION['id'] . "";
                $reeq = $conn->query($eq);

                while ($eqip = $reeq->fetch_assoc()) {
                  $queryQuantidadeEquipamentos .= $eqip['id_equipamento'] . ",";
                }

                $queryQuantidadeEquipamentos .= "'') GROUP BY MDE.id_equip";

                $resultQuantidadeEquipamentos = $conn->query($queryQuantidadeEquipamentos);

                echo '<td>';

                while ($quantidadeEquipamentos = $resultQuantidadeEquipamentos->fetch_assoc()) {
                  echo '[ ' . $quantidadeEquipamentos['quantidade'] . ' - ' . $quantidadeEquipamentos['equipamento'] . ' ]<br>';
                }

                echo '</td>';

                switch ($colaborador['id_status']) {
                  case '4':
                    echo '<td><span class="icone btn-success">' . $colaborador['status'] . '</span></td>';
                    break;

                  case '3':
                    echo '<td><span class="icone btn-warning">' . $colaborador['status'] . '</span></td>';
                    break;

                  case '8':
                    echo '<td><span class="icone btn-danger">' . $colaborador['status'] . '</span></td>';
                    break;

                  default:
                    '<td>CódErro[1]: NO STATUS</td>';
                    break;
                }

                echo '<td>                    
                      <a href="../inc/pesquisaFuncionario.php?id=' . $colaborador['id_funcionario'] . '" class="text-success menu rigtIcones" title="Editar" ><i class="fas fa-pen"></i></a>
                      <a href="checklist.php?id=' . $colaborador['id_funcionario'] . '" class="text-warning menu rigtIcones" title="Check-List"  style="display: ';
                echo empty($_SESSION['emitir_check_list']) ? "none" : "inline-block";
                echo '"><i class="far fa-list-alt"></i></a>
                      <a href="termo.php?id=' . $colaborador['id_funcionario'] . '" class="text-info menu rigtIcones" title="Termo"><i class="fas fa-file"></i></a>
                    </td>';
              } //FIM IF $VALIDAR

            } //FIM WHILE $COLABORADOR
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
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

</body>
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

</html>