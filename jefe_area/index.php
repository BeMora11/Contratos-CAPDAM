<?php
session_start();

include_once '../php/conexion.php';
$conexion = new Conexion();

if (isset($_SESSION['correo'])) {
  $usuarioCorreo = $_SESSION['correo'];
  $usuario = $conexion->connect()->query("SELECT * FROM usuarios WHERE correo = '$usuarioCorreo'");
  $usuario->execute();

  $rowUsuario = $usuario->fetch();

  $delegacion = $conexion->connect()->query("SELECT * FROM delegaciones WHERE id_delegacion =" . $rowUsuario['delegacion']);
  $delegacion->execute();

  $rowDelegacion = $delegacion->fetch();

  if ($rowUsuario['rol'] != 1) {
    header("Location: ../index.php");
  }
} else {
  header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/app.css">
  <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css">
</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header">
        <div class="text-center">
            <a href="index.php"><img src="../assets/images/logo_fondo.png" class="w-100 h-100" alt="Logo" srcset=""></a>
          </div>
          <div class="d-flex justify-content-between">
            <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Menú</li>

            <li class="sidebar-item  ">
              <a href="index.php" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Cotizar</span>
              </a>
            </li>
          </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
    </div>
    <div id="main" class='layout-navbar'>
      <header class='mb-3'>
        <nav class="navbar navbar-expand navbar-light ">
          <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
              <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
              </ul>
              <div class="dropdown">
                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="user-menu d-flex">
                    <div class="user-name text-end me-3">
                      <h6 class="mb-0 text-gray-600">Delegación: <?php echo $rowDelegacion['delegacion']; ?></h6>
                      <h6 class="mb-0 text-gray-600"><?php echo $rowUsuario['correo']; ?> </h6>
                    </div>
                    <div class="user-img d-flex align-items-center">
                      <div class="avatar avatar-md">
                        <img src="../assets/images/logo.png">
                      </div>
                    </div>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="../php/logout.php"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Cerrar sesión</a></li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </header>
      <div id="main-content">

        <div class="page-heading">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Solicitudes pendientes</h3>
              </div>
            </div>
          </div>
          <section class="section">
            <div class="card">
              <div class="card-body">
                <table class="table table-striped" id="table1">
                  <thead>
                    <tr class="text-center">
                      <th>Nombre</th>
                      <th>No. contrato</th>
                      <th>Domicilio</th>
                      <th>Tipo de contrato</th>
                      <th>Estatus</th>
                      <th>Fecha de solicitud</th>
                      <th>Adjuntos</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $query = $conexion->connect()->query("SELECT * FROM contratacion WHERE estado = 1 AND delegacion =".$rowDelegacion['id_delegacion']);
                    $query->execute();

                    $solicitudes = $query->fetchAll();

                    foreach ($solicitudes as $solicitud) {

                      $estado = '';
                      $vocacion;

                      if ($solicitud['vocacion_uso'] != null) {
                        $vocacion = '<a class="dropdown-item" href="../solicitudes/' . $solicitud['correo'] . '/' . $solicitud['vocacion_uso'] . '" target="_blank">Vocación de uso de suelo</a>';
                      } else {
                        $vocacion = '';
                      }

                      if ($solicitud['estado'] == 1) {
                        $estado = 'Aceptado';
                      }

                      echo '<tr class="text-center">
                                <td>' . $solicitud['nombre'] . ' ' . $solicitud['apellidos'] . '</td>
                                <td>' . $solicitud['id_contratacion'] . '</td>
                                <td>' . $solicitud['domicilio'] . '</td>
                                <td>' . $solicitud['tipo'] . '</td>
                                <td><span class="badge bg-success">' . $estado . '</span></td>
                                <td>' . strftime('%m-%d-%Y %I:%M %p', strtotime($solicitud['fecha_solicitud'])) . '</td>
                                <td>
                                <a target="_blank" href="../solicitudes/' . $solicitud['correo'] . '/' . $solicitud['inspeccion'] . '" class="btn btn-sm btn-info"><i class="fas fa-file me-1"></i>Inspección</a>
                                </td>
                                <td>
                                <div class="row">
                                  <div class="col-sm-12 mb-1">
                                    <button data-bs-toggle="modal" data-bs-target="#modalCotizacion" onclick="cotizar(' . $solicitud['id_contratacion'] . ')" class="btn btn-sm btn-primary">Cotizar</button>
                                  </div>
                                </td>
                              </tr>';
                    }
                    ?>
                  </tbody>
                </table>
                <!-- Modal para cotizar-->
                <div class="modal fade" id="modalCotizacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cotización</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form id="cotizar">
                        <input type="text" hidden name="id_contrato" id="id_contrato">
                        <div class="modal-body">
                          <label class="form-label">Archivo de cotización</label>
                          <input type="file" name="cotizacion" class="form-control" required>
                        </div>
                        <div class="modal-body">
                          <label class="form-label">Archivo de inspección</label>
                          <input type="file" name="inspeccion" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Enviar cotización</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="app.js"></script>

  <script>
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
  </script>
</body>

</html>