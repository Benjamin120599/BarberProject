function validarFormulario() {

    var dato = document.getElementById('caja_usuario').value;
    if(dato == null) {
        return false;
    }

    /*Validación de numero de control con solo NUMEROS
    var numControl = document.getElementById('num_control').value;
    if(numControl == null || numControl.length == 0 || isNaN(numControl)) {
        return false;    
    }

    //Validación del semestre seleccionado
    var semestre = document.getElementById('semestre');
    var indice = semestre.selectedIndex;
    var opcion = semestre.options[indice].value;

    if(opcion == 0 {
        console.log("No se ha elegido nada");
        return false;
    }

    //Validación de correo electronico
    valor = document.getElementById("correo").value;
    if( !(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(valor)) ) {
      return false;
    }*/



    return true;
}