<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/helpers.php";

try{
  $tipo = post_str('tipo');
  $pdo = db();

  if($tipo === 'carrera'){
    $nombre = post_str('nombre');
    $abrev  = strtoupper(post_str('abreviatura'));
    if($nombre==='' || $abrev==='') throw new RuntimeException("Completa nombre y abreviatura.");
    $st = $pdo->prepare("INSERT INTO carreras (nombre, abreviatura) VALUES (?,?)");
    $st->execute([$nombre, $abrev]);
    flash_set('ok', 'Carrera registrada.');
    redirect('../index.php?view=catalogos');
  }

  if($tipo === 'turno'){
    $nombre = post_str('nombre');
    $codigo = strtoupper(post_str('codigo'));
    if($nombre==='' || $codigo==='') throw new RuntimeException("Completa nombre y código.");
    if(!preg_match('/^[MVX]$/', $codigo)) throw new RuntimeException("Código inválido. Usa M, V o X.");
    $st = $pdo->prepare("INSERT INTO turnos (nombre, codigo) VALUES (?,?)");
    $st->execute([$nombre, $codigo]);
    flash_set('ok', 'Turno registrado.');
    redirect('../index.php?view=catalogos');
  }

  if($tipo === 'grado'){
    $nombre = post_str('nombre');
    $numero = post_int('numero');
    if($nombre==='' || $numero<=0) throw new RuntimeException("Completa nombre y número.");
    $st = $pdo->prepare("INSERT INTO grados (nombre, numero) VALUES (?,?)");
    $st->execute([$nombre, $numero]);
    flash_set('ok', 'Grado registrado.');
    redirect('../index.php?view=catalogos');
  }

  throw new RuntimeException("Tipo inválido.");
}catch(Throwable $e){
  flash_set('err', $e->getMessage());
  redirect('../index.php?view=catalogos');
}
