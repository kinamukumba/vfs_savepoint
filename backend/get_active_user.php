<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['ACTIVE_VFS_USER'])) {
  echo json_encode(["error" => "Nenhum usuário preparado"]);
  exit;
}

$pdo = new PDO(
  "mysql:host=localhost;dbname=vfs_agendamentos;charset=utf8",
  "root",
  "",
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$id = $_SESSION['ACTIVE_VFS_USER'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user);
