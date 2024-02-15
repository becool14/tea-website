<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="media/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Shop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sales.css">
    <link rel="stylesheet" type="text/css" href="css/about-us.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
</head>
<body>
    <header>
        <a class="logo" href="index.html">Tea Shop</a>
        <nav class="navigation">
            <a href="index.html">Home</a>
            <a href="sales.php">Sales</a>
            <a href="green-tea.php">Green Tea</a>
            <a href="black-tea.php">Black Tea</a>
            <a href="about-us.html">About Us</a>
        </nav>
    </header>




<?php
// Pobierz zawartość koszyka z bazy danych (dostosuj dane dostępu)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea-website";

$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sprawdź, czy przesłano formularz usuwania
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_id"])) {
    $removeId = $_POST["remove_id"];

    // Usuń pozycję z koszyka w bazie danych
    $deleteSql = "DELETE FROM koszyk WHERE id = $removeId";
    $conn->query($deleteSql);
}

// Pobierz produkty z koszyka
$sql = "SELECT koszyk.id, koszyk.product_id, koszyk.quantity, towary.nazwa_towaru, towary.cena, towary.file_path_to_img
        FROM koszyk
        JOIN towary ON koszyk.product_id = towary.id";

$result = $conn->query($sql);

// Wyświetl produkty w koszyku
if ($result->num_rows > 0) {
    echo '<h2 class="be_good">Your Shopping Cart</h2>';
    echo '<form method="post" action="koszyk.php">';
    echo '<table class="table-wrapper">';
    echo '<tr>';
    echo '<th>Product</th>';
    echo '<th>Quantity</th>';
    echo '<th>Price</th>';
    echo '<th>Total</th>';
    echo '<th>Remove</th>';
    echo '</tr>';
    $totalAmount = 0;

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>';
        echo '<img src="' . $row["file_path_to_img"] . '" alt="' . $row["nazwa_towaru"] . '" height="50px" width="50px">';
        echo '<p>' . $row["nazwa_towaru"] . '</p>';
        echo '</td>';
        echo '<td>' . $row["quantity"] . '</td>';
        echo '<td>USD ' . number_format($row["cena"], 2) . '</td>';
        $totalProductAmount = $row["cena"] * $row["quantity"];
        $totalAmount += $totalProductAmount;
        echo '<td>USD ' . number_format($totalProductAmount, 2) . '</td>';
        echo '<td>';
        echo '<button type="submit" name="remove_id" id="remove-btn" value="' . $row["id"] . '">X</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '<tr>';
    echo '<td colspan="4" style="text-align: right;"><strong>Total:</strong></td>';
    echo '<td><strong>USD ' . number_format($totalAmount, 2) . '</strong></td>';
    echo '</tr>';

    echo '</table>';
    echo '<div class="actions">';
    echo '<button type="submit"  class="buy-btn" name="buy"><a href="buy_confirm.php">Buy</a></button>';
    echo '<br>';
    echo '<br>';
    echo '<a href="sales.php" class="back-link">Go back to buy more!</a>';
    echo '</div>';
    echo '</form>';
} else {
    echo '<p class="be_good">Your shopping cart is empty.</p>';
}

// Zamknij połączenie z bazą danych
$conn->close();
?>
<footer>
    <div class="upper-footer">
        <div class="tab">
            <h4>SERVICE & INFO</h4>
            <a href="#">About</a>
            <a href="contact_form.php">Contact Us</a>
            <a href="#">Shipping Info</a>
            <a href="#">Tea Wholesale</a>
            <a href="#">Chinese Tea Guide</a>
            <a href="#">Free Tea Samples</a>
            <a href="#">Payment Methods & FAQ</a>
            <a href="https://www.youtube.com/watch?v=PapnBKnPA8s&t=1">Secret math link</a>
        </div>
        <div class="tab">
            <h4>CONTACT US</h4>
            <p>info@gmail.com</p>
            <br>
            <h4>PAYMENT METHODS</h4>
            <p>PayPal, Visa, Mastercard, American Express, Google Pay, Apple Pay, iDeal, Bancontact, Sofort, Giropay, EPS, Przelewy24, SEPA, Cartes Bancaires, Alipay, Wechat Pay, UnionPay.</p>
        </div>
    </div>
</footer>
<script src="js/navigation-additional.js"></script>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery-migrate-1-2-1.min.js"></script>
<script src="owlcarousel/owl.carousel.min.js"></script>
<script src="js/carousel.js"></script>
</body>
</html>