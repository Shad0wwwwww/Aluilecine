<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aluile Ciné</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" href="images/logo.png">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- Bandeau en haut -->
  <header style="background-color: #f1c40f; color: black; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
    <div class="w3-row w3-padding-24 w3-content" style="max-width:1200px; display: flex; align-items: center;">

      <!-- Logo à gauche -->
      <div style="flex: 0 0 auto; background: white; border-radius: 10px; padding: 8px; margin-right: 20px;">
        <img src="images/logo.png" alt="Logo Aluileciné" style="height: 60px;">
      </div>

      <!-- Titre centré -->
      <div style="flex: 1;">
        <h1 class="w3-xxlarge" style="margin: 0;"><b>ALUILECINÉ</b></h1>
        <p style="margin: 4px 0; font-weight: bold;">L’actu, les critiques, et vos avis ciné, en un clic.</p>
      </div>

    </div>
  </header>



  <!-- Conteneur principal avec menu + contenu  en gros la ou ou mets tt-->
  <div class="w3-row">

    <!-- Menu latéral -->
    <nav class="w3-col l2 menu-lateral w3-padding-large w3-hide-small">
      <a href="index.php?page=presentation" class="w3-bar-item w3-button menu-item">Présentation</a>
      <a href="index.php?page=critiques" class="w3-bar-item w3-button menu-item">Liste des critiques</a>
      <a href="index.php?page=editcritique" class="w3-bar-item w3-button menu-item"> Ajouter une critique</a>
    </nav>


    <!-- Menu pour tel, ca ne marche pas completement -->
    <div class="w3-hide-large w3-hide-medium w3-bar w3-light-grey">
      <a href="index.php?page=presentation" class="w3-bar-item w3-button">Présentation</a>
      <a href="index.php?page=critiques" class="w3-bar-item w3-button">Critiques</a>
      <a href="index.php?page=editcritique" class="w3-bar-item w3-button">Ajouter</a>
    </div>

    <!-- Espace central -->
    <main class="w3-col l10 w3-padding">
      <?php
      $page = isset($_GET['page']) ? $_GET['page'] : 'presentation';

      if ($page == 'critiques') {
        include('critiques.php');
      } elseif ($page == 'editcritique') {
        include('editcritique.php');
      } else {
        include('init.php');
      }
      ?>
    </main>
  </div>

  <footer style="background-color: #111; color: white;" class="w3-container w3-center w3-padding-16">
    <p style="margin: 0;">
      Projet PHP – Auteur : Victor | <?= date("d/m/Y") ?> | <!--date actuel qui s'affiche dans le footer vu sur youtube donc j'ai akouter au projet -->
      <a href="https://www.instagram.com/lauretv1/" style="color: #f1c40f;">Instagram</a> •
      <a href="https://voxel-studio.fr" style="color: #f1c40f;">voxel-studio</a>
    </p>
  </footer>

</body>

</html>
<?php ob_end_flush(); ?>