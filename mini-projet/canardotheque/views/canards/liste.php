<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Canardothèque — Liste des canards</title>
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

<h1>Liste des canards</h1>
<a class="btn" href="index.php?page=canards&action=ajouter">+ Ajouter un canard</a>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Type</th>
            <th>État</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($canards as $canard): ?>
        <tr>
            <td><?= htmlspecialchars($canard['id']) ?></td>
            <td><?= htmlspecialchars($canard['nom']) ?></td>
            <td><?= htmlspecialchars($canard['type']) ?></td>
            <td><?= htmlspecialchars($canard['etat']) ?></td>
            <td>
                <?php if ($canard['etat'] === 'Dans la mare'): ?>
                    <a class="btn" href="index.php?page=emprunts&canard_id=<?= $canard['id'] ?>">Adopter</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
