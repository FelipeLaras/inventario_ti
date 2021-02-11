<?php
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */
require_once('header.php');
require_once('../bd/google.php');

$query = "SELECT * FROM google WHERE cod_tabela = " . $_GET['id'] . "";
$result = $conn_db->query($query);
$row = $result->fetch_assoc();
?>

<!-- Begin Page Content -->
<div class="container-fluid py-4">
  <!-- Page Heading -->

  <div>
    <h1 class="text-xs mb-6 h6 text-gray-800">
      <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
      <a href="pdados.php?pagina=4"><i class="fab fa-google"></i> Pesquisa </a> /
      <?= empty($_GET['id']) ? "<i class='fas fa-plus'></i> Adicionar" : "<i class='fas fa-pen'></i> Editar" ?>
    </h1>
    <hr/>
  </div>

  <div class="col-lg-12">
    <!-- Circle Buttons -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 h6 font-weight-bold text-primary"><?= empty($_GET['id']) ? "Adicionar Conteúdo" : "Editando Conteúdo" ?></h6>
      </div>

      <div class="card-body">
        <form action="../inc/adados.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nome"><a class="negritoad">Titulo</a></label>
            <input type="text" class="form-control" id="titulo" value="<?= empty($row['titulo']) ?: $row['titulo'] ?>" name="titulo">
          </div>
          <!-- Label de Informações -->
          <label for="email"><a class="negritoad">
              <hr>Conteúdo
              <hr class="tamanhohr">
            </a></label>
          <div class="form-group mb1">
            <textarea name='body' id='txtArtigo'><?= empty($row['body']) ?: $row['body'] ?></textarea>
            <script>
              CKEDITOR.replace('txtArtigo');
            </script>
          </div>

          <div class="form-group" id="nota" style="display: <?= empty($row['caminho_arquivo']) ? "none" : "block" ?>;">
            <label for="exampleFormControlSelect2" class="border-bottom-info">Deseja Alterar o PDF?</label>
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
          </div>

          <div id="notafiscal" style="display: <?= empty($row['caminho_arquivo']) ? "block" : "none" ?>;">
            <div class="form-group">
              <label for="nome"><a class="negritoad">Anexo: </a></label>
              <input type="file" class="form-control" name="anexo">
            </div>
          </div>

          
          <div class="form-group mb1">
            <textarea name='body' id='txtArtigo'><?= empty($row['body']) ?: $row['body'] ?></textarea>
            <script>
              CKEDITOR.replace('txtArtigo');
            </script>
          </div>

          
          <!-- Botão Salvar -->

          <div>
            <a href="pdados.php?pagina=4" class="btn btn-primary btn-block22">Voltar</a>
            <button type="submit" class="btn btn-primary btn-block22">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<hr>
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





</html>