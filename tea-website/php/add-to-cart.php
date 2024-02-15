<?php
// add-to-cart.php

// Połączenie z bazą danych (dostosuj dane dostępu)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea-website";

$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Odczytaj dane przesłane przez zapytanie AJAX
$data = json_decode(file_get_contents("php://input"));

// Przykład: Dodaj produkt do tabeli koszyka w bazie danych
$productId = $data->productId;
// Dodaj inne dane, jeśli są potrzebne

$sql = "INSERT INTO koszyk (product_id, quantity) VALUES (?, 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);

// Wykonaj zapytanie
if ($stmt->execute()) {
    $response = ['success' => true];
} else {
    $response = ['success' => false, 'error' => $stmt->error];
}

// Zwróć odpowiedź jako JSON
echo json_encode($response);

// Zamknij połączenie z bazą danych
$stmt->close();
$conn->close();
?>
