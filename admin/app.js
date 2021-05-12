//Nuevo Jefe

const newJefe = document.getElementById('newJefe');

if (newJefe) {
  newJefe.onsubmit = (e) => {
    e.preventDefault();

    data = new FormData(newJefe);

    fetch('php/newJefe.php', {
        method: 'POST',
        body: data
      })
      .then(r => r.text())
      .then(r => {
        if (r == 1) {
          newJefe.reset();
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Usuario creado',
            showConfirmButton: false,
            timer: 1500
          })
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

//Nuevo Recepcionista

const newRecepcionista = document.getElementById('newRecepcionista');

if (newRecepcionista) {
  newRecepcionista.onsubmit = (e) => {
    e.preventDefault();

    data = new FormData(newRecepcionista);

    fetch('php/newRecepcionista.php', {
        method: 'POST',
        body: data
      })
      .then(r => r.text())
      .then(r => {
        if (r == 1) {
          newRecepcionista.reset();
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Usuario creado',
            showConfirmButton: false,
            timer: 1500
          })
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

//Eliminar usuario

function deleteUser(id) {
  Swal.fire({
    title: '¿Desea eliminar a este usuario?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, enviar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      let data = new FormData();

      data.append('id', id);

      fetch('php/deleteUser.php', {
          method: 'POST',
          body: data
        })
        .then(r => r.text())
        .then(r => {
          if (r == 1) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Usuario eliminado',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(() => {
              location.reload();
            }, 1500);
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

//Editar usuario

const editUser = document.getElementById('editUser');

if (editUser) {
  editUser.onsubmit = (e) => {
    e.preventDefault();

    data = new FormData(editUser);

    fetch('php/editUser.php', {
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
            title: 'Usuario actualizado',
            showConfirmButton: false,
            timer: 1500
          })
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