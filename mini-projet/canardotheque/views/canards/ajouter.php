<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Canardothèque — Ajouter un canard</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 2rem auto; }
        nav a { margin-right: 1rem; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        input, select { width: 100%; padding: .4rem; margin-top: .3rem; box-sizing: border-box; }
        button { margin-top: 1.5rem; padding: .5rem 1.2rem; }
        .erreur { color: red; }
    </style>
</head>
<body>

<nav>
    <a href="index.php?page=canards">Canards</a>
    <a href="index.php?page=etudiants">Étudiants</a>
</nav>

<h1>Ajouter un canard</h1>

<?php
// $erreur est transmise par le contrôleur. Elle vaut '' si tout va bien,
// ou un message si la validation a échoué.
?>
<?php if ($erreur): ?>
    <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<?php
// Sans action="...", le formulaire soumet vers la même URL que la page actuelle.
// Le contrôleur détecte la soumission via $_SERVER['REQUEST_METHOD'] === 'POST'.
?>
<form method="post">
    <label for="nom">Petit nom</label>
    <?php
    // On re-remplit le champ avec la valeur soumise si le formulaire est en erreur.
    // Sans ça, l'utilisateur perdrait sa saisie à chaque tentative ratée.
    // htmlspecialchars est obligatoire ici aussi : $_POST vient du client.
    ?>
    <input type="text" id="nom" name="nom" required value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">

    <label for="type">Type</label>
    <?php
    // Le <select> limite les valeurs côté interface, mais seul le serveur
    // (et la contrainte ENUM en base) garantit vraiment les valeurs acceptées.
    ?>
    <select id="type" name="type" required>
        <option value="">-- Choisir --</option>
        <option value="Plastique">Plastique</option>
        <option value="Peluche">Peluche</option>
        <option value="Bouée">Bouée</option>
    </select>

    <label for="etat">État initial</label>
    <?php
    // "En vadrouille" n'est pas proposé : un canard ne peut pas être créé déjà emprunté.
    ?>
    <select id="etat" name="etat">
        <option value="Dans la mare">Dans la mare</option>
        <option value="En nettoyage">En nettoyage</option>
    </select>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>
