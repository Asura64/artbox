<?php
    require 'config.php';
    require 'bdd.php';
    require 'header.php';

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
        die;
    }
    $id = (int) $_GET['id'];

    $connexion = connexion();
    $requete = $connexion->prepare('SELECT titre, artiste, description, image FROM oeuvres WHERE id = :id');
    $requete->execute([':id' => $id]);
    $oeuvre = $requete->fetch(PDO::FETCH_ASSOC);

    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(!$oeuvre) {
        header('Location: index.php');
        die;
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
