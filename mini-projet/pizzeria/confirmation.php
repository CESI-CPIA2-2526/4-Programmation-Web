<?php
require 'pizzas.php';
require 'header.php';

// On récupère les données du formulaire envoyé en POST.
// trim() supprime les espaces en début/fin pour éviter qu'un champ contenant
// uniquement des espaces soit considéré comme rempli.
$nom      = trim($_POST['nom']      ?? '');
$adresse  = trim($_POST['adresse']  ?? '');
$nomPizza = trim($_POST['pizza']    ?? '');
$quantite = (int) ($_POST['quantite'] ?? 0);

$erreurs = [];

if ($nom === '') {
    $erreurs[] = 'Le nom est obligatoire.';
}
if ($adresse === '') {
    $erreurs[] = "L'adresse de livraison est obligatoire.";
}
if ($nomPizza === '') {
    $erreurs[] = 'Veuillez choisir une pizza.';
}
if ($quantite < 1 || $quantite > 10) {
    $erreurs[] = 'La quantité doit être comprise entre 1 et 10.';
}

// On recherche la pizza dans le tableau pour récupérer son prix.
// array_filter renvoie un nouveau tableau avec uniquement les éléments
// qui correspondent à la condition ; on prend le premier résultat avec reset().
$pizzaTrouvee = null;
if ($nomPizza !== '') {
    $resultats    = array_filter($pizzas, fn($p) => $p['nom'] === $nomPizza);
    $pizzaTrouvee = reset($resultats); // false si rien trouvé
    if (!$pizzaTrouvee) {
        $erreurs[] = 'Pizza inconnue.';
    }
}
?>

<section class="confirmation">

<?php if (!empty($erreurs)) : ?>

    <div class="erreurs">
        <h2>Commande invalide</h2>
        <ul>
            <?php foreach ($erreurs as $e) : ?>
                <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="commande.php" class="btn-retour">← Retourner au formulaire</a>
    </div>

<?php else : ?>

    <?php $total = $pizzaTrouvee['prix'] * $quantite; ?>

    <div class="recapitulatif">
        <h2>Commande confirmée !</h2>
        <p>Merci <strong><?php echo htmlspecialchars($nom); ?></strong>, votre commande a bien été enregistrée.</p>

        <table class="table-recap">
            <tr>
                <th>Pizza</th>
                <td><?php echo htmlspecialchars($pizzaTrouvee['nom']); ?></td>
            </tr>
            <tr>
                <th>Ingrédients</th>
                <td><?php echo htmlspecialchars($pizzaTrouvee['ingredients']); ?></td>
            </tr>
            <tr>
                <th>Quantité</th>
                <td><?php echo $quantite; ?></td>
            </tr>
            <tr>
                <th>Prix unitaire</th>
                <td><?php echo number_format($pizzaTrouvee['prix'], 2, ',', ' '); ?> €</td>
            </tr>
            <tr class="total">
                <th>Total</th>
                <td><?php echo number_format($total, 2, ',', ' '); ?> €</td>
            </tr>
            <tr>
                <th>Livraison à</th>
                <td><?php echo htmlspecialchars($adresse); ?></td>
            </tr>
        </table>

        <p class="delai">Votre commande sera livrée dans environ <strong>30 à 45 minutes</strong>. Buon appetito !</p>
        <a href="index.php" class="btn-retour">← Retour à l'accueil</a>
    </div>

<?php endif; ?>

</section>

<?php require 'footer.php'; ?>
