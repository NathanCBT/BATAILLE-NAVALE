<?php
  include('./scripts/save_state.php');

  if (isset($_POST["joueur1"])) {
    if ($etat["j1"] === null) {
      $etat["j1"] = session_id();
      $_SESSION["role"] = "joueur1";
      save_state("./etat_joueurs.json", $etat);
    }
  }

  if (isset($_POST["joueur2"])) {
    if ($etat["j2"] === null) {
      $etat["j2"] = session_id();
      $_SESSION["role"] = "joueur2";
      save_state("./etat_joueurs.json", $etat);
    }
  }

  $role = $_SESSION["role"] ?? "Aucun rôle";
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>Sélection des joueurs</title>
      <link rel="stylesheet" type="text/css" href="/views/players.css" />
  </head>
  <body>
    <div class="container text-center">
      <h1>Connexion aux rôles</h1>
      <h2>Votre rôle actuel : <strong><?= $role ?></strong></h2>
      
      <div class="status-container">
        <div class="status-item">
          <span class="status-label">Joueur 1 :</span>
          <span class="status-indicator <?= $etat["j1"] ? "occupied" : "free" ?>">
            <?= $etat["j1"] ? "🟢 Occupé" : "🔴 Libre" ?>
          </span>
        </div>
        <div class="status-item">
          <span class="status-label">Joueur 2 :</span>
          <span class="status-indicator <?= $etat["j2"] ? "occupied" : "free" ?>">
            <?= $etat["j2"] ? "🟢 Occupé" : "🔴 Libre" ?>
          </span>
        </div>
      </div>

      <form method="post" class="player-form">
        <button type="submit" name="joueur1" class="player-btn"
            <?= $etat["j1"] !== null ? "disabled" : "" ?>>
            🎮 Devenir Joueur 1
        </button>
        <button type="submit" name="joueur2" class="player-btn"
            <?= $etat["j2"] !== null ? "disabled" : "" ?>>
            🎮 Devenir Joueur 2
        </button>
      </form>
    </div>
  </body>
</html>