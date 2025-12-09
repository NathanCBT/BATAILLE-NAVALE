<?php
$tableau = [];


for ($i = 0; $i < 11; $i++) {
    for ($j = 0; $j < 11; $j++) {
        if ($i == 0 && $j == 0) {
            $tableau[$i][$j] = ""; 
        } elseif ($i == 0) {
           
            $tableau[$i][$j] = chr(ord('A') + $j - 1);
        } elseif ($j == 0) {
            
            $tableau[$i][$j] = $i;
        } else {
        
            $tableau[$i][$j] = "";
        }
    }
}


echo "<table border='1' cellpadding='5' cellspacing='0'>";
for ($i = 0; $i < 11; $i++) {
    echo "<tr>";
    for ($j = 0; $j < 11; $j++) {
        echo "<td>" . $tableau[$j][$i] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";


$batiments = [
    ["id" => 4, "nom" => "Porte-avion", "taille" => 5],
    ["id" => 3, "nom" => "Croiseur", "taille" => 4],
    ["id" => 2, "nom" => "Sous-marin", "taille" => 3],
    ["id" => 2, "nom" => "Sous-marin", "taille" => 3],
    ["id" => 1, "nom" => "Torpilleur", "taille" => 2]
];




if (isset($_POST["reset_total"])) {
  $etat = ["j1" => null, "j2" => null];
  save_state($GLOBALS['fichier'], $etat);

  session_unset();
  session_destroy();

  session_start();

  header("Location: game.php");
  exit;
}



header('refresh:5');
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>Game Start</title>

    <form method="post">
      <button type="submit" name="reset_total">
          ❌ Fin de partie (RESET)
      </button>
    </form>
  </body>
</html>
