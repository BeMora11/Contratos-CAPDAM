<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zona rural</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/pages/auth.css">
  <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="" href="#"><img src="assets/images/logo.png" width="65" height="65" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="rural.php">Zona rural</a>
          <a class="nav-link" href="urbana.php">Zona urbana</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <h4 class="mt-4">Contratación de agua y drenaje (Zona rural)</h4>
    <form action="" method="POST" id="contratacionRural" enctype="multipart/form-data">
      <input type="text" hidden value="Rural" name="tipo_contrato">
      <div class="row my-5">
        <div class="col-sm-6 mb-2">
          <label class="form-label">Nombre:</label>
          <input type="text" placeholder="Ingresa tu nombre" name="nombre" class="form-control" required>
        </div>
        <div class="col-sm-6 mb-2">
          <label class="form-label">Apellidos:</label>
          <input type="text" placeholder="Ingresa tus apellidos" name="apellidos" class="form-control" required>
        </div>
        <div class="col-sm-6 mb-2">
          <label class="form-label">Correo:</label>
          <input type="text" placeholder="Ingresa tu correo electrónico" name="correo" class="form-control" required>
        </div>
        <div class="col-sm-6 mb-2">
          <label class="form-label">Telefono:</label>
          <input type="text" placeholder="Ingresa tu numero de telefono" name="telefono" class="form-control" required>
        </div>
        <div class="col-sm-12 mb-2">
          <label class="form-label">Domicilio:</label>
          <input type="text" placeholder="Ingresa tu domicilio" name="domicilio" class="form-control" required>
        </div>
        <div class="col-sm-12 mb-2">
          <label class="form-label">Clave catastral:</label>
          <input type="text" placeholder="Ingresa tu clave catastral" name="clave" class="form-control" required>
        </div>
        <div class="col-sm-12 mb-2">
          <label class="form-label">Tipo de contrato:</label>
          <select name="tipo" class="form-select">
            <option selected>Seleccione un tipo de contrato</option>
            <option value="Domestico A">Domestico A</option>
            <option value="Domestico B">Domestico B</option>
            <option value="Mixto">Mixto</option>
            <option value="Condominal">Condominal</option>
            <option value="Condominal B">Condominal B</option>
            <option value="Comercial A">Comercial A</option>
            <option value="Industrial">Industrial</option>
            <option value="Domestico zona rural">Domestico zona rural</option>
          </select>
        </div>
        <div class="col-sm-12 mb-2">
          <label class="form-label">Delegación:</label>
          <select name="delegacion" class="form-select" required>
            <option selected>Seleccione una delegación</option>
            <?php
            include_once 'php/conexion.php';
            $conexion = new Conexion();

            $query = $conexion->connect()->query("SELECT * FROM delegaciones");
            $query->execute();

            $delegaciones = $query->fetchAll();

            foreach ($delegaciones as $delegacion) {
              echo '<option value="' . $delegacion['id_delegacion'] . '">' . $delegacion['delegacion'] . '</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-sm-4 mb-2">
          <label class="form-label">Copia de derecho de posesión o constancia del ejido firmada y sellada:</label>
          <input type="file" name="posesion" class="form-control" required>
        </div>
        <div class="col-sm-4 mb-2">
          <label class="form-label">Copia de predial:</label>
          <input type="file" name="predial" class="form-control" required>
        </div>
        <div class="col-sm-4 mb-2">
          <label class="form-label">Copia de INE:</label>
          <input type="file" name="ine" class="form-control" required>
        </div>
        <div class="col-sm-4 mb-2">
          <label class="form-label">Copia de CURP:</label>
          <input type="file" name="curp" class="form-control" required>
        </div>
        <div class="col-sm-8 mb-2">
          <label class="form-label">Fotografia de fachada del predio:</label>
          <input type="file" name="fachada" class="form-control" required>
        </div>
        <div class="col-sm-12">
          <button type="submit" class="btn btn-success">Enviar solicitud</button>
        </div>
      </div>
    </form>
  </div>

  <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

  <script>
    const contratacionRural = document.getElementById('contratacionRural');

    contratacionRural.onsubmit = function(e) {
      e.preventDefault();

      let data = new FormData(contratacionRural);

      // console.log(data)

      fetch('php/solicitudes.php', {
          method: "POST",
          body: data
        })
        .then(r => r.text())
        .then(r => {
          console.log(r)
          if (r == 1) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Solicitud enviada correctamente',
              showConfirmButton: false,
              timer: 1500
            })
            contratacionUrbana.reset();
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
        .catch(err => console.log(err));

    }
  </script>
</body>

</html>