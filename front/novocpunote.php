<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */
session_start();

require_once('../bd/conexao.php');
require_once('header.php');
require_once('../inc/dropdown.php');
require_once('../inc/pesquisas.php');
require_once('../inc/permissoes.php');


//OFFICE QUE SERA EDITADO
if (!empty($_GET['id'])) {
  $queryoffice .= " WHERE MO.id = " . $_GET['id'] . "";
  $resultOffice = $conn->query($queryoffice);
  $office = $resultOffice->fetch_assoc();
}

//sabendo o tipo de equipamento

switch ($_SESSION['tipo_equipamento']) {
  case 'Notebook':
    $tipoequipamento = 9;
    break;

  case 'Mini Tower':
    $tipoequipamento = 8;
    break;

  case 'Tower':
    $tipoequipamento = 8;
    break;

  case 'To be filled by O.E.M.':
    $tipoequipamento = 8;
    break;

  case 'Portable':
    $tipoequipamento = 9;
    break;

  case 'Low Profile Desktop':
    $tipoequipamento = 8;
    break;

  case 'Docking Station':
    $tipoequipamento = 9;
    break;

  case 'Desktop':
    $tipoequipamento = 8;
    break;

  case 'Default string':
    $tipoequipamento = 8;
    break;

  case '12060':
    $tipoequipamento = 8;
    break;

  default:
    $tipoequipamento = 0;
    break;
}

?>
<!-- Begin Page Content -->
<div class="container-fluid py-4">
  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <a href="listequipamentos.php?pagina=5"><i class="fas fa-laptop"></i> Equipamentos</a> /
    <i class="fas fa-plus"></i> <?= $_SESSION['patrimonio'] ?>
  </h1>
  <hr>

  <div class="col-lg-6 left">
    <!-- Circle Buttons -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-laptop"></i> Equipamento</h6>
      </div>
      <div class="card-body">
        <form action="../inc/novoequipamento.php" method="POST" enctype="multipart/form-data" autocomplete="off">

          <!--TIPO EQUIPAMENTO-->
          <div class="form-group">
            <label for="versao">Tipo Equipamento:</label>
            <select class="form-control" id="tipo_equipamento" name="tipo_equipamento" required>
              <?php

              if ($tipoequipamento == 0) {

                echo '<option value="">----------</option>';

                $queryEquipamentos .= " AND id_equip IN (8 ,9)";

                $rest = $conn->query($queryEquipamentos);

                while ($tipoEquip = $rest->fetch_assoc()) {
                  echo '<option value="' . $tipoEquip['id'] . '">' . $tipoEquip['nome'] . '</option>';
                }
              } else {
                //sabendo qual é o tipo de equipamento

                $queryEquipamentos .= " AND id_equip = " . $tipoequipamento . "";
                $rest = $conn->query($queryEquipamentos);
                $tipoEquip = $rest->fetch_assoc();

                echo '<option value="' . $tipoEquip['id'] . '" selected>' . $tipoEquip['nome'] . '</option>';
              }



              ?>
            </select>
          </div>
          <!--MODELO-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Modelo:</label>
            <input type="text" class="form-control" name="modelo" value="<?= $_SESSION['modelo'] ?>">
          </div>
          <!--PATRIMONIO-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Patrimônio:</label>
            <input type="text" class="form-control" name="patrimonio" value="<?= $_SESSION['patrimonio'] ?>">
          </div>
          <!--DOMINIO-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Dominío:</label>
            <div class="form-group col-md-3">
              <?= $_SESSION['possuidominio'] == 0 ? '<input type="text" class="form-control text-success" name="dominio" value="'.$_SESSION['possuidominio'].'" style="text-align: center; display: none;" > <i class="fas fa-check-circle text-success" style="width: 175%;"> Cadastrado</i>' : '<input type="text" class="form-control text-danger" name="dominio" value="OFF" style="text-align: center; display: none; "><i class="fas fa-times-circle text-danger" style="width: 175%;"> Não cadastrado</i> ' ?>

            </div>
          </div>
          <!--EMPRESA-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Empresa Faturado:</label>
            <select class="form-control" id="exampleFormControlSelect2" name="empresa">
              <option>----------</option>
              <?php

              $resultEmpresa = $conn->query($queryEmpresa);

              while ($empresa = $resultEmpresa->fetch_assoc()) {
                echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
              }
              ?>
            </select>
          </div>
          <!--LOCACO-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Localização:</label>
            <select class="form-control" id="exampleFormControlSelect2" name="locacao">
              <option>----------</option>
              <?php

              $resultLocacao = $conn->query($queryLocacao);

              while ($locacao = $resultLocacao->fetch_assoc()) {
                echo '<option value="' . $locacao['id'] . '">' . $locacao['nome'] . '</option>';
              }
              ?>
            </select>
          </div>
          <!--Departamento-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Departamento:</label>
            <select class="form-control" id="exampleFormControlSelect2" name="departamento">
              <option>----------</option>
              <?php

              $resultDepartamento = $conn->query($queryDepartamento);

              while ($departamento = $resultDepartamento->fetch_assoc()) {
                echo '<option value="' . $departamento['id'] . '">' . $departamento['nome'] . '</option>';
              }
              ?>
            </select>
          </div>
          <!--Situação-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Situação:</label>
            <select class="form-control" id="exampleFormControlSelect2" name="situacao">
              <option>----------</option>
              <?php

              $resultSituacao = $conn->query($querySituacao);

              while ($situacao = $resultSituacao->fetch_assoc()) {
                echo '<option value="' . $situacao['id'] . '">' . $situacao['nome'] . '</option>';
              }
              ?>
            </select>
          </div>
          <!--status-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Status:</label>
            <select class="form-control" id="exampleFormControlSelect2" name="status">
              <option>----------</option>
              <?php

              $resultStatus = $conn->query($queryStatusEquipamento);

              while ($status = $resultStatus->fetch_assoc()) {
                echo '<option value="' . $status['id'] . '">' . $status['nome'] . '</option>';
              }
              ?>
            </select>
          </div>
          <!--HOSTNAME-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Nome:</label>
            <input type="text" class="form-control" name="hostname" value="<?= $_SESSION['hostname'] ?>">
          </div>
          <!--HOSTNAME-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">IP:</label>
            <input type="text" class="form-control" name="ip" value="<?= $_SESSION['ip'] ?>">
          </div>
          <!--PROCESSADOR-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Processador:</label>
            <input type="text" class="form-control" name="processador" value="<?= $_SESSION['processador'] ?>">
          </div>
          <!--HD-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">HD:</label>
            <input type="text" class="form-control" name="hd" value="<?= $_SESSION['hd'] ?>">
          </div>
          <!--MEMORIA-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Memória:</label>
            <input type="text" class="form-control" name="memoria" value="<?= $_SESSION['memoria'] ?>">
          </div>
          <!--SERIAL NUMBER-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Número de Série:</label>
            <input type="text" class="form-control" name="serial_number" value="<?= $_SESSION['serial_number'] ?>">
          </div>
          <!-- NOTA FISCAL-->
          <div class="form-group" id="nota">
            <label for="exampleFormControlSelect2">Possui Nota Fiscal:</label>
            <div class="py-2 input-group">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="todosEquipamentos" id="exampleRadios1" value="1" onclick="sim()">
                <label class="form-check-label" for="exampleRadios1">
                  Sim
                </label>
              </div>
              <div class="form-check" style="margin-left: 10px;">
                <input class="form-check-input" type="radio" name="todosEquipamentos" id="exampleRadios2" value="2" onclick="nao()" checked="">
                <label class="form-check-label" for="exampleRadios2">
                  Não
                </label>
              </div>
            </div>

            <div id='notafiscal' style="display: none;">
              <hr>
              <div class="form-group">
                <label for="exampleFormControlSelect2">Número Nota:</label>
                <div class="col-md-6 py-2">
                  <input type="text" class="form-control" name="numero_nota">
                </div>
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect2">Data Nota:</label>
                <div class="col-md-4 py-2">
                  <input type="text" class="form-control" name="data_nota" placeholder="xx/xx/xxxx">
                </div>
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect2">Nota Fiscal:</label>
                <div class="col-md-4 py-2">
                  <input type="file" name="anexo">
                </div>
              </div>
            </div>
          </div>
          <!--SISTEMA OPERACIONAL-->
          <hr>
          <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-windows"></i> Sistema Operacional</h6><br>

          <!--VERSÃO-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Versão:</label>
            <input type="text" class="form-control" name="serial_number" value="<?= $_SESSION['sistema_operacional'] ?>">
          </div>
          <!--SERIAL-->
          <div class="form-group">
            <label for="exampleFormControlSelect2">Chave do produto:</label>
            <input type="text" class="form-control" name="serial_number" value="<?= $_SESSION['chave_windows'] ?>">
          </div>

          <!--OFFICE-->
          <div style="display: <?= !empty($_SESSION['office']) ? "block" : "none" ?>;">
            <br>
            <hr>
            <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-windows"></i> OFFICE</h6><br>

            <!--VERSÃO-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Versão:</label>
              <input type="text" class="form-control" name="serial_number" value="<?= $_SESSION['office'] ?>">
            </div>
            <!--SERIAL-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Chave do produto:</label>
              <input type="text" class="form-control" name="serial_number" value="<?= $_SESSION['chave_office'] ?>">
            </div>
          </div>
          <!--FIM-->

          <!-- BOTAO SALVAR-->
          <div id="salvarButton">
            <br>
            <hr>
            <button type="submit" class="btn btn-success btn-block">Salvar</button>
          </div>
        </form>
        <!--FIM-->
      </div>
    </div>
  </div>
</div>

<!-- End of Main Content -->

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
<!--MOSTRAR TABELA DOS EQUIPAMENTOS-->
<script>
  function nao() {
    document.getElementById("notafiscal").style.display = "none";
  }

  function sim() {
    document.getElementById("notafiscal").style.display = "block";
  }
</script>

</html>