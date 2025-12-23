<?php
require "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("
  INSERT INTO users 
  (first_name, last_name, passport_number, birth_date, phone, email)
  VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->execute([
  $data["first_name"],
  $data["last_name"],
  $data["passport_number"],
  $data["birth_date"],
  $data["phone"],
  $data["email"]
]);

echo json_encode(["success" => true]);
