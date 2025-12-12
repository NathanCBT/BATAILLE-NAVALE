<?php
session_start();
include('sql-connect.php');

$sql = new SqlConnect();

$cell = $_POST["cell"];
$player = ($_SESSION["role"] === "joueur1") ? "joueur2" : "joueur1";

$req = $sql->db->prepare("SELECT boat, checked FROM $player WHERE idgrid = :id");
$req->execute([":id" => $cell]);
$cellData = $req->fetch(PDO::FETCH_ASSOC);

if (!$cellData) exit;

if ($cellData["checked"] == 1) {
    header("Location: ../index.php");
    exit;
}

$update = $sql->db->prepare("UPDATE $player SET checked = 1 WHERE idgrid = :id");
$update->execute([":id" => $cell]);

$boatId = (int)$cellData["boat"];

$_SESSION["message"] = ""; 

if ($boatId > 0) {

    
    $checkBoat = $sql->db->prepare("
        SELECT COUNT(*) FROM $player 
        WHERE boat = :b AND checked = 0
    ");
    $checkBoat->execute([":b" => $boatId]);
    $remaining = $checkBoat->fetchColumn();

    if ($boatId == 2) {
        $boatId = 'torpilleur';
    }
    else if ($boatId == 3) {
        $boatId = 'sous-marrin';
    }
    else if ($boatId == 6) {
        $boatId = 'sous-marrin';
    }
    else if ($boatId == 4) {
        $boatId = 'croiseur';
    }
    else if ($boatId == 5) {
        $boatId = 'porte-avion';
    }

    if ($remaining == 0) {
        $_SESSION["message"] = "$boatId détruit !";
    } else {
        $_SESSION["message"] = "Touché !";
    }

} else {
    $_SESSION["message"] = "Raté !";
}

header("Location: ../index.php");
