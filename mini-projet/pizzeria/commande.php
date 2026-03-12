<?php
require 'pizzas.php';
require 'header.php';
?>

<section class="commande">
    <h2>Passer une commande</h2>

    <form action="confirmation.php" method="POST">

        <div class="champ">
            <label for="nom">Votre nom *</label>
            <input type="text" id="nom" name="nom" required placeholder="Ex : Marie Dupont">
        </div>

        <div class="champ">
            <label for="adresse">Adresse de livraison *</label>
            <input type="text" id="adresse" name="adresse" required placeholder="Ex : 5 rue de la Paix, 75001 Paris">
        </div>

        <div class="champ">
            <label for="pizza">Pizza choisie *</label>
            <select id="pizza" name="pizza" required>
                <option value="">-- Choisissez une pizza --</option>
                <?php foreach ($pizzas as $pizza) : ?>
                    <option value="<?php echo htmlspecialchars($pizza['nom']); ?>">
                        <?php echo htmlspecialchars($pizza['nom']); ?> — <?php echo number_format($pizza['prix'], 2, ',', ' '); ?> €
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="champ">
            <label for="quantite">Quantité *</label>
            <input type="number" id="quantite" name="quantite" min="1" max="10" value="1" required>
        </div>

        <button type="submit" class="btn-commander">Commander</button>

    </form>
</section>

<?php require 'footer.php'; ?>
