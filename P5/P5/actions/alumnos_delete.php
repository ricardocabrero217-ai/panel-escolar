<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $id = post_int('id');
  if($id<=0) throw new RuntimeException("ID inválido.");

  $pdo = db();
  $st = $pdo->prepare("SELECT id FROM alumnos WHERE id=?");
  $st->execute([$id]);
  if(!$st->fetch()) throw new RuntimeException("Alumno no encontrado.");

  $del = $pdo->prepare("DELETE FROM alumnos WHERE id=?");
  $del->execute([$id]);

  flash_set('ok', 'Alumno eliminado.');
  redirect('../index.php?view=alumnos');
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=alumnos');
}
