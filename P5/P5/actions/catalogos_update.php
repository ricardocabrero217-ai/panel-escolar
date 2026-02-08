<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $tipo = post_str('tipo');
  $id = post_int('id');
  $activo = post_int('activo');

  if($id<=0) throw new RuntimeException("ID inválido.");

  $pdo = db();

  if($tipo === 'carrera'){
    $st = $pdo->prepare("UPDATE carreras SET activo=? WHERE id=?");
    $st->execute([$activo ? 1:0, $id]);
    flash_set('ok', 'Carrera actualizada.');
    redirect('../index.php?view=catalogos');
  }
  if($tipo === 'turno'){
    $st = $pdo->prepare("UPDATE turnos SET activo=? WHERE id=?");
    $st->execute([$activo ? 1:0, $id]);
    flash_set('ok', 'Turno actualizado.');
    redirect('../index.php?view=catalogos');
  }
  if($tipo === 'grado'){
    $st = $pdo->prepare("UPDATE grados SET activo=? WHERE id=?");
    $st->execute([$activo ? 1:0, $id]);
    flash_set('ok', 'Grado actualizado.');
    redirect('../index.php?view=catalogos');
  }

  throw new RuntimeException("Tipo inválido.");
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=catalogos');
}
