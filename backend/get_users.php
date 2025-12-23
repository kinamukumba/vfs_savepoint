<?php
header("Content-Type: application/json");
require "db.php";
$stmt = $pdo->query("SELECT id, first_name, last_name FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);
