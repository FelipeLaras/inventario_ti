<?php
require_once('header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <a href="listequipamentos.php?pagina=5"><i class="fas fa-laptop"></i> Equipamentos</a> /
    <i class="fas fa-plus"></i> Novo Equipamento
  </h1>
  <hr>



  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Escolha sua opção</h6>
    </div>
    <div class="card-body">
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <a href='novoequipamento.php?pagina=5' class="text-decoration">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> Só Equipamento</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-laptop fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 mb-0 font-weight-bold text-gray-800">Equipamento + Colaborador</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-laptop fa-2x text-gray-300"></i> <i class="fas fa-plus fa-2x text-gray-300"></i> <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
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