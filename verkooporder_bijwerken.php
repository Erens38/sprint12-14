<?php

include 'db.php';

// Verkooporder bijwerken
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $klant_id = $_POST['klant_id'];
    $artikel_id = $_POST['artikel_id'];
    $hoeveelheid = $_POST['hoeveelheid'];

    $sql = "UPDATE verkooporders SET klant_id=?, artikel_id=?, hoeveelheid=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $klant_id, $artikel_id, $hoeveelheid, $id);
    if($stmt->execute()){
        echo "Verkooporder bijgewerkt!";
    } else {
        echo "Fout bij het bijwerken van de verkooporder: " . $conn->error;
    }
}

// Haal verkoopordergegevens op voor bijwerken
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM verkooporders WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $verkooporder = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkooporder bijwerken</title>
</head>
<body>
    <h1>Verkooporder bijwerken</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $verkooporder['id']; ?>">
        <label>Klant ID: <input type="text" name="klant_id" value="<?php echo $verkooporder['klant_id']; ?>"></label><br>
        <label>Artikel ID: <input type="text" name="artikel_id" value="<?php echo $verkooporder['artikel_id']; ?>"></label><br>
        <label>Hoeveelheid: <input type="text" name="hoeveelheid" value="<?php echo $verkooporder['hoeveelheid']; ?>"></label><br>
        <input type="submit" name="update" value="Bijwerken">
    </form>
</body>
</html>