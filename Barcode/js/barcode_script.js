function validarcampos(valor){
    if(valor.length <= 0 ){
           return true;
       }else{
           return false;
       }
    
}


function generar(){
    var inicial = $("#inicial").val();
    var type = $("#type").val();
    var cantidad = $("#cantidad").val();
    
    
    if(validarcampos(inicial)){
        swal.fire("Error", "Debes rellenar el campo","error");
        return;
    }else if(inicial.length<7){
        swal.fire("Error", "El Codigo debe ser de 10 digitos","error");
        return;
    }
    var parametros = "inicial="+inicial+"&type="+type+"&cantidad="+cantidad;
    $.ajax({
        url: 'generador.php',
        type: 'GET',
        data: parametros,
    })
    .done(function(datos){
        $("#root").append(datos);      
    })
    .fail(function(){
        swal.fire("Error", "Error de Generacion de Codigo","error");
    })
}

function imprSelec() {
	  var ficha = document.getElementById("root");
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}
