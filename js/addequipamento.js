function tipoEquipamento() {
    var optvalue = document.getElementById("tipo_equipamento").value;
  
    if (optvalue == 1 || optvalue == 2) {
      document.getElementById("celularTablet").style.display = "block";
    }    

  }