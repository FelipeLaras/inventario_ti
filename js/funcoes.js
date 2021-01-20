/* função usada em -> ../front/funcionariodocumentos.php */
function documento() {
    var optvalue = document.getElementById("tipo_documento").value;
  
    if (optvalue == 1) {
      document.getElementById("datanota").style.display = "block";
  
      document.getElementById("listEquip").style.display = "none";
  
    } else if (optvalue == 2 || optvalue == 3) {
  
      document.getElementById("datanota").style.display = "none";
  
      document.getElementById("listEquip").style.display = "block";
    } else {
  
      document.getElementById("datanota").style.display = "none";
  
      document.getElementById("listEquip").style.display = "none";
    }
  }
  
  /* função usada em -> ../front/funcionariodocumentos.php */
  function notas(){
  
    var optvalue = document.getElementById("tipo_nota").value;
  
    if (optvalue == 1 || optvalue == 2) {
      document.getElementById("listEquip").style.display = "block";
  
    } else{
      document.getElementById("listEquip").style.display = "none";
    }
    
  }
  
  
  //END FELIPE