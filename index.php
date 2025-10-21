<?php
    require 'config.php';
    require 'bdd.php';
    require 'header.php';

    $connexion = connexion();
    $requete = $connexion->query('SELECT id, titre, artiste, image FROM oeuvres');
    $oeuvres = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
