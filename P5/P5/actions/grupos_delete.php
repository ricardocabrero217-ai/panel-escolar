<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $id = post_int('id');
  if($id<=0) throw new RuntimeException("ID inválido.");

  $pdo = db();

  // si tiene alumnos, no borrar
  $st = $pdo->prepare("SELECT COUNT(*) c FROM alumnos WHERE grupo_id=?");
  $st->execute([$id]);
  $c = (int)$st->fetch()['c'];
  if($c>0) throw new RuntimeException("No se puede borrar: hay $c alumno(s) asignado(s) a este grupo.");

  $del = $pdo->prepare("DELETE FROM grupos WHERE id=?");
  $del->execute([$id]);

  flash_set('ok', 'Grupo eliminado.');
  redirect('../index.php?view=grupos');
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=grupos');
}
