<?php

$pdo = db();

$carreras = $pdo->query("SELECT * FROM carreras ORDER BY nombre ASC")->fetchAll();
$turnos   = $pdo->query("SELECT * FROM turnos ORDER BY id ASC")->fetchAll();
$grados   = $pdo->query("SELECT * FROM grados ORDER BY numero ASC")->fetchAll();

?>
<section class="card span-2">
  <div class="card-head">
    <div>
      <h2>Configuración de catalogos</h2>
      <p>Registrar, actualizar y borrar: Carrera, Turno y Grado</p>
    </div>
    <span class="chip">Cata logos</span>
  </div>

  <div class="card-body">
    <div class="grid">
      <!-- Carrera -->
      <section class="card">
        <div class="card-head">
          <div>
            <h2>Carreras</h2>
            <p>Registra la carrera</p>
          </div>
        </div>
        <div class="card-body">
          <form class="form" method="post" action="actions/catalogos_create.php">
            <input type="hidden" name="tipo" value="carrera">
            <div class="full">
              <label>Nombre</label>
              <input class="input" name="nombre" required placeholder="Nombre">
            </div>
            <div class="full">
              <label>Abreviatura</label>
              <input class="input" name="abreviatura" required placeholder="Ejemplo: ISC" maxlength="10">
            </div>
            <div class="full">
              <button class="btn primary" type="submit">＋ Registrar carrera</button>
            </div>
          </form>

          <div style="height:12px;"></div>

          <div class="table-wrap">
            <table style="min-width:560px;">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th style="width:110px;">Abrev.</th>
                  <th style="width:120px;">Activo</th>
                  <th style="width:220px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($carreras as $c): ?>
                  <tr>
                    <td><?= h($c['nombre']) ?></td>
                    <td><?= h($c['abreviatura']) ?></td>
                    <td><?= (int)$c['activo'] ? 'Sí' : 'No' ?></td>
                    <td>
                      <div class="actions">
                        <form method="post" action="actions/catalogos_update.php" style="display:inline;">
                          <input type="hidden" name="tipo" value="carrera">
                          <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
                          <input type="hidden" name="activo" value="<?= (int)$c['activo'] ? '0':'1' ?>">
                          <button class="btn warn" type="submit"><?= (int)$c['activo'] ? 'Desactivar' : 'Activar' ?></button>
                        </form>
                        <form method="post" action="actions/catalogos_delete.php" style="display:inline;" onsubmit="return confirm('¿Borrar carrera?');">
                          <input type="hidden" name="tipo" value="carrera">
                          <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
                          <button class="btn danger" type="submit">✕ Borrar</button>
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

      <!-- Turnos -->
      <section class="card">
        <div class="card-head">
          <div>
            <h2>Turnos</h2>
            <p>Matutino, Vespertino, Mixto</p>
          </div>
        </div>
        <div class="card-body">
          <form class="form" method="post" action="actions/catalogos_create.php">
            <input type="hidden" name="tipo" value="turno">
            <div class="full">
              <label>Nombre</label>
              <input class="input" name="nombre" required placeholder="Ej. Matutino">
            </div>
            <div class="full">
              <label>Código</label>
              <input class="input" name="codigo" required placeholder="M / V / X" maxlength="1">
              
            </div>
            <div class="full">
              <button class="btn primary" type="submit">＋ Registrar turno</button>
            </div>
          </form>

          <div style="height:12px;"></div>

          <div class="table-wrap">
            <table style="min-width:520px;">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th style="width:90px;">COdigo</th>
                  <th style="width:120px;">Activo</th>
                  <th style="width:220px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($turnos as $t): ?>
                  <tr>
                    <td><?= h($t['nombre']) ?></td>
                    <td><?= h($t['codigo']) ?></td>
                    <td><?= (int)$t['activo'] ? 'Sí' : 'No' ?></td>
                    <td>
                      <div class="actions">
                        <form method="post" action="actions/catalogos_update.php" style="display:inline;">
                          <input type="hidden" name="tipo" value="turno">
                          <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
                          <input type="hidden" name="activo" value="<?= (int)$t['activo'] ? '0':'1' ?>">
                          <button class="btn warn" type="submit"><?= (int)$t['activo'] ? 'Desactivar' : 'Activar' ?></button>
                        </form>
                        <form method="post" action="actions/catalogos_delete.php" style="display:inline;" onsubmit="return confirm('¿Borrar turno?');">
                          <input type="hidden" name="tipo" value="turno">
                          <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
                          <button class="btn danger" type="submit">✕ Borrar</button>
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

    
      <section class="card span-2">
        <div class="card-head">
          <div>
            <h2>Grados</h2>
          
          </div>
        </div>
        <div class="card-body">
          <form class="form" method="post" action="actions/catalogos_create.php">
            <input type="hidden" name="tipo" value="grado">
            <div>
              <label>Nombre</label>
              <input class="input" name="nombre" required placeholder="Ejemplo: 10mo cuatrimestre">
            </div>
            <div>
              <label>Número</label>
              <input class="input" name="numero" required type="number" min="1" placeholder="10">
            </div>
            <div class="full">
              <button class="btn primary" type="submit">＋ Registrar grado</button>
            </div>
          </form>

          <div style="height:12px;"></div>

          <div class="table-wrap">
            <table style="min-width:720px;">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th style="width:120px;">Número</th>
                  <th style="width:120px;">Activo</th>
                  <th style="width:220px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($grados as $g): ?>
                  <tr>
                    <td><?= h($g['nombre']) ?></td>
                    <td><?= (int)$g['numero'] ?></td>
                    <td><?= (int)$g['activo'] ? 'Sí' : 'No' ?></td>
                    <td>
                      <div class="actions">
                        <form method="post" action="actions/catalogos_update.php" style="display:inline;">
                          <input type="hidden" name="tipo" value="grado">
                          <input type="hidden" name="id" value="<?= (int)$g['id'] ?>">
                          <input type="hidden" name="activo" value="<?= (int)$g['activo'] ? '0':'1' ?>">
                          <button class="btn warn" type="submit"><?= (int)$g['activo'] ? 'Desactivar' : 'Activar' ?></button>
                        </form>
                        <form method="post" action="actions/catalogos_delete.php" style="display:inline;" onsubmit="return confirm('¿Borrar grado?');">
                          <input type="hidden" name="tipo" value="grado">
                          <input type="hidden" name="id" value="<?= (int)$g['id'] ?>">
                          <button class="btn danger" type="submit">✕ Borrar</button>
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

    </div>
  </div>
</section>
