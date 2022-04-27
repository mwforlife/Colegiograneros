function delete__component(id){
    Swal.fire({
        title: '¿Estas Seguro de Eliminar Este Componente?',
        showDenyButton: true,
        confirmButtonText: 'Si, Eliminar',
        denyButtonText: `No, Cancelar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('Eliminado!', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('Genial!', '', 'info')
        }
      })
}