<?php

include 'db.php';

// Artikel bijwerken
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $beschrijving = $_POST['beschrijving'];

    $sql = "UPDATE artikelen SET naam=?, prijs=?, beschrijving=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $naam, $prijs, $beschrijving, $id);
    if($stmt->execute()){
        echo "Artikel bijgewerkt!";
    } else {
        echo "Fout bij het bijwerken van het artikel: " . $conn->error;
    }
}

// Haal artikelgegevens op voor bijwerken
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM artikelen WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $artikel = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel bijwerken</title>
</head>
<body>
    <h1>Artikel bijwerken</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $artikel['id']; ?>">
        <label>Naam: <input type="text" name="naam" value="<?php echo $artikel['naam']; ?>"></label><br>
        <label>Prijs: <input type="text" name="prijs" value="<?php echo $artikel['prijs']; ?>"></label><br>
        <label>Beschrijving: <textarea name="beschrijving"><?php echo $artikel['beschrijving']; ?></textarea></label><br>
        <input type="submit" name="update" value="Bijwerken">
    </form>
</body>
</html>