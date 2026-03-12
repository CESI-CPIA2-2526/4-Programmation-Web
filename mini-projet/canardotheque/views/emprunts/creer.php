<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Canardothèque — Adopter un canard</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 2rem auto; }
        nav a { margin-right: 1rem; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        input, select { width: 100%; padding: .4rem; margin-top: .3rem; box-sizing: border-box; }
        button { margin-top: 1.5rem; padding: .5rem 1.2rem; }
        .erreur { color: red; }
        .canard-info { background: #f9f9f9; border: 1px solid #ddd; padding: .8rem; margin: 1rem 0; border-radius: 3px; }
    </style>
</head>
<body>

<nav>
    <a href="index.php?page=canards">Canards</a>
    <a href="index.php?page=etudiants">Étudiants</a>
</nav>

<h1>Adopter un canard</h1>

<?php
// On rappelle à l'utilisateur quel canard il est en train d'emprunter.
// $canard est transmis par le contrôleur après vérification que le canard existe
// et qu'il est bien disponible.
?>
<div class="canard-info">
    <strong><?= htmlspecialchars($canard['nom']) ?></strong>
    — <?= htmlspecialchars($canard['type']) ?>
</div>

<?php if ($erreur): ?>
    <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<form method="post">
    <?php
    // Champ caché : transmet l'identifiant du canard lors de la soumission POST,
    // sans que l'utilisateur ait besoin de le voir ou de le saisir.
    // On caste en (int) pour s'assurer qu'aucun contenu HTML ne peut s'y glisser.
    ?>
    <input type="hidden" name="canard_id" value="<?= (int)$canard['id'] ?>">

    <label for="etudiant_id">Étudiant</label>
    <?php
    // La liste des étudiants est construite dynamiquement depuis la base.
    // La valeur de chaque <option> est le num_carte, qui sera envoyé en POST.
    ?>
    <select id="etudiant_id" name="etudiant_id" required>
        <option value="">-- Choisir un étudiant --</option>
        <?php foreach ($etudiants as $etudiant): ?>
            <option value="<?= htmlspecialchars($etudiant['num_carte']) ?>">
                <?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?>
                (<?= htmlspecialchars($etudiant['num_carte']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label for="date_retour_prevue">Date de retour prévue</label>
    <?php
    // L'attribut "min" empêche de choisir une date passée dans le calendrier.
    // La date de prêt (aujourd'hui) est générée côté serveur dans le contrôleur,
    // pas saisie ici : l'utilisateur ne peut pas la falsifier.
    ?>
    <input type="date" id="date_retour_prevue" name="date_retour_prevue"
           min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>

    <button type="submit">Confirmer l'adoption</button>
</form>

</body>
</html>
