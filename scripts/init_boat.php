<?php
include('./sql-connect.php');

$sql = new SqlConnect();

$boat["joueur1"] = [
    [3,0,0,0,0,0,0,2,2,0],
    [3,0,0,0,0,0,0,0,0,0],
    [3,0,0,0,0,0,0,0,0,0],
    [0,0,0,4,0,2,2,0,0,0],
    [0,0,0,4,0,5,0,0,0,0],
    [0,0,0,4,0,5,0,0,0,0],
    [0,0,0,4,0,5,0,0,0,0],
    [3,3,3,0,0,5,0,0,0,0],
    [0,0,0,0,0,5,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0]
];

$boat["joueur2"] = [
    [3,3,3,0,0,0,0,2,2,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0],
    [0,0,0,4,0,2,2,0,0,0],
    [0,0,0,4,0,5,0,0,0,0],
    [0,0,0,4,0,5,0,0,0,0],
    [0,0,0,4,0,5,0,0,0,0],
    [3,3,3,0,0,5,0,0,0,0],
    [0,0,0,0,0,5,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0]
];



$tables = ["joueur1", "joueur2"];

foreach ($tables as $table) {

    // Remise à zéro
    $sql->db->exec("UPDATE $table SET checked = 0, boat = 0");

    for ($row = 0; $row < 10; $row++) {
        for ($col = 0; $col < 10; $col++) {

            $coord = chr(65 + $row) . ($col + 1);

            //Récupération correcte de la valeur dans la grille du joueur
            $value = $boat[$table][$row][$col];

            $req = $sql->db->prepare("
                UPDATE $table 
                SET boat = :b 
                WHERE idgrid = :id
            ");

            $req->execute([
                ":b"  => $value,
                ":id" => $coord
            ]);
        }
    }
}

echo "✔ Bateaux importés avec succès pour joueur1 & joueur2.";
