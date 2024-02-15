<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobierz dane z formularza
    $clientName = $_POST["client_name"];
    $clientLname = $_POST["client_lname"];
    $clientEmail = $_POST["client_email"];

    // Połącz z bazą danych (dostosuj dane dostępu)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tea-website";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Sprawdź połączenie
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Wstaw dane do tabeli w bazie danych
    $sql = "INSERT INTO kontakt (imie, nazwisko, email) VALUES ('$clientName', '$clientLname', '$clientEmail')";

    if ($conn->query($sql) === TRUE) {
        // Pobierz dane z tabeli koszyk
        $cartData = [];
        $cartQuery = "SELECT * FROM koszyk";
        $cartResult = $conn->query($cartQuery);

        if ($cartResult->num_rows > 0) {
            while ($cartRow = $cartResult->fetch_assoc()) {
                $cartData[] = $cartRow;
            }
        }

        
        $telegramBotToken = '';  
        $telegramChatId = ''; 
        
        $message = "Nowe zamówienie:\nImię: $clientName\nNazwisko: $clientLname\nEmail: $clientEmail\n\nDane koszyka:\n";
        
        $totalAmount = 0; // Inicjalizuj zmienną do przechowywania ogólnej sumy
        
        foreach ($cartData as $item) {
            $productId = $item['product_id'];
        
            // Pobierz informacje o produkcie z tabeli 'towary'
            $productQuery = "SELECT * FROM towary WHERE id = $productId";
            $productResult = $conn->query($productQuery);
        
            if ($productResult->num_rows > 0) {
                $productInfo = $productResult->fetch_assoc();
        
                $name = $productInfo['nazwa_towaru'];
                $quantity = 1; // Zakładamy, że ilość zawsze równa 1
                $price = $productInfo['cena'];
                $totalProductAmount = $price * $quantity;
                $totalAmount += $totalProductAmount; // Dodaj do ogólnej sumy
        
                $message .= "Name of product: $name, Ilość: $quantity, Cena: $price, Łączna kwota: $totalProductAmount\n";
            }
        }
        
        // Dodaj ogólną sumę na koniec wiadomości
        $message .= "\nOgólna suma: $totalAmount";
        
        $telegramApiUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$telegramChatId&text=" . urlencode($message);
        


        // Wyślij żądanie do API Telegram za pomocą curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        // Usuń wszystkie rekordy z tabeli koszyk
        $deleteCartQuery = "DELETE FROM koszyk";
        $conn->query($deleteCartQuery);
        
        // Przekieruj użytkownika
        header("Location: ../index.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Zamknij połączenie z bazą danych
    $conn->close();
}
?>
