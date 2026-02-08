<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $nombre = post_str('nombre');
  $ap = post_str('apellido_paterno');
  $am = post_str('apellido_materno');
  $grupo_id = post_int('grupo_id');

  if($nombre==='' || $ap==='' || $am==='' || $grupo_id<=0){
    throw new RuntimeException("Completa todos los campos.");
  }

  $pdo = db();

  // validar grupo existe
  $st = $pdo->prepare("SELECT id FROM grupos WHERE id=?");
  $st->execute([$grupo_id]);
  if(!$st->fetch()){
    throw new RuntimeException("El grupo seleccionado no existe.");
  }

  $ins = $pdo->prepare("INSERT INTO alumnos (nombre, apellido_paterno, apellido_materno, grupo_id) VALUES (?,?,?,?)");
  $ins->execute([$nombre,$ap,$am,$grupo_id]);

  flash_set('ok', 'Alumno registrado correctamente.');
  redirect('../index.php?view=alumnos');
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=regAlumno');
}
