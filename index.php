<?php
    // Informations de connexion à la base de données
    $host = 'localhost';       // Adresse du serveur MySQL (exemple : 'localhost')
    $username = 'root';        // Nom d'utilisateur de MySQL (exemple : 'root')
    $password = 'root';            // Mot de passe de MySQL (laisser vide si pas de mot de passe)
    $dbname = 'lsi25'; // Nom de la base de données

    // Créer la connexion
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Vérifier la connexion
    if (!$conn) {
        die("La connexion a échoué : " . mysqli_connect_error());
    } else {
        //echo "Connexion réussie à la base de données";
        // Requête SQL pour extraire les données (exemple : table `utilisateurs`)
    $sql = "SELECT EtudiantID,prenom, nom, sexe, cin, dateNaissance, filiere, image FROM etudiants";
    $result = mysqli_query($conn, $sql);

    }
    // Fermer la connexion après utilisation (optionnel)
    mysqli_close($conn);
?>
<style>
    table, td{
        border:1px solid black;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Inclure le JS jQuery, DataTables et Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Accueil</title>
</head>
<body>
<nav class="navbar bg-body-tertiary w-100">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="FSTT-LOGO.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      FST-TANGER
    </a>
    
  </div>
</nav>
<div class="container">
<h5 class="mt-4 fs-1">Etudiants</h5>
<div class="d-flex justify-content-end">
<a href="create.php" class="btn btn-primary mt-2 mb-2">Ajouter +</a>
</div>
<table class="table" id="maTable">
  <thead>
    <tr>
      <th scope="col">Prenom</th>
      <th scope="col">Nom</th>
      <th scope="col">Sexe</th>
      <th scope="col">CIN</th>
      <th scope="col">DateNaissance</th>
      <th scope="col">Filiere</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td >".$row["prenom"]."</td>";
            echo "<td>".$row['nom']."</td>";
            echo "<td>".$row['sexe']."</td>";
            echo "<td>".$row['cin']."</td>";
            echo "<td>".$row['dateNaissance']."</td>";
            echo "<td>".$row['filiere']."</td>";
            echo '<td>
                        <a href="show.php?id='.$row['EtudiantID'].'" class="text-decoration-none me-2" title="Voir En Détail">
                            <i class="fas fa-eye"></i> <!-- Icône pour voir en détail (œil) -->
                        </a>
                        <a href="edit.php?id='.$row['EtudiantID'].'&image='.urlencode($row['image']).'" class="text-decoration-none me-2" title="Modifier">
                            <i class="fas fa-pencil-alt"></i> <!-- Icône de modification (crayon) -->
                        </a>
                        <a href="traitementdelete.php?id='.$row['EtudiantID'].'&image='.urlencode($row['image']).'" class="text-decoration-none text-danger" title="Supprimer" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fas fa-trash-alt"></i> <!-- Icône de suppression (poubelle) -->
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Avertissement</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Vous voulez vraiment supprimer cette etudiants ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                                <a href="traitementdelete.php?id='.$row['EtudiantID'].'&image='.urlencode($row['image']).'" class="btn btn-danger title="Supprimer">
                                    Confirmer
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>
                  </td>';
            echo "</tr>";
        }
        ?>
  </tbody>
</table>
<script>
        $(document).ready(function() {
            $('#maTable').DataTable({
                "paging": true, // Active la pagination
                "lengthChange": true, // Permet de changer le nombre d'enregistrements affichés
                "searching": true, // Active la barre de recherche
                "ordering": true, // Permet de trier les colonnes
                "info": true, // Affiche les informations en bas de table
                "pagingType": "full_numbers",
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                },
                "lengthMenu": [5,10, 25, 50, 100],
                "autoWidth": false // Ajuste automatiquement la largeur des colonnes
            });
        });
    </script>
</div>
</body>
</html>