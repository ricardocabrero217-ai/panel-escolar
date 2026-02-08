<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $carrera_id = post_int('carrera_id');
  $turno_id   = post_int('turno_id');
  $grado_id   = post_int('grado_id');
  $clave_num  = post_int('clave_num', 1101);

  if($carrera_id<=0 || $turno_id<=0 || $grado_id<=0) throw new RuntimeException("Selecciona carrera, turno y grado.");
  if($clave_num<=0) throw new RuntimeException("La clave debe ser positiva.");

  $pdo = db();

  // Obtener abreviatura carrera y código turno
  $c = $pdo->prepare("SELECT abreviatura FROM carreras WHERE id=? AND activo=1");
  $c->execute([$carrera_id]);
  $car = $c->fetch();
  if(!$car) throw new RuntimeException("Carrera inválida o desactivada.");

  $t = $pdo->prepare("SELECT codigo FROM turnos WHERE id=? AND activo=1");
  $t->execute([$turno_id]);
  $tur = $t->fetch();
  if(!$tur) throw new RuntimeException("Turno inválido o desactivado.");

  $g = $pdo->prepare("SELECT numero FROM grados WHERE id=? AND activo=1");
  $g->execute([$grado_id]);
  $gra = $g->fetch();
  if(!$gra) throw new RuntimeException("Grado inválido o desactivado.");

  // Regla: si existe el mismo (carrera, turno, grado, clave_num), entonces aumenta hasta encontrar libre.
  $next = $clave_num;
  while(true){
    $st = $pdo->prepare("SELECT id FROM grupos WHERE carrera_id=? AND turno_id=? AND grado_id=? AND clave_num=?");
    $st->execute([$carrera_id,$turno_id,$grado_id,$next]);
    if(!$st->fetch()) break;
    $next++;
  }

  $clave_completa = $car['abreviatura'] . "-" . $next . "-" . $tur['codigo'];

  $ins = $pdo->prepare("INSERT INTO grupos (carrera_id, turno_id, grado_id, clave_num, clave_completa) VALUES (?,?,?,?,?)");
  $ins->execute([$carrera_id,$turno_id,$grado_id,$next,$clave_completa]);

  if($next !== $clave_num){
    flash_set('ok', "Grupo registrado. La clave ya existía, se ajustó automáticamente a: $clave_completa");
  }else{
    flash_set('ok', "Grupo registrado: $clave_completa");
  }
  redirect('../index.php?view=grupos');
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=grupos');
}
