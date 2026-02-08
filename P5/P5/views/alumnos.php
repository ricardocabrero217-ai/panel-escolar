<?php

$pdo = db();


$rows = $pdo->query("
  SELECT a.id, a.nombre, a.apellido_paterno, a.apellido_materno,
         g.clave_completa AS grupo
  FROM alumnos a
  JOIN grupos g ON g.id = a.grupo_id
  ORDER BY a.id DESC
")->fetchAll();

$grupos = $pdo->query("
  SELECT id, clave_completa
  FROM grupos
  ORDER BY clave_completa ASC
")->fetchAll();

$editId = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$editRow = null;
if ($editId > 0) {
  $st = $pdo->prepare("SELECT * FROM alumnos WHERE id=?");
  $st->execute([$editId]);
  $editRow = $st->fetch();
}
?>
<section class="card span-2">
  <div class="card-head">
    <div>
      <h2>Alumnos registrados</h2>
      <p>Agregar, editar y eliminar alumnos</p>
    </div>
    <span class="chip">CRUD</span>
  </div>

  <div class="card-body">
    <div class="actions" style="justify-content:flex-end;margin-bottom:12px;">
      <a class="btn info" href="?view=alumnos"><span>↺</span> Limpiar edición</a>
      <a class="btn primary" href="?view=regAlumno"><span>＋</span> Registrar alumno</a>
    </div>

    <?php if ($editRow): ?>
      <div class="card" style="margin-bottom:14px;">
        <div class="card-head">
          <div>
            <h2>Editar alumno #<?= (int)$editRow['id'] ?></h2>
            <p>Actualiza los datos y guarda cambios.</p>
          </div>
        </div>
        <div class="card-body">
          <form class="form" method="post" action="actions/alumnos_update.php">
            <input type="hidden" name="id" value="<?= (int)$editRow['id'] ?>" />
            <div>
              <label>Nombre</label>
              <input class="input" name="nombre" required value="<?= h($editRow['nombre']) ?>" />
            </div>
            <div>
              <label>Apellido paterno</label>
              <input class="input" name="apellido_paterno" required value="<?= h($editRow['apellido_paterno']) ?>" />
            </div>
            <div>
              <label>Apellido materno</label>
              <input class="input" name="apellido_materno" required value="<?= h($editRow['apellido_materno']) ?>" />
            </div>
            <div>
              <label>Grupo</label>
              <select name="grupo_id" required>
                <?php foreach ($grupos as $g): ?>
                  <option value="<?= (int)$g['id'] ?>" <?= (int)$g['id']===(int)$editRow['grupo_id'] ? 'selected' : '' ?>>
                    <?= h($g['clave_completa']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="full">
              <button class="btn warn" type="submit"><span>✎</span> Guardar cambios</button>
              <a class="btn ghost" href="?view=alumnos">Cancelar</a>
            </div>
          </form>
        </div>
      </div>
    <?php endif; ?>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th style="width:90px;">ID</th>
            <th>Alumno</th>
            <th style="width:240px;">Grupo</th>
            <th style="width:260px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!$rows): ?>
            <tr><td colspan="4">No hay alumnos registrados aún.</td></tr>
          <?php endif; ?>

          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= (int)$r['id'] ?></td>
              <td><?= h($r['nombre']." ".$r['apellido_paterno']." ".$r['apellido_materno']) ?></td>
              <td><?= h($r['grupo']) ?></td>
              <td>
                <div class="actions">
                  <a class="btn warn" href="?view=alumnos&edit=<?= (int)$r['id'] ?>">✎ Editar</a>
                  <form method="post" action="actions/alumnos_delete.php" onsubmit="return confirm('¿Eliminar este alumno?');" style="display:inline;">
                    <input type="hidden" name="id" value="<?= (int)$r['id'] ?>" />
                    <button class="btn danger" type="submit">✕ Eliminar</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    
  </div>
</section>
