
$(document).ready(function() {
    $('#CGComponentRegister').on('submit', function(e) {
        e.preventDefault();

        var data = $("#CGComponentRegister").serialize();

        $.ajax({
            url: '../view/Insert__CGComponent.php',
            type: 'POST',
            data: data,
            success: function(datos) {
                if (datos == 2 || datos == '2') {
                    swal.fire('¡Oh Oh!', 'Hubo Un error, Verifique los datos', 'error');
                } else if (datos == 3 || datos == '3') {
                    swal.fire('¡Felicidades!', 'Felicidades Su componente ha sido registrado con exito', 'success');
                    window.location = '/';
                } else {
                    swal.fire('¡Owww!', datos, 'warning');
                }


            }

        });



    });
});
