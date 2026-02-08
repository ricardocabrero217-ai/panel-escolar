<?php
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/helpers.php";

$panels = [
  "alumnos"   => "Alumnos registrados",
  "grupos"    => "Registro de grupos",
  "regAlumno" => "Registro de alumnos",
  "catalogos" => "Configuración de catálogos",
];

$default = "alumnos";
$view = $_GET["view"] ?? $default;
if (!array_key_exists($view, $panels)) $view = $default;

$flash = flash_get();

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>P5</title>
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>

<header class="topbar">
  <div class="topbar-inner">
    <div class="brand">
      <div class="logo" aria-hidden="true"></div>
      <div>
        <div class="title">Panel Escolar</div>
        
      </div>
    </div>

    <div class="right">
      <div class="dd" id="dd">
        <button class="dd-btn" type="button" id="ddBtn" aria-haspopup="true" aria-expanded="false">
          <div class="label">
            <small>Ventana</small>
            <strong><?= h($panels[$view]) ?></strong>
          </div>
          <span class="caret">▾</span>
        </button>

        <div class="dd-menu" id="ddMenu" role="menu" aria-label="Menú de paneles">
          <a class="dd-item" role="menuitem" href="?view=alumnos">
            <div class="pill"></div>
            <div>
              <div style="font-weight:900">Alumnos registrados</div>
              <div class="small">Editar / eliminar</div>
            </div>
          </a>
          <a class="dd-item" role="menuitem" href="?view=grupos">
            <div class="pill"></div>
            <div>
              <div style="font-weight:900">Registro de grupos</div>
              
            </div>
          </a>
          <a class="dd-item" role="menuitem" href="?view=regAlumno">
            <div class="pill"></div>
            <div>
              <div style="font-weight:900">Registro de alumnos</div>
              
            </div>
          </a>
          <a class="dd-item" role="menuitem" href="?view=catalogos">
            <div class="pill"></div>
            <div>
              <div style="font-weight:900">Configuración de catalogos</div>
              <div class="small">Carrera / Turno / Grado</div>
            </div>
          </a>
        </div>
      </div>

      <span class="chip">Escuela</span>
    </div>
  </div>
</header>

<main class="container">
  <?php if ($flash): ?>
    <div class="flash <?= $flash['type']==='ok'?'ok':'err' ?>">
      <strong><?= $flash['type']==='ok' ? 'Listo:' : 'Error:' ?></strong>
      <?= h($flash['msg']) ?>
    </div>
  <?php endif; ?>

  

  <div class="grid">
    <?php
      $viewFile = __DIR__ . "/views/{$view}.php";
      if (is_file($viewFile)) require $viewFile;
      else echo "<div class='card span-2'><div class='card-body'>Vista no encontrada.</div></div>";
    ?>

    

  </div>

  
</main>

<script src="assets/app.js"></script>
</body>
</html>
