<?php
session_start();

// Rafraîchissement automatique
header("Refresh:2");

// Fichier de suivi des joueurs
$fichier = "./etat_joueurs.json";

if (!file_exists($fichier)) {
    // Initialise les joueurs en attente
    file_put_contents($fichier, json_encode(["j1" => null, "j2" => null]));
}

$etat = json_decode(file_get_contents($fichier), true);

// Si les deux joueurs ont choisi un rôle → on lance la game
if (!empty($etat["j1"]) && !empty($etat["j2"])) {
    include('./views/game.php');
} 
else {
    include('./views/players-selected.php');
}
