<?php

$pdo = db();

$carreras = $pdo->query("SELECT id, nombre, abreviatura FROM carreras WHERE activo=1 ORDER BY nombre ASC")->fetchAll();
$turnos   = $pdo->query("SELECT id, nombre, codigo FROM turnos WHERE activo=1 ORDER BY id ASC")->fetchAll();
$grados   = $pdo->query("SELECT id, nombre, numero FROM grados WHERE activo=1 ORDER BY numero ASC")->fetchAll();

$rows = $pdo->query("
  SELECT g.id, g.clave_completa, g.clave_num, c.nombre AS carrera, t.nombre AS turno, gr.nombre AS grado
  FROM grupos g
  JOIN carreras c ON c.id=g.carrera_id
  JOIN turnos t ON t.id=g.turno_id
  JOIN grados gr ON gr.id=g.grado_id
  ORDER BY g.id DESC
")->fetchAll();
?>
<section class="card span-2">
  <div class="card-head">
    <div>
      <h2>Registro de grupos</h2>
      <p>Carrera, turno y grado</p>
    </div>
    <span class="chip">Auto</span>
  </div>

  <div class="card-body">
    <form class="form" method="post" action="actions/grupos_create.php">
      <div>
        <label>Carrera</label>
        <select name="carrera_id" required>
          <?php foreach($carreras as $c): ?>
            <option value="<?= (int)$c['id'] ?>"><?= h($c['nombre']) ?> (<?= h($c['abreviatura']) ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label>Turno</label>
        <select name="turno_id" required>
          <?php foreach($turnos as $t): ?>
            <option value="<?= (int)$t['id'] ?>"><?= h($t['nombre']) ?> (<?= h($t['codigo']) ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label>Grado</label>
        <select name="grado_id" required>
          <?php foreach($grados as $g): ?>
            <option value="<?= (int)$g['id'] ?>"><?= h($g['nombre']) ?> (<?= (int)$g['numero'] ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label>Grupo</label>
        <input class="input" name="clave_num" type="number" min="1" value="1101" required />
       
      </div>

      <div class="full">
        <button class="btn green" type="submit">＋ Registrar grupo</button>
      </div>
    </form>

    <div style="height:16px;"></div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th style="width:90px;">ID</th>
            <th>Clave</th>
            <th>Carrera</th>
            <th style="width:160px;">Turno</th>
            <th style="width:210px;">Grado</th>
            <th style="width:120px;">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!$rows): ?>
            <tr><td colspan="6">No hay grupos registrados.</td></tr>
          <?php endif; ?>
          <?php foreach($rows as $r): ?>
            <tr>
              <td><?= (int)$r['id'] ?></td>
              <td><strong><?= h($r['clave_completa']) ?></strong></td>
              <td><?= h($r['carrera']) ?></td>
              <td><?= h($r['turno']) ?></td>
              <td><?= h($r['grado']) ?></td>
              <td>
                <form method="post" action="actions/grupos_delete.php" onsubmit="return confirm('¿Eliminar grupo? (Si tiene alumnos, no te dejará)');">
                  <input type="hidden" name="id" value="<?= (int)$r['id'] ?>" />
                  <button class="btn danger" type="submit">✕</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</section>
