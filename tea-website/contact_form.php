<?php
include 'php/contact.php'; // Importuj kod przetwarzania formularza

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="media/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Shop</title>
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
<div class="container">
    <form action="php/contact.php" method="POST" enctype="multipart/form-data">
  
      <label for="fname">First Name</label>
      <input type="text" id="fname" name="firstname" placeholder="Your name.." required>
  
      <label for="lname">Last Name</label>
      <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
        <label for="email">Email</label>
        <input type="email" id="email" name="contact_email" placeholder="Your email.." required>
  
      <label for="subject">Subject</label>
      <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" required></textarea>
      <input type="file" id="file_contact" name="file_contact" placeholder="Your file" > <br> <br>
      <input type="submit" value="Submit">
  
    </form>
  </div>
  <style>
    /* Style inputs with type="text", select elements and textareas */
input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

input[type=email], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
  </style>
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
<?php if ($_SESSION["message"] != NULL): ?>
        <script>
            alert("<?php echo $_SESSION['message']; ?>");
        </script>
        <?php $_SESSION["message"] = NULL; ?>
    <?php endif; ?>
<script src="js/navigation-additional.js"></script>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery-migrate-1-2-1.min.js"></script>
<script src="owlcarousel/owl.carousel.min.js"></script>
<script src="js/carousel.js"></script>
</body>
</html>