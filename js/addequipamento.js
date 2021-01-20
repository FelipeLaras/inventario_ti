function tipoEquipamento() {
  var optvalue = document.getElementById("tipo_equipamento").value;



  if (optvalue == 1 || optvalue == 2) {

    document.getElementById("celularTablet").style.display = "block";

    document.getElementById("nota").style.display = "block";

    document.getElementById("chipModem").style.display = "none";

    document.getElementById("ramalIP").style.display = "none";

  } else if (optvalue == 3 || optvalue == 4) {

    document.getElementById("celularTablet").style.display = "none";

    document.getElementById("chipModem").style.display = "block";

    document.getElementById("nota").style.display = "block";

    document.getElementById("ramalIP").style.display = "none";

  } else if (optvalue == 5) {

    document.getElementById("celularTablet").style.display = "none";

    document.getElementById("chipModem").style.display = "none";    

    document.getElementById("nota").style.display = "none";

    document.getElementById("ramalIP").style.display = "block";
  }else if (optvalue == 8 || optvalue == 9) {

    document.getElementById("celularTablet").style.display = "none";

    document.getElementById("chipModem").style.display = "none";    

    document.getElementById("nota").style.display = "none";

    document.getElementById("ramalIP").style.display = "none";

    document.getElementById("salvarButton").style.display = "none";

    document.getElementById("cpuNotebook").style.display = "block";

  }





}//FIM FUNÇÂO
