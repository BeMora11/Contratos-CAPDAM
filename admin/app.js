//Cotizar
function cotizar(id) {
  let contrato = document.getElementById('id_contrato');
  contrato.value = id;

  const cotizacionForm = document.getElementById('cotizar');

  cotizacionForm.onsubmit = (e) => {

    e.preventDefault();

    const data = new FormData(cotizacionForm);

    fetch('php/cotizacion.php', {
        method: 'POST',
        body: data
      })
      .then(r => r.text())
      .then(r => {
        if (r == 1) {
          // console.log(r);
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cotización realizada satisfactoriamente',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout(() => {
            location.reload();
          }, 2000);
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Ha ocurrido un error',
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
      .catch(err => console.error(err));
  }
}