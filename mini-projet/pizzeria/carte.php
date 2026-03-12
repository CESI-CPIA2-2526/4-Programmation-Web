<?php
require 'pizzas.php';
require 'header.php';
?>

<section class="carte">
    <h2>Notre Carte</h2>
    <p class="intro-carte">Toutes nos pizzas sont disponibles en taille unique (33 cm), cuites au feu de bois.</p>

    <div class="grille-pizzas">
        <?php foreach ($pizzas as $pizza) : ?>
            <div class="card-pizza">
                <h3><?php echo htmlspecialchars($pizza['nom']); ?></h3>
                <p class="ingredients"><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
                <p class="prix"><?php echo number_format($pizza['prix'], 2, ',', ' '); ?> €</p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require 'footer.php'; ?>
