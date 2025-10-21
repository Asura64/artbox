<?php

require 'config.php';
require 'bdd.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die;
}

$validationChamps = [
    'titre' => static fn(string $titre): bool => $titre !== '',
    'artiste' => static fn(string $artiste): bool => $artiste !== '',
    'description' => static fn(string $description): bool => strlen($description) >= 3,
    'image' => static fn(string $image): bool => filter_var($image, FILTER_VALIDATE_URL) !== false,
];

$validiteFormulaire = true;
$valeurs = [];
foreach ($validationChamps as $champ => $validation) {
    $valeur = $_POST[$champ] ?? '';
    $valeurs[$champ] = htmlspecialchars($valeur);
    if (!$validation($valeur)) {
        $validiteFormulaire = false;
    }
}

if (!$validiteFormulaire) {
    header('Location: ajouter.php');
    die;
}

$connexion = connexion();
$requete = $connexion->prepare('INSERT INTO oeuvres (titre, artiste, description, image) VALUES (:titre, :artiste, :description, :image)');
$requete->execute($valeurs);
$id = (int) $connexion->lastInsertId();
header('Location: oeuvre.php?id=' . $id);
