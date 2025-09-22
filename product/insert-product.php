<?php
require "../includes/product-class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = new Product();

    $omschrijving = htmlspecialchars($_POST['omschrijving']);
    $prijsPerStuk = (float) $_POST['prijsPerStuk'];

    // 📂 Upload foto
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $fotoNaam = basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $fotoNaam;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $fotoPath = "uploads/" . $fotoNaam; 
    } else {
        die("Fout bij uploaden van de foto");
    }

    if ($product->insertProduct($omschrijving, $fotoPath, $prijsPerStuk)) {
        echo "✅ Product succesvol toegevoegd!";
        header("refresh:2; url=http://localhost/PDO-Expert/product/insert-product.php");
        exit;
    } else {
        echo "❌ Er is iets misgegaan bij het toevoegen.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuw product</title>
</head>
<body>
    <h2>Nieuw product toevoegen</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="omschrijving" placeholder="Omschrijving" required><br>
        <input type="number" name="prijsPerStuk" placeholder="Prijs per stuk" required><br>
        <input type="file" name="foto" accept="image/*" required><br>
        <input type="submit" value="Opslaan">
    </form>
</body>
</html>