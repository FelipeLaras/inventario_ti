<?php
require_once('header.php');
require_once('../bd/conexao.php');
require_once('../bd/conexao_ocs.php');
require_once('../bd/google.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-database"></i> Banco de Dados</h1>

  <p class="mb-4">DB - 01</p>
  <ul class="list-servidor">
    <li>
      <?php
      if (!$conn) {
        echo "Status: <span class='colorRed'>OFF</span><br />";
        printf("Erro: %s\n", mysqli_connect_error());
      } else {
        echo "Status: <span class='colorGrenn'>ON</span>";
      }
      ?>
    </li>
    <li>IP: <?= $servername ?></li>
    <li>DB: <?= $dbname ?></li>
    <li>Porta: <?= $port ?></li>
    <li><?= printf("Servidor: %s\n", $conn->server_info) ?>;</li>
    <li><?= printf("Versão DB: %s\n", $conn->client_info) ?>;</li>
  </ul>
  <hr>

  <p class="mb-4">DB - 02</p>
  <ul class="list-servidor">
    <li>
      <?php
      if (!$conn_ocs) {
        echo "Status: <span class='colorRed'>OFF</span><br />";
        printf("Erro: %s\n", mysqli_connect_error());
      } else {
        echo "Status: <span class='colorGrenn'>ON</span>";
      }
      ?>
    </li>
    <li>IP: <?= $servernameOcs ?></li>
    <li>DB: <?= $dbnameOcs ?></li>
    <li>Porta: <?= $portOcs ?></li>
    <li><?= printf("Servidor: %s\n", $conn_ocs->server_info) ?>;</li>
    <li><?= printf("Versão DB: %s\n", $conn_ocs->client_info) ?>;</li>
  </ul>
  <hr>

  <p class="mb-4">DB - 03</p>
  <ul class="list-servidor">
    <li>
      <?php
      if (!$conn_db) {
        echo "Status: <span class='colorRed'>OFF</span><br />";
        echo "Erro: não foi possível conectar-se ao MySQL." . PHP_EOL . "<br />";
      } else {
        echo "Status: <span class='colorGrenn'>ON</span>";
      }
      ?>
    </li>
    <li>IP: <?= $servernamePesquisa ?></li>
    <li>DB: <?= $dbnamePesquisa ?></li>
    <li>Porta: <?= $portPesquisa ?></li>
    <li><?= printf("Servidor: %s\n", $conn_db->server_info) ?>;</li>
    <li><?= printf("Versão DB: %s\n", $conn_db->client_info) ?>;</li>
  </ul>
  <hr>

</div>
<!-- /.container-fluid -->

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

</html>