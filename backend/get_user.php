<?php
header("Content-Type: application/json");

require "db.php";

$id = $_GET['id'] ?? null;
if (!$id) {
  echo json_encode(["error" => "ID inválido"]);
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user);
