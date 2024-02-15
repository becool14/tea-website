<?php
include 'db.php';
session_start();

// Sprawdź, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobierz dane z formularza
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $contact_email = $_POST["contact_email"];
    $subject = $_POST["subject"];

    // Przesłane pliki
    $file_data = null;
    $file_error = null;
    
    if(isset($_FILES["file_contact"])) {
        if ($_FILES["file_contact"]["error"] == 0) {
            $file_data = file_get_contents($_FILES["file_contact"]["tmp_name"]);
        } else {
            $file_error = $_FILES["file_contact"]["error"];
        }
    }

    if ($file_data === null && $file_error !== null && $file_error != UPLOAD_ERR_NO_FILE) {
        // Wyprowadź informacje diagnostyczne w przypadku problemów z przesyłaniem pliku
        switch ($file_error) {
            case UPLOAD_ERR_INI_SIZE:
                $_SESSION["message"] = "Error: Przesłany plik przekracza limit rozmiaru ustawiony w pliku konfiguracyjnym PHP (php.ini).";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $_SESSION["message"] = "Error: Przesłany plik przekracza limit rozmiaru określony w formularzu HTML.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $_SESSION["message"] = "Error: Plik został tylko częściowo przesłany.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $_SESSION["message"] = "Error: Brak folderu tymczasowego.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $_SESSION["message"] = "Error: Błąd zapisu pliku na serwerze.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $_SESSION["message"] = "Error: Rozszerzenie PHP zatrzymało przesyłanie pliku.";
                break;
            default:
                $_SESSION["message"] = "Error: Nieznany błąd podczas przesyłania pliku.";
        }
    } else {
        // Dodaj dane do bazy danych
        if ($file_data === null) {
            $sql = "INSERT INTO ContactForm (firstname, lastname, contact_email, subject)
                    VALUES ('$firstname', '$lastname', '$contact_email', '$subject')";
        } else {
            $sql = "INSERT INTO ContactForm (firstname, lastname, contact_email, subject, file_contact)
                    VALUES ('$firstname', '$lastname', '$contact_email', '$subject', ?)";
        }

        $stmt = $conn->prepare($sql);

        if ($file_data !== null) {
            $stmt->bind_param("b", $file_data); // "b" oznacza, że dane są w formie binarnej
        }

        if ($stmt->execute()) {
            $_SESSION["message"] = "Form submitted successfully!";
        } else {
            $_SESSION["message"] = "Error: Form submission failed. Please try again later.";
            // Log or handle the detailed error information securely
            // $stmt->error contains the specific error related to the prepared statement
            // You can log this information for debugging but avoid exposing it to users
            error_log("SQL Error: " . $stmt->error);
        }

        $stmt->close();
    }

    $conn->close();
    header("Location: ../contact_form.php");
}
?>
