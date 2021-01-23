<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

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
        <form action="../inc/novoequipamento.php" method="POST" enctype="multipart/form-data" autocomplete="off">

          <div class="form-group">
            <label for="versao">Tipo Equipamento:</label>
            <select class="form-control" id="tipo_equipamento" name="tipo_equipamento" onchange="tipoEquipamento()">
              <option>----------</option>
              <?php

              $queryEquipamentos .= " AND id_equip IN (";

              while ($permissaoEquipamento = $resultPermissaoEquipamento->fetch_assoc()) {

                $queryEquipamentos .= $permissaoEquipamento['id_equipamento'] . ',';
              }

              $queryEquipamentos .= "'')";

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
              <input type="text" class="form-control" name="patrimonio">
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

                echo '<input type="checkbox" id="acessorios' . $Acessorios['id'] . '" name="acessorio[]" value="' . $Acessorios['id'] . '">
                        <label class="form-check-label" for="acessorios' . $Acessorios['id'] . '">' . $Acessorios['nome'] . '</label><br>';
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
              <input type="checkbox" name="planosVoz" value="VOZ" id="voz">
              <label class="form-check-label" for="voz">Voz</label><br>

              <input type="checkbox" name="planosDados" value="DADOS" id="dados">
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

          <!--DVR-->
          <div id="dvr" style="display: none;">

            <!--MODELO DVR-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Modelo:</label>
              <input type="text" class="form-control" name="modeloDVR">
            </div>
            <!--PATRIMONIO DVR-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Patrimônio:</label>
              <input type="text" class="form-control" name="patrimonioDVR">
            </div>
            <!--NUMERO SERIE DVR-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">N. de série:</label>
              <input type="text" class="form-control" name="serieDVR">
            </div>
            <!--IP DVR-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">IP:</label>
              <input type="text" class="form-control" name="ipDVR">
            </div>
            <!--LOCALIZAÇÂO DVR-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Localização:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="localizacaoDVR">
                <option>----------</option>
                <?php

                $resultEmpresa = $conn->query($queryEmpresa);

                while ($empresa = $resultEmpresa->fetch_assoc()) {
                  echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <!--FIM-->

          <!--RAMAL IP-->
          <div id="ramalIP" style="display: none;">
            <!--MODELO RAMAL-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Modelo:</label>
              <input type="text" class="form-control" name="modeloRamal">
            </div>
            <!--NUMERO RAMAL-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Número:</label>
              <input type="text" class="form-control" name="numeroRamal" maxlength="15">
            </div>
            <!--EMPRESA RAMAL-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Empresa:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="empresaRamal">
                <option>----------</option>
                <?php

                $resultEmpresa = $conn->query($queryEmpresa);

                while ($empresa = $resultEmpresa->fetch_assoc()) {
                  echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--LOCACAO RAMAL-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Locação:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="locacaoRamal">
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

          <!--SCANNER-->
          <div id="scanner" style="display: none;">
            <!--MODELO Scan-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Modelo:</label>
              <input type="text" class="form-control" name="modeloScan">
            </div>
            <!--SERIE Scan-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">N. série:</label>
              <input type="text" class="form-control" name="serieScan">
            </div>
            <!--PATRIMONIO Scan-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Patrimônio:</label>
              <input type="text" class="form-control" name="patrimonioScan">
            </div>
            <!--EMPRESA Scan-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Empresa:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="empresaScan">
                <option>----------</option>
                <?php

                $resultEmpresa = $conn->query($queryEmpresa);

                while ($empresa = $resultEmpresa->fetch_assoc()) {
                  echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--LOCACAO Scan-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Locação:</label>
              <select class="form-control" id="exampleFormControlSelect2" name="locacaoScan">
                <option>----------</option>
                <?php

                $resultLocacao = $conn->query($queryLocacao);

                while ($locacao = $resultLocacao->fetch_assoc()) {
                  echo '<option value="' . $locacao['id'] . '">' . $locacao['nome'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!--SITUAÇÂO Scan-->
            <div class="form-group">
              <label for="situacaoScan">Situação:</label>
              <select class="form-control" id="situacaoscan" name="situacaoscan" onchange="a()">
                <option>----------</option>
                <?php

                $resultSituacao = $conn->query($querySituacao);

                while ($situacao = $resultSituacao->fetch_assoc()) {
                  echo '<option value="' . $situacao['id'] . '">' . $situacao['nome'] . '</option>';
                }
                ?>
              </select>
            </div>

            <!--SITUAÇÂO ALUGADO Scan-->
            <div id="alugado" style="display: none;">
              <!--FORNECEDOR-->
              <div class="form-group">
                <label for="fornecedorScan">Fornecedor:</label>
                <input type="text" class="form-control" name="fornecedorScan">
              </div>
              <!--DATA FIM CONTRATO-->
              <div class="form-group">
                <label for="dataFimContrato">Data fim contrato:</label>
                <input type="text" class="form-control" name="dataFimContrato" placeholder="xx/xx/xxxx">
              </div>
            </div>
            <!--SITUAÇÂO COMPRADO Scan-->
            <div id="comprado" style="display: none;">
              <div class="form-group">
                <label for="numero_notaScan">Número Nota:</label>
                <div class="col-md-6 py-2">
                  <input type="text" class="form-control" name="numero_notaScan">
                </div>
              </div>

              <div class="form-group">
                <label for="data_notaScan">Data Nota:</label>
                <div class="col-md-4 py-2">
                  <input type="text" class="form-control" name="data_notaScan" placeholder="xx/xx/xxxx">
                </div>
              </div>

              <div class="form-group">
                <label for="anexoScan">Nota Fiscal:</label>
                <div class="col-md-4 py-2">
                  <input type="file" name="anexoScan">
                </div>
              </div>
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

          <!-- BOTAO SALVAR-->
          <div id="salvarButton">
            <hr>
            <button type="submit" class="btn btn-success btn-block">Salvar</button>
            <hr>
          </div>
        </form>

        <!--CPU / NOTEBOOK-->
        <div id="cpuNotebook" style="display: none;">
          <form action="../inc/pesquisaocs.php" method="POST" id="cpuNote" autocomplete="off">
            <!--* VALOR CELULAR / NOTEBOOK-->
            <div class="form-group">
              <label for="exampleFormControlSelect2">Patrimônio:</label>
              <div class="input-group-append">

                <div class="col-md-6 py-2">
                  <input type="text" class="form-control iconeAjustarDireita" name="patimonioEquipamento">
                  <button class="btn btn-primary fajusteDireita" type="submit" for="cpuNote">
                    <i class="fas fa-fw fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
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