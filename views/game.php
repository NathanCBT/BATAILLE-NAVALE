<?php
session_start();
include('./scripts/sql-connect.php');

$sql = new SqlConnect();

// Détermine quelle table on doit afficher (l'adversaire)
$player = ($_SESSION["role"] === 'joueur1') ? 'joueur2' : 'joueur1';

// Récupère la grille complète depuis la base
$query = "
    SELECT * FROM $player
    ORDER BY 
        LEFT(idgrid, 1),        -- A, B, C...
        CAST(SUBSTRING(idgrid, 2) AS UNSIGNED)  -- 1,2,3...10";
$req = $sql->db->prepare($query);
$req->execute();
$rows = $req->fetchAll(PDO::FETCH_ASSOC);

$colsPerRow = 10;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/views/game.css" />

</head>
<body>

<div class="container text-center mt-3">

    <h2>Vous tirez sur : <?= strtoupper($player) ?></h2>

    <?php
    $win = 0;
    // Affichage de la grille 10x10
    for ($i = 0; $i < count($rows); $i += $colsPerRow) {
        echo '<div class="row justify-content-center">';

        for ($j = 0; $j < $colsPerRow; $j++) {
            if (!isset($rows[$i + $j])) continue;

            $case = $rows[$i + $j];
            $idgrid = $case['idgrid'];

            // Couleur par défaut
            $color = "grey";

            // Case tirée
            if ($case['checked'] == 1) {
                if ($case['boat'] > 0) {
                    $color = "red";   // touché
                    $win++;
                } else {
                    $color = "blue";  // raté
                }
            }

            echo '<div class="col-auto p-0">';
            echo '<form method="post" action="./scripts/click_case.php">';
            echo '<button type="submit" class="cell" name="cell" value="'.$idgrid.'" style="background-color:'.$color.'"></button>';
            echo '</form>';
            echo '</div>';
        }

        echo '</div>';
    }
    if ($win == 17) {
        echo 'Vous avez gagner';
                        
    }
    ?>
    
    <form method="post" action="./scripts/reset_total.php" class="mt-3">
        <button type="submit" name="reset_total" class="btn btn-danger">
            ❌ Fin de partie (RESET)
        </button>
    </form>

</div>

</body>
</html>
