<?php
$filename = "data.txt";

if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $newLines = [];
        foreach ($lines as $line) {
            list($id, $titre, $type, $annee, $note, $texte) = explode('|', $line);
            if ($id != $idToDelete) {
                $newLines[] = $line;
            }
        }
        file_put_contents($filename, implode("\n", $newLines));
    }

    // on redirige sinon on reste bloqué
    header("Location: index.php?page=critiques&deleted=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critiques</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="w3-bar w3-margin-bottom">
<button class="w3-button w3-light-grey filtre-btn" onclick="filtrerParNote(0)">Toutes</button>
<button class="w3-button w3-light-grey filtre-btn" onclick="filtrerParNote(1)">⭐</button>
<button class="w3-button w3-light-grey filtre-btn" onclick="filtrerParNote(2)">⭐⭐</button>
<button class="w3-button w3-light-grey filtre-btn" onclick="filtrerParNote(3)">⭐⭐⭐</button>
<button class="w3-button w3-light-grey filtre-btn" onclick="filtrerParNote(4)">⭐⭐⭐⭐</button>

</div>


<?php
// Lecture du fichier data.txt
$critiqueFile = 'data.txt';
$critiques = [];

if (file_exists($critiqueFile)) {
    $lines = file($critiqueFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($id, $titre, $type, $annee, $note, $texte) = explode('|', $line);
        $critiques[] = [
            'id' => $id,
            'titre' => $titre,
            'type' => $type,
            'annee' => $annee,
            'note' => $note,
            'texte' => $texte
        ];
    }
}

// Trides identifiant
usort($critiques, fn($a, $b) => $a['id'] - $b['id']);
?>

<div class="w3-container">
    <h2>Liste des critiques</h2>
    <a class="w3-button w3-green w3-margin-bottom" href="index.php?page=editcritique">
        ➕ Ajouter une nouvelle critique
    </a>

    <div class="w3-row-padding">
    <?php foreach ($critiques as $critique): ?>
        <div class="w3-col l6 m6 s12 note<?= $critique['note'] ?>" style="box-sizing: border-box;">
            <div class="w3-card-4 w3-padding w3-white">
                <h3><?= htmlspecialchars($critique['titre']) ?></h3>
                <p><b>Type :</b> <?= htmlspecialchars($critique['type']) ?></p>
                <p><b>Année :</b> <?= htmlspecialchars($critique['annee']) ?></p>
                <p><b>Note :</b> <?= str_repeat("⭐", intval($critique['note'])) ?></p>
                <p><b>Critique :</b> <?= nl2br(htmlspecialchars($critique['texte'])) ?></p>

                <a class="w3-button w3-blue w3-small" 
                   href="index.php?page=editcritique&id=<?= $critique['id'] ?>">📝 Modifier</a>
                <a class="w3-button w3-red w3-small"
                   href="index.php?page=critiques&delete=<?= $critique['id'] ?>"
                   onclick="return confirm('Supprimer cette critique ?')">❌ Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
function filtrerParNote(note) {
    const cartes = document.querySelectorAll('.note1, .note2, .note3, .note4');
    cartes.forEach(card => {
        if (note === 0 || card.classList.contains("note" + note)) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });

    // gere les styles des boutons
    const boutons = document.querySelectorAll('.filtre-btn');
    boutons.forEach(btn => {
        btn.classList.remove('w3-dark-grey');
        btn.classList.add('w3-light-grey');
    });

    // Ajouter un style au bouton cliqué
    const index = note; // 0 pour toutes, 1-4 pour étoiles juste pour faire jolie
    if (boutons[index]) {
        boutons[index].classList.remove('w3-light-grey');
        boutons[index].classList.add('w3-dark-grey');
    }
}
</script>


</body>
</html>