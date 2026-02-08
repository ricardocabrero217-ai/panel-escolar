<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $id = post_int('id');
  $nombre = post_str('nombre');
  $ap = post_str('apellido_paterno');
  $am = post_str('apellido_materno');
  $grupo_id = post_int('grupo_id');

  if($id<=0) throw new RuntimeException("ID inválido.");
  if($nombre==='' || $ap==='' || $am==='' || $grupo_id<=0) throw new RuntimeException("Completa todos los campos.");

  $pdo = db();

  $st = $pdo->prepare("SELECT id FROM alumnos WHERE id=?");
  $st->execute([$id]);
  if(!$st->fetch()) throw new RuntimeException("Alumno no encontrado.");

  $stg = $pdo->prepare("SELECT id FROM grupos WHERE id=?");
  $stg->execute([$grupo_id]);
  if(!$stg->fetch()) throw new RuntimeException("Grupo inválido.");

  $up = $pdo->prepare("UPDATE alumnos SET nombre=?, apellido_paterno=?, apellido_materno=?, grupo_id=? WHERE id=?");
  $up->execute([$nombre,$ap,$am,$grupo_id,$id]);

  flash_set('ok', 'Alumno actualizado.');
  redirect('../index.php?view=alumnos');
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=alumnos');
}
