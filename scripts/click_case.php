<?php
session_start();
include('sql-connect.php');

$sql = new SqlConnect();

$cell = $_POST["cell"];
$player = ($_SESSION["role"] === "joueur1") ? "joueur2" : "joueur1";

// On récupère la case cliquée
$req = $sql->db->prepare("SELECT boat, checked FROM $player WHERE idgrid = :id");
$req->execute([":id" => $cell]);
$cellData = $req->fetch(PDO::FETCH_ASSOC);

if (!$cellData) exit;

// Si déjà tiré, on ne fait rien
if ($cellData["checked"] == 1) {
    header("Location: ../index.php");
    exit;
}

// On marque la case comme tirée
$update = $sql->db->prepare("UPDATE $player SET checked = 1 WHERE idgrid = :id");
$update->execute([":id" => $cell]);

$boatId = (int)$cellData["boat"];

$_SESSION["message"] = ""; // Message affiché dans la grille

if ($boatId > 0) {

    // Vérifier si le bateau est détruit
    $checkBoat = $sql->db->prepare("
        SELECT COUNT(*) FROM $player 
        WHERE boat = :b AND checked = 0
    ");
    $checkBoat->execute([":b" => $boatId]);
    $remaining = $checkBoat->fetchColumn();

    if ($remaining == 0) {
        // Bateau détruit
        $_SESSION["message"] = "💥 Bateau $boatId détruit !";
    } else {
        // Simplement touché
        $_SESSION["message"] = "🔥 Touché !";
    }

} else {
    // Raté
    $_SESSION["message"] = "💧 Raté !";
}

header("Location: ../index.php");
