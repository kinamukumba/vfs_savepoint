<?php
session_start();
header("Content-Type: application/json");

$id = $_POST['id'] ?? null;

if (!$id) {
  echo json_encode(["error" => "ID inválido"]);
  exit;
}

$_SESSION['ACTIVE_VFS_USER'] = $id;

echo json_encode(["success" => true]);
