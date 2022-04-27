
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
                    Swal.fire({
                        title: 'Felicidades Su componentes Ha sido registrado con exito',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                      }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location = 'index.php';
                        } else if (result.isDenied) {
                            window.location = 'index.php';
                        }
                      })
                } else {
                    swal.fire('¡Owww!', datos, 'warning');
                }


            }

        });



    });
});




