<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $tipo = post_str('tipo');
  $id = post_int('id');
  if($id<=0) throw new RuntimeException("ID inválido.");

  $pdo = db();

  if($tipo === 'carrera'){
    // Si hay grupos usando esa carrera, no borrar
    $st = $pdo->prepare("SELECT COUNT(*) c FROM grupos WHERE carrera_id=?");
    $st->execute([$id]);
    if((int)$st->fetch()['c']>0) throw new RuntimeException("No se puede borrar: hay grupos usando esta carrera.");
    $pdo->prepare("DELETE FROM carreras WHERE id=?")->execute([$id]);
    flash_set('ok', 'Carrera borrada.');
    redirect('../index.php?view=catalogos');
  }

  if($tipo === 'turno'){
    $st = $pdo->prepare("SELECT COUNT(*) c FROM grupos WHERE turno_id=?");
    $st->execute([$id]);
    if((int)$st->fetch()['c']>0) throw new RuntimeException("No se puede borrar: hay grupos usando este turno.");
    $pdo->prepare("DELETE FROM turnos WHERE id=?")->execute([$id]);
    flash_set('ok', 'Turno borrado.');
    redirect('../index.php?view=catalogos');
  }

  if($tipo === 'grado'){
    $st = $pdo->prepare("SELECT COUNT(*) c FROM grupos WHERE grado_id=?");
    $st->execute([$id]);
    if((int)$st->fetch()['c']>0) throw new RuntimeException("No se puede borrar: hay grupos usando este grado.");
    $pdo->prepare("DELETE FROM grados WHERE id=?")->execute([$id]);
    flash_set('ok', 'Grado borrado.');
    redirect('../index.php?view=catalogos');
  }

  throw new RuntimeException("Tipo inválido.");
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=catalogos');
}
