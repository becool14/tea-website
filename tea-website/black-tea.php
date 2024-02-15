<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="media/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Shop</title>
    <link rel="stylesheet" type="text/css" href="css/sales.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
<img src="media/shopping.png" height="75px" width="75px" style="float: right; margin-right: 25px;" id="productImage" onclick="redirectToCartPage()">
<div class="wrapper">
    <div class="sales-header">
        <h2>
            Black Tea Collection
        </h2>
        <p>
            Explore our rich black tea selection, carefully curated for you.
        </p>
    </div>
    <div class="products-row">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tea-website";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM towary WHERE typ_towaru = 'black_tea'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<img src="' . $row["file_path_to_img"] . '" alt="">';
                echo '<p class="product-name">' . $row["nazwa_towaru"] . '</p>';
                echo '<p class="product-price">USD ' . number_format($row["cena"], 2) . '</p>';
                // Dodaj wywołanie funkcji addToCart z danymi produktu
                echo '<button onclick="addToCart(' . $row["id"] . ', \'' . $row["nazwa_towaru"] . '\', ' . $row["cena"] . ', \'' . $row["file_path_to_img"] . '\')" class="button">';
                echo '<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">';
                echo '<path d="m5.50835165 12.5914912c-.00106615-.0057657-.00203337-.011566-.00289985-.0173991l-1.22011509-7.32069058c-.12054699-.72328196-.74633216-1.25340152-1.47959089-1.25340152h-.30574582c-.27614237 0-.5-.22385763-.5-.5s.22385763-.5.5-.5h.30574582c1.1918179 0 2.21327948.84029234 2.44951006 2h16.24474412c.3321894 0 .5720214.31795246.480762.63736056l-2 7.00000004c-.0613288.2146507-.2575218.3626394-.480762.3626394h-12.90976979l.12443308.7465985c.12054699.7232819.74633216 1.2534015 1.47959089 1.2534015h11.30574582c.2761424 0 .5.2238576.5.5s-.2238576.5-.5.5h-11.30574582c-1.22209789 0-2.26507316-.8835326-2.46598481-2.0890025l-.21991747-1.3195048zm-.08478811-6.5914912 1 6h12.69928576l1.7142857-6zm2.57643646 15c-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2 2 .8954305 2 2-.8954305 2-2 2zm0-1c.55228475 0 1-.4477153 1-1s-.44771525-1-1-1-1 .4477153-1 1 .44771525 1 1 1z"/></svg>';
                echo '</button>';
                echo '</div>';
            }
        } else {
            echo '<p>No products available.</p>';
        }

        $conn->close();
        ?>
    </div>
</div>

<script>
    function addToCart(productId, productName, productPrice, productImage) {
    // Wyślij zapytanie AJAX do serwera, aby dodać produkt do tabeli koszyka w bazie danych
    addToCartInDatabase(productId);

    // Aktualizuj wygląd koszyka (możesz dostosować tę funkcję zgodnie z potrzebami)
    updateCartView();
}

function addToCartInDatabase(productId) {
    // Wyślij zapytanie AJAX do serwera, aby dodać produkt do tabeli koszyka w bazie danych
    // Użyj odpowiedniej technologii, takiej jak XMLHttpRequest lub fetch
    // Poniżej znajduje się przykład z użyciem fetch (wymaga dostosowania do Twojego backendu):

    fetch('php/add-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            productId: productId,
            // Dodaj inne potrzebne dane do przesłania na serwer
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Product added to cart in database:', data);
        // Dodaj odpowiednie działania w przypadku sukcesu lub błędu
    })
    .catch(error => {
        console.error('Error adding product to cart in database:', error);
    });
}

// Funkcja do aktualizacji wyglądu koszyka
function updateCartView() {
  // Tutaj możesz umieścić logikę aktualizacji wyglądu koszyka
  // Na razie wypisujemy informację w konsoli.
  document.getElementById('productImage').src = 'media/shopping_active.png';
}

function redirectToCartPage() {
    // Tutaj możesz również dodać logikę zapisywania wybranych produktów do koszyka przed przekierowaniem
    // Możesz użyć lokalnego magazynu, cookie lub innych mechanizmów przechowywania danych.

    // Przekieruj użytkownika do strony koszyka
    window.location.href = 'koszyk.php';
}
</script>

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
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="js/navigation-additional.js"></script>
</body>
</html>
