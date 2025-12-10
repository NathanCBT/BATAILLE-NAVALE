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
          
              $tableau[$i][$j] = '<form method="post"><button>O</button></form>';
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

  header('refresh:5');
?>


<!--
<!DOCTYPE html>
<html>
  <head>  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Game</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container text-center">
      <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col border border-primary">
          <form method="post" action="../scripts/click_case.php">
            <button type="submit" name="a1"></button>
          </form>
        </div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
       <div class="row">
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
        <div class="col">0</div>
      </div>
    </div>
-->    
    <form method="post" action="../scripts/reset_total.php">
      <button type="submit" name="reset_total">
        ❌ Fin de partie (RESET)
      </button>
    </form>
  </body>
</html>