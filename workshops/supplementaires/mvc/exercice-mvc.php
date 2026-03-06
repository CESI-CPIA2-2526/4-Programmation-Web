<?php
// ============================================================
//  EXERCICE MVC — Refactorisation d'un code "spaghetti"
// ============================================================
//
//  CONTEXTE
//  --------
//  Ce fichier unique contient une application fonctionnelle de
//  gestion d'offres d'emploi pour la société Web4all.
//  Tout est mélangé : données, logique métier, traitement des
//  requêtes HTTP et affichage HTML.
//
//  VOTRE MISSION
//  -------------
//  Pour chaque extrait ci-dessous, remplissez les deux lignes :
//
//   Étape 1 — Identifiez la couche MVC :
//             Modèle  /  Vue  /  Contrôleur
//
//   Étape 2 — Identifiez le fichier exact de destination :
//
//  web4all/
//  ├── index.php
//  ├── controllers/
//  │   ├── OffreController.php
//  │   ├── CandidatureController.php
//  │   └── StatsController.php
//  ├── models/
//  │   └── OffreModel.php
//  ├── views/
<<<<<<< HEAD
//  │   ├── liste.php
//  │   ├── detail.php
//  │   ├── candidatures.php
//  │   ├── stats.php
//  │   └── 404.php
//  └── uploads/
//
=======
//  │   ├── liste.php                   ← Affichage de la liste filtrée
//  │   ├── detail.php                  ← Détail d'une offre + formulaire
//  │   ├── candidatures.php            ← Historique des candidatures
//  │   ├── stats.php                   ← Page de statistiques
//  │   └── 404.php                     ← Page d'erreur

>>>>>>> bcdce6c09e42027aa5ca443984d2bfd2bc9b662f
// ============================================================


// ============================================================
//  EXTRAIT C
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================

$nb_total    = count($offres);
$nb_ouvertes = 0;
$salaire_sum = 0;
foreach ($offres as $o) {
    if ($o['ouvert']) {
        $nb_ouvertes++;
        $salaire_sum += $o['salaire'];
    }
}
$salaire_moyen = $nb_ouvertes > 0 ? round($salaire_sum / $nb_ouvertes) : 0;

$par_type = [];
foreach ($offres as $o) {
    $par_type[$o['type']] = ($par_type[$o['type']] ?? 0) + 1;
}

$par_ville = [];
foreach ($offres as $o) {
    $par_ville[$o['ville']] = ($par_ville[$o['ville']] ?? 0) + 1;
}

$salaires = array_column($offres, 'salaire');
$sal_min  = min($salaires);
$sal_max  = max($salaires);


// ============================================================
//  EXTRAIT H
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================
?>

    <h2>Mes candidatures (session en cours)</h2>

    <?php if (empty($historique)): ?>
        <p>Vous n'avez pas encore envoyé de candidature durant cette session.</p>
        <a class="btn" href="?vue=liste">Voir les offres</a>
    <?php else: ?>
        <table>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Offre #</th>
                <th>CV</th>
                <th>Date</th>
            </tr>
            <?php foreach ($historique as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['nom']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= (int) $c['offre_id'] ?></td>
                    <td><?= htmlspecialchars($c['cv'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($c['date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

<?php
// ============================================================
//  EXTRAIT A
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================

$offres = [
    [
        'id'          => 1,
        'titre'       => 'Développeur PHP Backend',
        'entreprise'  => 'WebAgency Paris',
        'ville'       => 'Paris',
        'type'        => 'CDI',
        'salaire'     => 42000,
        'ouvert'      => true,
        'publie_le'   => '2025-03-01',
        'description' => 'Rejoignez notre équipe backend pour développer et maintenir des applications PHP robustes. Vous travaillerez sur des projets clients variés en utilisant des architectures MVC modernes.',
        'competences' => ['PHP', 'MySQL', 'MVC', 'Git'],
    ],
    [
        'id'          => 2,
        'titre'       => 'Intégrateur HTML / CSS',
        'entreprise'  => 'PixelPerfect Studio',
        'ville'       => 'Lyon',
        'type'        => 'CDD',
        'salaire'     => 30000,
        'ouvert'      => true,
        'publie_le'   => '2025-03-05',
        'description' => 'Intégration de maquettes Figma en HTML/CSS responsive. Bonne maîtrise des outils modernes du front-end.',
        'competences' => ['HTML', 'CSS', 'Figma', 'Responsive'],
    ],
    [
        'id'          => 3,
        'titre'       => 'Développeur JavaScript Full-Stack',
        'entreprise'  => 'StartupFactory',
        'ville'       => 'Bordeaux',
        'type'        => 'CDI',
        'salaire'     => 46000,
        'ouvert'      => true,
        'publie_le'   => '2025-02-20',
        'description' => 'Poste polyvalent front/back avec Node.js et React. Vous rejoindrez une équipe agile de 5 développeurs.',
        'competences' => ['JavaScript', 'Node.js', 'React', 'MongoDB'],
    ],
    [
        'id'          => 4,
        'titre'       => 'Administrateur Systèmes Linux',
        'entreprise'  => 'CloudOps SAS',
        'ville'       => 'Toulouse',
        'type'        => 'CDI',
        'salaire'     => 44000,
        'ouvert'      => false,
        'publie_le'   => '2025-01-15',
        'description' => "Gestion et supervision d'une infrastructure Linux en production. Automatisation des déploiements avec Ansible.",
        'competences' => ['Linux', 'Ansible', 'Docker', 'Bash'],
    ],
    [
        'id'          => 5,
        'titre'       => 'Développeuse / Développeur PHP Junior',
        'entreprise'  => 'AgenceDigitale',
        'ville'       => 'Nantes',
        'type'        => 'Alternance',
        'salaire'     => 18000,
        'ouvert'      => true,
        'publie_le'   => '2025-03-10',
        'description' => 'Poste idéal pour un profil junior souhaitant progresser rapidement. Encadrement par un développeur senior.',
        'competences' => ['PHP', 'HTML', 'CSS', 'SQL'],
    ],
    [
        'id'          => 6,
        'titre'       => 'Chef de Projet Web',
        'entreprise'  => 'ConseilNumérique',
        'ville'       => 'Paris',
        'type'        => 'CDI',
        'salaire'     => 52000,
        'ouvert'      => true,
        'publie_le'   => '2025-02-28',
        'description' => 'Pilotage de projets web de A à Z, de la conception à la livraison. Interface entre clients et équipes techniques.',
        'competences' => ['Gestion de projet', 'Agile', 'Scrum', 'Communication'],
    ],
    [
        'id'          => 7,
        'titre'       => 'Designer UX / UI',
        'entreprise'  => 'UXLab',
        'ville'       => 'Strasbourg',
        'type'        => 'CDD',
        'salaire'     => 35000,
        'ouvert'      => true,
        'publie_le'   => '2025-03-08',
        'description' => "Conception d'interfaces utilisateur centrées sur l'expérience. Réalisation de wireframes, prototypes et tests utilisateurs.",
        'competences' => ['Figma', 'UX Research', 'Prototypage', 'Adobe XD'],
    ],
    [
        'id'          => 8,
        'titre'       => 'Développeur Mobile React Native',
        'entreprise'  => 'AppMakers',
        'ville'       => 'Lille',
        'type'        => 'CDI',
        'salaire'     => 48000,
        'ouvert'      => false,
        'publie_le'   => '2025-01-30',
        'description' => "Développement d'applications mobiles cross-platform pour iOS et Android avec React Native.",
        'competences' => ['React Native', 'JavaScript', 'iOS', 'Android'],
    ],
];


// ============================================================
//  EXTRAIT F
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================
?>

    <h2>Statistiques des offres</h2>

    <div class="stats">
        <div class="stat-box">
            <strong><?= number_format($sal_min, 0, ',', ' ') ?> €</strong>
            salaire le plus bas
        </div>
        <div class="stat-box">
            <strong><?= number_format($sal_max, 0, ',', ' ') ?> €</strong>
            salaire le plus haut
        </div>
        <div class="stat-box">
            <strong><?= number_format($salaire_moyen, 0, ',', ' ') ?> €</strong>
            salaire moyen (ouvertes)
        </div>
    </div>

    <div style="display:flex; gap:20px;">
        <div style="flex:1; background:white; padding:20px; border-radius:8px;">
            <h3>Répartition par type de contrat</h3>
            <table>
                <tr><th>Type</th><th>Nombre</th></tr>
                <?php foreach ($par_type as $type => $nb): ?>
                    <tr>
                        <td><?= htmlspecialchars($type) ?></td>
                        <td><?= $nb ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div style="flex:1; background:white; padding:20px; border-radius:8px;">
            <h3>Répartition par ville</h3>
            <table>
                <tr><th>Ville</th><th>Nombre</th></tr>
                <?php foreach ($par_ville as $ville => $nb): ?>
                    <tr>
                        <td><?= htmlspecialchars($ville) ?></td>
                        <td><?= $nb ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

<?php
// ============================================================
//  EXTRAIT I
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================

session_start();

$filtre_type  = $_GET['type']  ?? '';
$filtre_ville = $_GET['ville'] ?? '';
$vue          = $_GET['vue']   ?? 'liste';
$offre_id_url = (int) ($_GET['id'] ?? 0);


// ============================================================
//  EXTRAIT B
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================

$erreurs        = [];
$succes_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'candidater') {

    $nom      = trim($_POST['nom']     ?? '');
    $email    = trim($_POST['email']   ?? '');
    $message  = trim($_POST['message'] ?? '');
    $offre_id = (int) ($_POST['offre_id'] ?? 0);

    if (empty($nom)) {
        $erreurs[] = 'Le champ Nom est obligatoire.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email est invalide ou manquante.";
    }
    if (empty($message) || mb_strlen($message) < 30) {
        $erreurs[] = 'Le message de motivation doit contenir au moins 30 caractères.';
    }

    $cv_nom_final = null;
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['cv']['type'] !== 'application/pdf') {
            $erreurs[] = 'Le CV doit être un fichier PDF.';
        } elseif ($_FILES['cv']['size'] > 2 * 1024 * 1024) {
            $erreurs[] = 'Le CV ne doit pas dépasser 2 Mo.';
        } else {
            $cv_nom_final = strtolower(str_replace(' ', '-', $nom))
                          . '_cv_' . time() . '.pdf';
            move_uploaded_file($_FILES['cv']['tmp_name'], 'uploads/' . $cv_nom_final);
        }
    } else {
        $erreurs[] = 'Veuillez joindre votre CV en PDF.';
    }

    if (empty($erreurs)) {
        if (!isset($_SESSION['candidatures'])) {
            $_SESSION['candidatures'] = [];
        }
        $_SESSION['candidatures'][] = [
            'nom'      => $nom,
            'email'    => $email,
            'offre_id' => $offre_id,
            'cv'       => $cv_nom_final,
            'date'     => date('d/m/Y H:i'),
        ];
        $succes_message = 'Votre candidature a bien été envoyée, ' . htmlspecialchars($nom) . ' !';
    }
}


// ============================================================
//  EXTRAIT G
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================

$offres_filtrees = [];
foreach ($offres as $offre) {
    if ($filtre_type !== '' && $offre['type'] !== $filtre_type) {
        continue;
    }
    if ($filtre_ville !== '' && $offre['ville'] !== $filtre_ville) {
        continue;
    }
    $offres_filtrees[] = $offre;
}

$offre_detail = null;
if ($vue === 'detail' && $offre_id_url > 0) {
    foreach ($offres as $o) {
        if ($o['id'] === $offre_id_url) {
            $offre_detail = $o;
            break;
        }
    }
}

$types_dispo  = array_unique(array_column($offres, 'type'));
$villes_dispo = array_unique(array_column($offres, 'ville'));
sort($types_dispo);
sort($villes_dispo);

$historique = $_SESSION['candidatures'] ?? [];


// ============================================================
//  EXTRAIT D
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================
?>

    <!-- Statistiques rapides -->
    <div class="stats">
        <div class="stat-box">
            <strong><?= $nb_total ?></strong>
            offres au total
        </div>
        <div class="stat-box">
            <strong><?= $nb_ouvertes ?></strong>
            offres ouvertes
        </div>
        <div class="stat-box">
            <strong><?= number_format($salaire_moyen, 0, ',', ' ') ?> €</strong>
            salaire moyen
        </div>
        <div class="stat-box">
            <strong><?= count($historique) ?></strong>
            candidature(s) envoyée(s)
        </div>
    </div>

    <!-- Filtres -->
    <form class="filtres" method="get">
        <input type="hidden" name="vue" value="liste">
        <label for="type">Type :</label>
        <select name="type" id="type">
            <option value="">Tous</option>
            <?php foreach ($types_dispo as $t): ?>
                <option value="<?= htmlspecialchars($t) ?>"
                        <?= $filtre_type === $t ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="ville">Ville :</label>
        <select name="ville" id="ville">
            <option value="">Toutes</option>
            <?php foreach ($villes_dispo as $v): ?>
                <option value="<?= htmlspecialchars($v) ?>"
                        <?= $filtre_ville === $v ? 'selected' : '' ?>>
                    <?= htmlspecialchars($v) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filtrer</button>
        <a href="?vue=liste">Réinitialiser</a>
    </form>

    <p><?= count($offres_filtrees) ?> offre(s) affichée(s)</p>

    <!-- Liste des offres filtrées -->
    <?php foreach ($offres_filtrees as $offre): ?>
        <div class="card">
            <h2><?= htmlspecialchars($offre['titre']) ?></h2>
            <p>
                <strong><?= htmlspecialchars($offre['entreprise']) ?></strong>
                — <?= htmlspecialchars($offre['ville']) ?>
                &nbsp;|&nbsp; Publié le <?= $offre['publie_le'] ?>
            </p>
            <p>
                <span class="badge badge-<?= strtolower($offre['type']) ?>">
                    <?= htmlspecialchars($offre['type']) ?>
                </span>
                <span class="badge <?= $offre['ouvert'] ? 'badge-open' : 'badge-clos' ?>">
                    <?= $offre['ouvert'] ? 'Ouverte' : 'Fermée' ?>
                </span>
                <strong><?= number_format($offre['salaire'], 0, ',', ' ') ?> €</strong> / an
            </p>
            <a class="btn" href="?vue=detail&id=<?= $offre['id'] ?>">Voir l'offre</a>
        </div>
    <?php endforeach; ?>

    <?php if (empty($offres_filtrees)): ?>
        <p>Aucune offre ne correspond à vos critères.</p>
    <?php endif; ?>

<?php
// ============================================================
//  EXTRAIT J
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================
?>

    <p>Page introuvable. <a href="?vue=liste">Retour aux offres</a></p>

<?php
// ============================================================
//  EXTRAIT E
//
//  Couche MVC    : ________________________________
//  Fichier       : ________________________________
// ============================================================
?>

    <a href="?vue=liste">← Retour aux offres</a>

    <div class="detail" style="margin-top: 20px;">
        <span class="badge <?= $offre_detail['ouvert'] ? 'badge-open' : 'badge-clos' ?>">
            <?= $offre_detail['ouvert'] ? 'Offre ouverte' : 'Offre fermée' ?>
        </span>
        <h2><?= htmlspecialchars($offre_detail['titre']) ?></h2>
        <p>
            <strong>Entreprise :</strong> <?= htmlspecialchars($offre_detail['entreprise']) ?><br>
            <strong>Ville :</strong> <?= htmlspecialchars($offre_detail['ville']) ?><br>
            <strong>Type de contrat :</strong> <?= htmlspecialchars($offre_detail['type']) ?><br>
            <strong>Salaire :</strong> <?= number_format($offre_detail['salaire'], 0, ',', ' ') ?> € / an<br>
            <strong>Publié le :</strong> <?= $offre_detail['publie_le'] ?>
        </p>
        <h3>Description du poste</h3>
        <p><?= htmlspecialchars($offre_detail['description']) ?></p>
        <h3>Compétences recherchées</h3>
        <p>
            <?php foreach ($offre_detail['competences'] as $comp): ?>
                <span class="competence"><?= htmlspecialchars($comp) ?></span>
            <?php endforeach; ?>
        </p>
    </div>

    <?php if ($offre_detail['ouvert']): ?>

        <?php if (!empty($succes_message)): ?>
            <div class="succes"><?= $succes_message ?></div>
        <?php endif; ?>

        <?php if (!empty($erreurs)): ?>
            <div class="erreur">
                <ul>
                    <?php foreach ($erreurs as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="candidater">
            <input type="hidden" name="offre_id" value="<?= $offre_detail['id'] ?>">
            <h3>Postuler à cette offre</h3>
            <div class="form-group">
                <label for="nom">Nom complet *</label>
                <input type="text" id="nom" name="nom"
                       value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
                       placeholder="Alice Dupont">
            </div>
            <div class="form-group">
                <label for="email">Adresse email *</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       placeholder="alice@exemple.fr">
            </div>
            <div class="form-group">
                <label for="message">Lettre de motivation *</label>
                <textarea id="message" name="message"
                          placeholder="Décrivez votre motivation en quelques lignes..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label for="cv">CV (PDF, 2 Mo max) *</label>
                <input type="file" id="cv" name="cv" accept=".pdf">
            </div>
            <button type="submit" class="btn">Envoyer ma candidature</button>
        </form>

    <?php else: ?>
        <p style="color:#922b21; font-weight:bold; margin-top:20px;">
            Cette offre est fermée, les candidatures ne sont plus acceptées.
        </p>
    <?php endif; ?>
