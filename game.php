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
/*
if (isset($_POST["reset_total"])) {
  $etat = ["j1" => null, "j2" => null];
  save_state($GLOBALS['fichier'], $etat);

  session_unset();
  session_destroy();

  header("Location: game.php");
  exit;
}*/

echo "<table border='1' cellpadding='5' cellspacing='0'>";
for ($i = 0; $i < 11; $i++) {
    echo "<tr>";
    for ($j = 0; $j < 11; $j++) {
        echo "<td>" . $tableau[$j][$i] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
/*
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
*/