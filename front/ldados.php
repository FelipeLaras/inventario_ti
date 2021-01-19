<?php
require_once('header.php');

require_once('../inc/permissoes.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid py-4">

  <!-- Page Heading -->
  <h1 class="text-xs mb-6 text-gray-800">
    <a href="front.php?pagina=1"><i class="fas fa-home"></i> Home</a> /
    <i class="fab fa-google"></i> Pesquisa
  </h1>
  <hr/>

  <!-- Conteudo -->

  <!-- Area de Pesquisa -->


  <div class="googleldados2">
    <img src="../img/google.png">


    <!-- <div class="dentro"> -->

    <form class="container w-p d-none d-sm-inline-block form-inline mr-auto ml-md-0 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" class="borderradius form-control bg-blue border-0 small" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="basic-addon2">
        <div class="input-group-append">

          </button>

    </form>
  </div>



  <div class="p-relative">
    <a href="ldados.php?pagina=4" class="btn btn-primary btn-icon-split menu ">
      <span class="icon text-white-50">
        <i class="fas fa-search"></i>
      </span>
      <span class=""></span>
    </a>
    <a href="adados.php?pagina=4" class="btn btn-primary btn-icon-split menu">
      <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
      </span></span>
    </a>
  </div>
</div>
</div>

<hr class="absolutehr"></hr>


<!-- Primeiro Card -->

<div class="firstcard card shadow mb-4">
  <!-- Card Header - Accordion -->
  <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
    <h6 class="m-0 font-weight-bold text-primary">Titulo do conteudo</h6>
  </a>
  <!-- Card Content - Collapse -->
  <div class="collapse " id="collapseCardExample1">
    <div class="card-body">
      Aqui deve ficar todo o conteudo do card. Isso inclui os pdfs, imagens e tudo mais.
    </div>
  </div>
</div>


<!-- Segundo Card -->

<div class="firstcard card shadow mb-4">
  <!-- Card Header - Accordion -->
  <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
    <h6 class="m-0 font-weight-bold text-primary">Titulo do conteudo</h6>
  </a>
  <!-- Card Content - Collapse -->
  <div class="collapse " id="collapseCardExample2">
    <div class="card-body">
      Aqui deve ficar todo o conteudo do card. Isso inclui os pdfs, imagens e tudo mais.
    </div>
  </div>
</div>

<!-- Teceiro Card -->

<div class="firstcard card shadow mb-4">
  <!-- Card Header - Accordion -->
  <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
    <h6 class="m-0 font-weight-bold text-primary">Titulo do conteudo</h6>
  </a>
  <!-- Card Content - Collapse -->
  <div class="collapse " id="collapseCardExample3">
    <div class="card-body">
      Aqui deve ficar todo o conteudo do card. Isso inclui os pdfs, imagens e tudo mais.
    </div>
  </div>
</div>























<!-- End of Main Content -->

<!-- Footer -->
<footer class="mt-5 sticky-footer bg-white">
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