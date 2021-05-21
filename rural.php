<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
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
  <div class="container">
    <h4 class="mt-4">Contratación de agua y drenaje (Zona rural)</h4>
    <form action="" method="POST" id="contratacionRural" enctype="multipart/form-data">
      <input type="text" hidden value="Rural" name="tipo_contrato">
      <div class="row mt-5">
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
        <div class="col-sm-12 mb-2" style="height: 250px;">
          <div id="map"></div>
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

  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSWjNRJdjcKyVfPgym0tcqMISTdRc2Tls&callback=iniciarMap()"></script> -->

  <script>
    function findMe() {
      var output = document.getElementById('map');

      // Verificar si soporta geolocalizacion
      if (navigator.geolocation) {
        output.innerHTML = "<p>Tu navegador soporta Geolocalizacion</p>";
      } else {
        output.innerHTML = "<p>Tu navegador no soporta Geolocalizacion</p>";
      }

      //Obtenemos latitud y longitud
      function localizacion(posicion) {

        var latitude = posicion.coords.latitude;
        var longitude = posicion.coords.longitude;

        var imgURL = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&size=600x300&markers=color:red%7C" + latitude + "," + longitude + "&key=AIzaSyDSWjNRJdjcKyVfPgym0tcqMISTdRc2Tls";

        output.innerHTML = "<img src='" + imgURL + "'>";



      }

      function error() {
        output.innerHTML = "<p>No se pudo obtener tu ubicación</p>";

      }

      navigator.geolocation.getCurrentPosition(localizacion, error);

    }

    findMe();

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
              title: 'Solicitud aceptada satisfactoriamente',
              showConfirmButton: false,
              timer: 1500
            })
            contratacionRural.reset();
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

  <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
</body>

</html>