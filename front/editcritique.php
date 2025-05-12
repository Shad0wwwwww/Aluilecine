<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>éditeur de critique</title>
</head>
<body>
<?php
// Fichier base
$filename = 'data.txt';
$critiques = [];
$modification = false;
$idModif = null;
$erreur = false;
$critiqueData = ["", "", "", "", "", ""];

// Lire les critiques existantes
if (file_exists($filename)) {
    $critiques = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Si modification : récupérer l'id
if (isset($_GET['id'])) {
    $modification = true;
    $idModif = $_GET['id'];
    foreach ($critiques as $line) {
        $parts = explode('|', $line);
        if ($parts[0] == $idModif) {
            $critiqueData = $parts;
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = trim($_POST['titre']);
    $type = $_POST['type'];
    $annee = $_POST['annee'];
    $note = $_POST['note'];
    $texte = trim($_POST['texte']);
    $id = $_POST['id'];

    if ($titre && $type && $annee && $note && $texte) {
        if ($id === "auto") {
            // Création : générer un nouvel ID, on bloque l'accès à l'utilisateur de modifier ce numéro que l'on attribue a chaque critique 
            $lastId = 0;
            foreach ($critiques as $line) {
                $parts = explode('|', $line);
                if (intval($parts[0]) > $lastId) $lastId = intval($parts[0]);
            }
            $id = $lastId + 1;
            $critiques[] = "$id|$titre|$type|$annee|$note|$texte";
        } else {
            // Modification : remplacer la ligne
            foreach ($critiques as $i => $line) {
                $parts = explode('|', $line);
                if ($parts[0] == $id) {
                    $critiques[$i] = "$id|$titre|$type|$annee|$note|$texte";
                    break;
                }
            }
        }

        // Sauvegarde
        file_put_contents($filename, implode("\n", $critiques));
        echo '<div class="w3-panel w3-green"><p>✅ La critique a été enregistrée avec succès.</p></div>';
        echo '<a href="index.php?page=critiques" class="w3-button w3-blue">⬅ Retour à la liste des critiques</a>';
        return;
    } else {
        $erreur = true;
    }
}
?>

<div class="w3-container w3-padding">
    <h2><?= $modification ? "Modifier la critique" : "Ajouter une critique" ?></h2>

    <?php if ($erreur): ?>
        <div class="w3-panel w3-red">
            <p>⚠️ Tous les champs sont obligatoires.</p>
        </div>
    <?php endif; ?>

    <form class="w3-container w3-card-4" method="POST" onsubmit="return verifierFormulaire();">
        <p><label><b>ID</b></label>
        <input class="w3-input" name="id" value="<?= $modification ? $critiqueData[0] : 'auto' ?>" readonly></p>

        <p><label><b>Titre</b></label>
        <input class="w3-input" name="titre" value="<?= htmlspecialchars($critiqueData[1]) ?>"></p>

        <p><label><b>Type</b></label>
        <select class="w3-select" name="type">
            <option value="Film" <?= $critiqueData[2] == "Film" ? "selected" : "" ?>>Film</option>
            <option value="Série" <?= $critiqueData[2] == "Série" ? "selected" : "" ?>>Série</option>
        </select></p>

        <p><label><b>Année de sortie</b></label>
        <input class="w3-input" type="number" name="annee" value="<?= htmlspecialchars($critiqueData[3]) ?>"></p>

        <p><label><b>Note</b> (1 à 4)</label>
        <select class="w3-select" name="note">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <option value="<?= $i ?>" <?= $critiqueData[4] == $i ? "selected" : "" ?>><?= $i ?> étoile<?= $i > 1 ? 's' : '' ?></option>
            <?php endfor; ?>
        </select></p>

        <p><label><b>Critique</b></label>
        <textarea class="w3-input" name="texte" rows="5"><?= htmlspecialchars($critiqueData[5]) ?></textarea></p>

        <p><button class="w3-button w3-teal" type="submit">💾 Enregistrer</button></p>
    </form>
</div>

<script>
function verifierFormulaire() {
    let champs = document.querySelectorAll("input[name='titre'], input[name='annee'], textarea[name='texte']");
    for (let champ of champs) {
        if (champ.value.trim() === "") {
            alert("Veuillez remplir tous les champs !");
            return false;
        }
    }
    return true;
}
</script>

</body>
</html>