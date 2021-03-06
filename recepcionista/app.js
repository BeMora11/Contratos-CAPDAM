//Rechazar solicitud
function rechazar_solicitud(id) {
  Swal.fire({
    title: '¿Desea rechazar esta solicitud?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, rechazar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      const data = new FormData();
      data.append("id", id);

      fetch('php/rechazar_solicitud.php', {
          method: 'POST',
          body: data
        })
        .then(r => r.text())
        .then(r => {
          console.log(r)
          if (r == 1) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Solicitud rechazada satisfactoriamente',
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
  })
}

//anexar inspeccion y enviar

function infoSolicitud(id) {
  const data = new FormData();
  data.append("id", id);

  fetch('php/contrato.php', {
      method: 'POST',
      body: data
    })
    .then(r => r.json())
    .then(r => {
      // console.log(r)
      document.getElementById('id_contrato').value = r.id_contratacion;
    })
    .catch(err => console.error(err));
}

//Aceptar solicitud

const aceptarForm = document.getElementById('aceptar');

if(aceptarForm){
  aceptarForm.onsubmit = (e) => {
    e.preventDefault();
  
    const data = new FormData(aceptarForm);
  
    fetch('php/aceptar_solicitud.php', {
        method: 'POST',
        body: data
      })
      .then(r => r.text())
      .then(r => {
        // console.log(r)
        if (r == 1) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Solicitud aceptada satisfactoriamente',
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

//Enviar cotización

function enviarCotizacion(id) {
  Swal.fire({
    title: '¿Desea enviar la cotización a este usuario?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, enviar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      const data = new FormData();
      data.append("id", id);

      fetch('php/enviar_cotizacion.php', {
          method: 'POST',
          body: data
        })
        .then(r => r.text())
        .then(r => {
          console.log(r)
          if (r == 1) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Cotización enviada correctamente',
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
  })
}