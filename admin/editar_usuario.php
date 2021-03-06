<?php
session_start();

include_once '../php/conexion.php';
$conexion = new Conexion();

if (isset($_SESSION['correo'])) {
  $usuarioCorreo = $_SESSION['correo'];
  $usuario = $conexion->connect()->query("SELECT * FROM usuarios WHERE correo = '$usuarioCorreo'");
  $usuario->execute();

  $rowUsuario = $usuario->fetch();

  if ($rowUsuario['rol'] != 0) {
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
  <title>CAPDAM</title>

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
          <div class="d-flex justify-content-between">
            <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Menú</li>

            <!-- <li class="sidebar-item  ">
              <a href="index.html" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
              </a>
            </li> -->

            <li class="sidebar-item  has-sub">
              <a href="#" class='sidebar-link'>
                <i class="fas fa-folder"></i>
                <span>Solicitudes</span>
              </a>
              <ul class="submenu ">
                <li class="submenu-item ">
                  <a href="index.php">Pendientes</a>
                </li>
                <li class="submenu-item ">
                  <a href="cotizar.php">Aceptadas</a>
                </li>
                <li class="submenu-item ">
                  <a href="cotizados.php">Cotizados</a>
                </li>
              </ul>
            </li>

            <li class="sidebar-item  has-sub">
              <a href="#" class='sidebar-link'>
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
              </a>
              <ul class="submenu ">
                <li class="submenu-item ">
                  <a href="usuarios.php">Lista de usuarios</a>
                </li>
                <li class="submenu-item ">
                  <a href="nuevo_jefe.php">Añadir jefe de área</a>
                </li>
                <li class="submenu-item ">
                  <a href="nuevo_recepcionista.php">Añadir recepcionista</a>
                </li>
              </ul>
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
                      <h6 class="mb-0 text-gray-600">Administrador</h6>
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
                <h3>Editar usuario</h3>
              </div>
            </div>
          </div>
          <section class="section">
            <div class="card">
              <div class="card-body">
                <form id="editUser">

                  <?php
                  $user = $conexion->connect()->query("SELECT * FROM usuarios WHERE id_usuario = " . $_GET['usuario']);
                  $user->execute();

                  $userRow = $user->fetch();

                  if ($userRow['delegacion'] != null and $userRow['delegacion'] != 0) {
                    $del = $conexion->connect()->query("SELECT * FROM delegaciones WHERE id_delegacion = " . $userRow['delegacion']);
                    $del->execute();

                    $delRow = $del->fetch();
                  }



                  ?>

                  <input type="text" name="id" hidden value="<?php echo $userRow['id_usuario']; ?>">


                  <div class="row">
                    <div class="col-sm-12 mb-2">
                      <label for="" class="form-label">Correo:</label>
                      <input type="text" name="correo" value="<?php echo $userRow['correo']; ?>" class="form-control">
                    </div>
                    <div class="col-sm-12 mb-2">
                      <label for="" class="form-label">Contraseña:</label>
                      <input type="text" name="password" value="" class="form-control" required>
                    </div>
                    <div class="col-sm-12 mb-2">

                      <?php
                      if ($userRow['delegacion'] != null AND $userRow['delegacion'] != 0) {
                      ?>
                        <label for="" class="form-label">Delegación:</label>
                        <select name="delegacion" class="form-select" required>
                          <?php
                          $queryDelegacion = $conexion->connect()->query("SELECT * FROM delegaciones WHERE id_delegacion != " . $userRow['delegacion']);
                          $queryDelegacion->execute();

                          $delegaciones = $queryDelegacion->fetchAll();

                          if ($userRow['delegacion'] == null) {

                            echo '<option value="0" selected>Seleccione una delegación</option>';
                          } else {
                            echo '<option value="' . $userRow['delegacion'] . '" selected>' . $delRow['delegacion'] . '</option>';
                          }

                          foreach ($delegaciones as $delegacion) {
                            echo '<option value="' . $delegacion['id_delegacion'] . '">' . $delegacion['delegacion'] . '</option>';
                          }
                          ?>
                        </select>

                      <?php } ?>
                    </div>
                    <div class="col-sm-12 mb-2">
                      <button type="submit" class="btn btn-sm btn-success">Guardar cambios</button>
                    </div>
                  </div>
                </form>
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
  </script>
</body>

</html>