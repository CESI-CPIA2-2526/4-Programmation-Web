<?php

// Ce fichier centralise les données des pizzas.
// On l'inclut avec require dans les pages qui en ont besoin,
// ce qui évite de dupliquer le tableau partout.

$pizzas = [
    [
        'nom'         => 'Margherita',
        'ingredients' => 'Tomate, mozzarella, basilic frais',
        'prix'        => 9.50,
    ],
    [
        'nom'         => 'Reine',
        'ingredients' => 'Tomate, mozzarella, jambon, champignons',
        'prix'        => 11.00,
    ],
    [
        'nom'         => 'Quatre Fromages',
        'ingredients' => 'Mozzarella, gorgonzola, chèvre, parmesan',
        'prix'        => 12.50,
    ],
    [
        'nom'         => 'Diavola',
        'ingredients' => 'Tomate, mozzarella, saucisson piquant, piment',
        'prix'        => 12.00,
    ],
    [
        'nom'         => 'Végétarienne',
        'ingredients' => 'Tomate, mozzarella, poivrons, courgettes, aubergines, olives',
        'prix'        => 11.50,
    ],
    [
        'nom'         => 'Napolitaine',
        'ingredients' => 'Tomate, mozzarella, anchois, câpres, olives noires',
        'prix'        => 12.00,
    ],
    [
        'nom'         => 'Calzone',
        'ingredients' => 'Tomate, mozzarella, jambon, ricotta (pizza fermée)',
        'prix'        => 13.00,
    ],
];
