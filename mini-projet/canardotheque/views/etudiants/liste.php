<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Canardothèque — Liste des étudiants</title>
    <style>
        body { font-family: sans-serif; max-width: 900px; margin: 2rem auto; }
        nav a { margin-right: 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: .5rem 1rem; text-align: left; }
        th { background: #f0f0f0; }
        .btn { padding: .3rem .7rem; text-decoration: none; background: #4a90d9; color: #fff; border-radius: 3px; }
    </style>
</head>
<body>

<nav>
    <a href="index.php?page=canards">Canards</a>
    <a href="index.php?page=etudiants">Étudiants</a>
</nav>

<h1>Liste des étudiants</h1>
<a class="btn" href="index.php?page=etudiants&action=ajouter">+ Inscrire un étudiant</a>

<table>
    <thead>
        <tr>
            <th>N° carte</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?= htmlspecialchars($etudiant['num_carte']) ?></td>
            <td><?= htmlspecialchars($etudiant['nom']) ?></td>
            <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
            <td><?= htmlspecialchars($etudiant['email']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
