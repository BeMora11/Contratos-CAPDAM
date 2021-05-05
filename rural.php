<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/pages/auth.css">
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
        <!-- <div class="col-sm-12 mb-2">
          <label class="form-label">Delegación:</label>
          <select name="delegacion" class="form-select">
            <option selected>Seleccione una delegación</option>
            <option>Seleccione una delegación</option>
            <option>Seleccione una delegación</option>
            <option>Seleccione una delegación</option>
          </select>
        </div> -->
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
            alert('Solicitud enviada correctamente');
            contratacionRural.reset();
          } else {
            alert('Ha ocurrido un error');
          }
        })
        .catch(err => console.log(err));
    }
  </script>
</body>

</html>