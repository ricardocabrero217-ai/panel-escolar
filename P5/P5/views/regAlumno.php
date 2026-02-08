<?php

$pdo = db();
$grupos = $pdo->query("
  SELECT g.id, g.clave_completa
  FROM grupos g
  ORDER BY g.clave_completa ASC
")->fetchAll();
?>
<section class="card span-2">
  <div class="card-head">
    <div>
      <h2>Registro de alumnos</h2>
      <p>Llena los registros adecuados</p>
    </div>
    <span class="chip">Alta</span>
  </div>
  <div class="card-body">
    <form class="form" method="post" action="actions/alumnos_create.php">
      <div>
        <label>Nombre</label>
        <input class="input" name="nombre" placeholder="Nombre (s)" required />
      </div>
      <div>
        <label>Apellido paterno</label>
        <input class="input" name="apellido_paterno" placeholder="Apellido Paterno" required />
      </div>
      <div>
        <label>Apellido materno</label>
        <input class="input" name="apellido_materno" placeholder="Apellido Materno" required />
      </div>
      <div>
        <label>Sel. Grupo</label>
        <select name="grupo_id" required>
          <?php foreach($grupos as $g): ?>
            <option value="<?= (int)$g['id'] ?>"><?= h($g['clave_completa']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="full">
        <button class="btn primary" type="submit">＋ Registrar</button>
        <a class="btn ghost" href="?view=alumnos">Ver alumnos</a>
      </div>
    </form>
  </div>
</section>
