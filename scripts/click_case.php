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

$boatId_num = (int)$cellData["boat"];
$_SESSION["message"] = "";

if ($boatId_num > 0) {


    $checkBoat = $sql->db->prepare("
        SELECT COUNT(*) FROM $player 
        WHERE boat = :b AND checked = 0
    ");
    $checkBoat->execute([":b" => $boatId_num]);
    $remaining = $checkBoat->fetchColumn();

    $boatName = match($boatId_num) {
        2 => 'Torpilleur',
        3 => 'Sous-marin',
        6 => 'Sous-marin',
        4 => 'Croiseur',
        5 => 'Porte-avion',
        default => "Bateau",
    };

    if ($remaining == 0) {

        $getCoords = $sql->db->prepare("
            SELECT idgrid FROM $player
            WHERE boat = :b
            ORDER BY idgrid
        ");
        $getCoords->execute([":b" => $boatId_num]);
        $coordsList = $getCoords->fetchAll(PDO::FETCH_COLUMN);

        $coordsText = implode(" - ", $coordsList);

        $_SESSION["message"] = "$boatName détruit ! Coordonnées : $coordsText";

    } else {
        $_SESSION["message"] = "Touché !";
    }

} else {
    $_SESSION["message"] = "Raté !";
}

header("Location: ../index.php");
