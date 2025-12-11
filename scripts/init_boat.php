<?php
include('./sql-connect.php');

$sql = new SqlConnect();

$boat = [
    [3,0,0,0,0,0,0,2,2,1],
    [3,0,0,0,0,0,0,0,0,1],
    [3,0,0,0,0,0,0,0,0,1],
    [0,0,0,4,0,2,2,0,0,1],
    [0,0,0,4,0,5,0,0,0,1],
    [0,0,0,4,0,5,0,0,0,1],
    [0,0,0,4,0,5,0,0,0,1],
    [3,3,3,0,0,5,0,0,0,1],
    [0,0,0,0,0,5,0,0,0,1],
    [0,0,0,0,0,0,0,0,0,1]
];


$tables = ["joueur1", "joueur2"];

foreach ($tables as $table) {

    // Remise à zéro
    $sql->db->exec("UPDATE $table SET checked = 0, boat = 0");

    for ($row = 0; $row < 10; $row++) {
        for ($col = 0; $col < 10; $col++) {
            $coord = chr(65 + $row) . ($col + 1);
            $value = $boat[$row][$col];

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
