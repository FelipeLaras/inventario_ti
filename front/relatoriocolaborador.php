<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

session_start();
require_once('header.php');
require_once('../inc/pesquisas.php');
require_once('../bd/conexao.php');
require_once('../inc/dropdown.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <a href="relatorios.php?pagina=6"><i class="fas fa-file-contract"></i> Relatórios</a> /
    <i class="fas fa-user"></i> Relatórios Colaborador
  </h1>
  <hr />
  <!-- /.container-fluid -->
  <form action="relatorioresultado.php" method="GET" autocomplete="off">

    <!--TIPO 1-->
    <input type="text" style="display: none;" name="tipo" value="1">
    <!--FUNÇÂO-->
    <h1 class="h6 mb-2 text-gray-800">
      <i class="fas fa-angle-double-right"></i> Função:
    </h1>

    <div class="col-md-4 py-4 input-group">
      <select name="funcao" class="form-control">
        <option value="">----------</option>
        <?php

        $queryFuncao .= " ORDER BY nome ASC";
        $resultFuncao = $conn->query($queryFuncao);

        while ($funcao = $resultFuncao->fetch_assoc()) {
          echo '<option value="' . $funcao['id'] . '">' . $funcao['nome'] . '</option>';
        }
        ?>
      </select>
    </div>

    <!--DEPARTAMENTO-->
    <h1 class="h6 mb-2 text-gray-800">
      <i class="fas fa-angle-double-right"></i> Departamento:
    </h1>

    <div class="col-md-4 py-4 input-group">
      <select name="departamento" class="form-control">
        <option value="">----------</option>
        <?php
        $queryDepartamento .= " ORDER BY nome ASC";
        $resultDepartamento = $conn->query($queryDepartamento);

        while ($departamento = $resultDepartamento->fetch_assoc()) {
          echo '<option value="' . $departamento['id'] . '">' . $departamento['nome'] . '</option>';
        }
        ?>
      </select>
    </div>

    <!--EMPRESA-->
    <h1 class="h6 mb-2 text-gray-800">
      <i class="fas fa-angle-double-right"></i> Empresa:
    </h1>

    <div class="col-md-4 py-4 input-group">
      <select name="empresa" class="form-control">
        <option value="">----------</option>
        <?php
        $queryEmpresa .= " ORDER BY nome ASC";
        $resultEmpresa = $conn->query($queryEmpresa);

        while ($empresa = $resultEmpresa->fetch_assoc()) {
          echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
        }
        ?>
      </select>
    </div>

    <!--STATUS-->
    <h1 class="h6 mb-2 text-gray-800">
      <i class="fas fa-angle-double-right"></i> Status:
    </h1>

    <div class="col-md-4 py-4 input-group">
      <select name="status" class="form-control">
        <option value="">----------</option>
        <?php
        $queryStatusFuncionario .= " ORDER BY nome ASC";
        $resultStatusFuncionario = $conn->query($queryStatusFuncionario);

        while ($statusFuncionairio = $resultStatusFuncionario->fetch_assoc()) {
          echo '<option value="' . $statusFuncionairio['id'] . '">' . $statusFuncionairio['nome'] . '</option>';
        }
        ?>
      </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-icon-split textCenterTela mb-5">
      <span class="icon text-white-50">
        <i class="fas fa-search"></i>
      </span>
      <span class="text">Gerar Relatório</span>
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
</body>

</html>