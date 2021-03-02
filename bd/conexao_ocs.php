<?php
  //variaveis para conexao
  $servernameOcs = "10.100.1.65";
  $userOcs = "ocswebnew";
  $passwordOcs = "Qtbvar03#";
  $dbnameOcs = "ocsweb";
  $portOcs = "3306";

  //conexao
  $conn_ocs = mysqli_connect($servernameOcs, $userOcs, $passwordOcs, $dbnameOcs, $portOcs);