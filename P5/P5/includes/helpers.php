<?php
// includes/helpers.php
function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

function redirect(string $to): void {
  header("Location: $to");
  exit;
}

function flash_set(string $type, string $msg): void {
  if (session_status() === PHP_SESSION_NONE) session_start();
  $_SESSION['flash'] = ['type'=>$type, 'msg'=>$msg];
}

function flash_get(): ?array {
  if (session_status() === PHP_SESSION_NONE) session_start();
  if (!isset($_SESSION['flash'])) return null;
  $f = $_SESSION['flash'];
  unset($_SESSION['flash']);
  return $f;
}

function post_str(string $key, string $default=''): string {
  return isset($_POST[$key]) ? trim((string)$_POST[$key]) : $default;
}
function post_int(string $key, int $default=0): int {
  return isset($_POST[$key]) ? (int)$_POST[$key] : $default;
}
