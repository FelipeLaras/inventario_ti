<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

require_once('../bd/conexao.php');
require_once('header.php');
require_once('../inc/dropdown.php');
require_once('../inc/pesquisas.php');


//OFFICE QUE SERA EDITADO
if (!empty($_GET['id'])) {
  $queryoffice .= " WHERE MO.id = " . $_GET['id'] . "";
  $resultOffice = $conn->query($queryoffice);
  $office = $resultOffice->fetch_assoc();
}

?>
<!-- Begin Page Content -->
<div class="container-fluid py-4">
  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <a href="listequipamentos.php?pagina=5"><i class="fas fa-laptop"></i> Equipamentos</a> /
    <i class="fas fa-plus"></i> Novo Equipamento
  </h1>
  <hr>

  <div class="col-lg-6 left">
    <!-- Circle Buttons -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Só Equipamento</h6>
      </div>
      <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label for="versao">Tipo Equipamento:</label>
            <select class="form-control" id="tipo_equipamento" name="tipo_equipamento" onchange="tipoEquipamento()">
              <option>----------</option>
              <?php

              $rest = $conn->query($queryEquipamentos);

              while ($tipoEquip = $rest->fetch_assoc()) {
                echo '<option value="' . $tipoEquip['id'] . '">' . $tipoEquip['nome'] . '</option>';
              }

              ?>
            </select>
          </div>

          <!--CELULAR / TABLET-->
          <div id="celularTablet" style="display: none;">
            <!--MODELO CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Modelo:</label>
              <input type="text" class="form-control" name="modelo">
            </div>
            <!--PATRIMONIO CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Patrimônio:</label>
              <input type="text" class="form-control" name="patimonio">
            </div>
            <!--EMPRESA CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Empresa:</label>
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
            <!--ESTADO CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Estado:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="estado">
                <option>----------</option>
                <?php

                $resultEstado = $conn->query($queryEstado);

                while ($estado = $resultEstado->fetch_assoc()) {
                  echo '<option value="' . $estado['id'] . '">' . $estado['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--ACESSORIOS CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Acessorios:</label><br>
              <?php

              $resultAcessorios = $conn->query($queryAcessorios);

              while ($Acessorios = $resultAcessorios->fetch_assoc()) {

                echo '<input type="checkbox" name="acessorio[]" value="' . $Acessorios['id'] . '">
                        <label class="form-check-label" for="exampleRadios1">' . $Acessorios['nome'] . '</label><br>';
              }
              ?>
            </div>
            <!--* IMEI CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">IMEI:</label>
              <input type="text" class="form-control" name="imei">
            </div>
            <!--STATUS CELULAR / TABLET-->
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
            <!--* VALOR CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Valor:</label>
              <div class="form-group col-md-4">
                <div class="input-group-append">
                  <span class="btn btn-primary">
                    R$
                  </span>
                </div>
                <input type="text" class="form-control iconeAjustar" name="valor" onKeyPress="return(moeda(this,'.',',',event))">
              </div>
            </div>
          </div>
          <!--FIM-->

          <!--CHIP / MODEM-->
          <div id="chipModem" style="display: none;">
            <!--EMPRESA CHIP / MODEM-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Empresa:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="empresaChip">
                <option>----------</option>
                <?php

                $resultEmpresa = $conn->query($queryEmpresa);

                while ($empresa = $resultEmpresa->fetch_assoc()) {
                  echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--OPERADOR CHIP / MODEM-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Operadora:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="operadoraChip">
                <option>----------</option>
                <?php

                $resultqueryOperadora = $conn->query($queryOperadora);

                while ($operadora = $resultqueryOperadora->fetch_assoc()) {
                  echo '<option value="' . $operadora['id'] . '">' . $operadora['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--NUMERO CHIP / MODEM-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Número:</label>
              <input type="text" class="form-control" name="numeroChip" id="telefone" maxlength="15" placeholder="(xx) xxxx-xxx">
            </div>
            <!--PLANOS CHIP / MODEM-->
            <div class="form-group">
              <label for="voz">Planos:</label><br>
              <input type="checkbox" name="planosChip[]" value="voz" id="voz">
              <label class="form-check-label" for="voz">Voz</label><br>

              <input type="checkbox" name="planosChip[]" value="dados" id="dados">
              <label class="form-check-label" for="dados">Dados</label><br>
            </div>
            <!--STATUS CHIP / MODEM-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Status:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="statusChip">
                <option>----------</option>
                <?php

                $resultStatusCHIP = $conn->query($queryStatusEquipamento);

                while ($chip = $resultStatusCHIP->fetch_assoc()) {
                  echo '<option value="' . $chip['id'] . '">' . $chip['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--IMEI CHIP / MODEM-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">IMEI:</label>
              <input type="text" class="form-control" name="imeiChip">
            </div>
          </div>
          <!--FIM-->

          <!--RAMAL IP-->
          <div id="ramalIP" style="display: none;">

            <!--IMEI RAMAL-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Modelo:</label>
              <input type="text" class="form-control" name="modeloRamal">
            </div>
            <!--NUMERO RAMAL-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Número:</label>
              <input type="text" class="form-control" name="numeroChip" maxlength="15">
            </div>
            <!--EMPRESA CHIP / MODEM-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Empresa:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="empresaChip">
                <option>----------</option>
                <?php

                $resultEmpresa = $conn->query($queryEmpresa);

                while ($empresa = $resultEmpresa->fetch_assoc()) {
                  echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--LOCACAO CHIP / MODEM-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Locação:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="locacaoChip">
                <option>----------</option>
                <?php

                $resultLocacao = $conn->query($queryLocacao);

                while ($locacao = $resultLocacao->fetch_assoc()) {
                  echo '<option value="' . $locacao['id'] . '">' . $locacao['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <!--FIM-->

          <!-- NOTA FISCAL-->
          <div class="form-group" id="nota" style="display: none;">
            <label for="exampleFormControlSelect2">Possui Nota Fiscal?</label>
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
                  <input type="text" class="form-control" value="<?= $office['fornecedor'] ?>" name="numero_nota">
                </div>
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect2">Data Nota:</label>
                <div class="col-md-4 py-2">
                  <input type="text" class="form-control" value="<?= $office['fornecedor'] ?>" name="data_nota" placeholder="xx/xx/xxxx">
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

          <hr>
          <button type="submit" class="btn btn-success btn-block" id="salvarButton">Salvar</button>
          <hr>
        </form>

        <!--CPU / NOTEBOOK-->
        <div id="cpuNotebook" style="display: none;">
          <form action="indeeex.php" method="POST" id="cpuNote">
            <!--* VALOR CELULAR / TABLET-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Patrimônio:</label>
              <div class="input-group-append">
                
                <div class="col-md-6 py-2">
                  <input type="text" class="form-control iconeAjustarDireita" name="valor">
                  <button class="btn btn-primary fajusteDireita" type="submit" for="cpuNote">
                  <i class="fas fa-fw fa-search"></i>
                </button>
                </div>
              </div>
            </div>
          </form>
        </div>


      </div>

    </div>

  </div>
  <div class="card-body" style="display: <?= empty($_GET['id']) ? 'none' : 'block' ?>">
    <h6 class="m-0 font-weight-bold text-primary">
      <i class="fas fa-file"></i> Nota Fiscal OFFICE
      <a href="#" data-toggle="modal" data-target="#novo" class="float-right btn btn-success" style="margin-bottom: 20px;" title="Novo Documento"><i class="fas fa-plus"></i></a>
    </h6>
    <div class="table-responsive">
      <table class="table table-bordered small-lither" id="" cellspacing="0">
        <thead class="bold">
          <tr>
            <th>NOTA FISCAL</th>
            <th>NÚMERO NOTA FISCAL</th>
            <th>DATA NOTA FISCAL</th>
            <th class="maior">AÇÃO</th>
          </tr>
        </thead>
        <tbody class="colorTable">
          <?php
          echo '<tr>';
          echo empty($office['nome'])  ?  '<td></td>' :  '<td><a href="' . $office['caminho'] . '" class="text-info" target="_blank" title="Ver documento">' . $office['nome'] . '</a></td>';
          echo empty($office['numero_nota']) != 0 ?  '<td></td>' :  '<td>' . $office['numero_nota'] . '</td>';
          echo empty($office['data_nota']) != 0 ?  '<td></td>' :  '<td>' . $office['data_nota'] . '</td>';
          /*AÇÂO*/
          echo empty($office['numero_nota']) ? '<td></td>' : '<td><a href="javascript:" class="text-danger menu rigtIcones" title="Excluir" data-toggle="modal" data-target="#desativar"><i class="fas fa-trash"></i></a>
        </td>';
          /*FIM AÇÂO*/
          echo '</tr>';
          ?>
        </tbody>
      </table>
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
<!-- Logout Modal-->
<div class="modal fade" id="desativar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Realmente quer <span class='colorRed'>EXCLUIR</span> essa Nota ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="textCenterModal"><?= $office['nome']  ?></span>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
        <a class="btn btn-primary" href="../inc/notaofficedrop.php?pagina=5&id=<?= $office['id'] ?>">Sim</a>
      </div>
    </div>
  </div>
</div>

<!-- Novo documento modal-->
<div class="modal fade" id="novo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-file-upload"></i> Nova Nota Fiscal</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../inc/novanota.php?id=<?= $office['id'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
          <!--NOTA FISCAL DATA-->
          <div class="input-group">
            <div class="col-md-10 form-group">
              <label for="nome">Fornecedor: </label>
              <input type="text" class="form-control" name="fornecedor">
            </div>
          </div>
          <div class="col-md-4 input-group">
            <div class="form-group">
              <label for="nome">Número Nota: </label>
              <input type="text" class="form-control" name="numero_nota">
            </div>
          </div>
          <div class="col-md-4 input-group">
            <div class="form-group">
              <label for="nome">Data Nota: </label>
              <input type="text" class="form-control" name="data_nota" placeholder="xx/xx/xxxx">
            </div>
          </div>
          <div class="col-md-4 input-group">
            <div class="form-group">
              <label for="nome">Nota: </label>
              <input type="file" class="form-control-file" name="anexo" required>
            </div>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" type="submit">Salvar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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