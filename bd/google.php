<?php
  //variaveis para conexao
  $servernamePesquisa = "10.100.1.65";
  $usernamePesquisa = "techman";
  $passwordPesquisa = "#S3rv0p4TI";
  $dbnamePesquisa = "pesquisa";
  $portPesquisa = "3306";

  //conexao
  $conn_db = mysqli_connect($servernamePesquisa, $usernamePesquisa, $passwordPesquisa, $dbnamePesquisa, $portPesquisa);