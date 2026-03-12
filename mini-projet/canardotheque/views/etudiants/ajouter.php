<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Canardothèque — Inscrire un étudiant</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 2rem auto; }
        nav a { margin-right: 1rem; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        input { width: 100%; padding: .4rem; margin-top: .3rem; box-sizing: border-box; }
        button { margin-top: 1.5rem; padding: .5rem 1.2rem; }
        .erreur { color: red; }
    </style>
</head>
<body>

<nav>
    <a href="index.php?page=canards">Canards</a>
    <a href="index.php?page=etudiants">Étudiants</a>
</nav>

<h1>Inscrire un étudiant</h1>

<?php if ($erreur): ?>
    <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<form method="post">
    <label for="num_carte">N° de carte étudiante</label>
    <?php
    // On restitue la valeur saisie en cas d'erreur (confort utilisateur).
    // L'attribut "required" est une validation navigateur : pratique, mais
    // non suffisante — le contrôleur valide toujours côté serveur.
    ?>
    <input type="text" id="num_carte" name="num_carte" required value="<?= htmlspecialchars($_POST['num_carte'] ?? '') ?>">

    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" required value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" required value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">

    <label for="email">Email universitaire</label>
    <?php
    // type="email" active la validation du format par le navigateur,
    // mais n'empêche pas d'envoyer n'importe quelle valeur via un outil comme curl.
    ?>
    <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

    <button type="submit">Inscrire</button>
</form>

</body>
</html>
