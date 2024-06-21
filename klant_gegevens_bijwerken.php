<?php

include 'db.php';

// Klant bijwerken
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];

    $sql = "UPDATE klanten SET naam=?, email=?, adres=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $naam, $email, $adres, $id);
    if($stmt->execute()){
        echo "Klantgegevens bijgewerkt!";
    } else {
        echo "Fout bij het bijwerken van de klantgegevens: " . $conn->error;
    }
}

// Haal klantgegevens op voor bijwerken
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM klanten WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $klant = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Klantgegevens bijwerken</title>
</head>
<body>
    <h1>Klantgegevens bijwerken</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $klant['id']; ?>">
        <label>Naam: <input type="text" name="naam" value="<?php echo $klant['naam']; ?>"></label><br>
        <label>E-mail: <input type="text" name="email" value="<?php echo $klant['email']; ?>"></label><br>
        <label>Adres: <textarea name="adres"><?php echo $klant['adres']; ?></textarea></label><br>
        <input type="submit" name="update" value="Bijwerken">
    </form>
</body>
</html>