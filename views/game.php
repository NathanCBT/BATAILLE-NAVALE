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
    <style>
    body {
        background: #0a0f24;
        color: #e2e8f0;
        font-family: "Segoe UI", sans-serif;
    }

    h2 {
        color: #60a5fa;
        margin-bottom: 20px;
        text-shadow: 0 0 6px rgba(96,165,250,0.4);
    }

    /* Grille */
    .cell {
        width: 36px;
        height: 36px;
        border: 1px solid #1e293b;
        border-radius: 4px;
        transition: 0.15s ease-in-out;
        box-shadow: inset 0 0 4px #0008;
    }

    /* Survol */
    .cell:hover {
        transform: scale(1.1);
        filter: brightness(1.2);
        cursor: pointer;
    }

    /* Couleurs */
    .c-default { background: #64748b; }   /* gris */
    .c-touch   { background: #dc2626 !important; } /* rouge */
    .c-miss    { background: #3b82f6 !important; } /* bleu */

    /* Conteneur grille */
    .grid-wrapper {
        background: #1e293b;
        padding: 20px;
        border-radius: 12px;
        display: inline-block;
        box-shadow: 0 0 15px #0006;
    }

    /* Bouton reset */
    .btn-reset {
        background: #ef4444;
        border: none;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 8px;
        transition: 0.2s;
        margin-top: 25px;
    }
    .btn-reset:hover {
        filter: brightness(1.2);
        transform: scale(1.05);
    }
</style>

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
                    if ($win == 17) {
                        echo 'Vous avez gagner';
                        
                    }
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
    ?>

    <form method="post" action="./scripts/reset_total.php" class="mt-3">
        <button type="submit" name="reset_total" class="btn btn-danger">
            ❌ Fin de partie (RESET)
        </button>
    </form>

</div>

</body>
</html>
