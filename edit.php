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
    $sql = "SELECT EtudiantID, prenom, nom, sexe, cin, dateNaissance, email, filiere, image FROM etudiants WHERE EtudiantID=?";
    $etudiantID=$_GET['id'];
    //$result = mysqli_query($conn, $sql);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $etudiantID); // "i" pour integer (entier)
    $stmt->execute();
    $result = $stmt->get_result();
    $row=$result->fetch_assoc();
    }
    // Fermer la connexion après utilisation (optionnel)
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->
    <!-- Inclure le CSS Bootstrap et DataTables Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <!-- Inclure le JS jQuery, DataTables et Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Modifier Etudiant</title>
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
<h5 class="mt-4 fs-1">Modifier Etudiant</h5>

<form class="mt-4 row g-3 needs-validation" novalidate action="traitementEdit.php?id=<?php echo $row['EtudiantID'];?>&image=<?php echo $row['image'];?>" method="post" enctype="multipart/form-data">
  <div class="col-md-12">
  <img id="imagePreview" src="<?php echo !empty($row['image']!='uploads/') ? $row['image'] : 'avatar.webp'; ?>" class="img-thumbnail rounded mx-auto d-block" alt="Image de l'étudiant" style="height:150px; width:150px; max-height:150px; max-width:150px; display: block;">
  </div>
  <div class="col-md-6">
    <label for="validationCustom01" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="validationCustom01" value="<?php echo $row['prenom']; ?>" name="prenom" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom02" class="form-label">Nom</label>
    <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row['nom']; ?>" name="nom" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom04" class="form-label" >Sexe</label>
    <select class="form-select" id="validationCustom04" name="sexe" value="<?php echo $row['sexe']; ?>" required>
      <option disabled value="">Choisir...</option>
      <option value="homme">Homme</option>
      <option value="femme">Femme</option>
    </select>
    <div class="invalid-feedback">
      Veuillez choisir un sexe.
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom02" class="form-label" >CIN</label>
    <input type="text" class="form-control" id="validationCustom02" name="cin" value="<?php echo $row['cin']; ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom03" class="form-label" >Date de Naissance</label>
    <input type="text" class="form-control" id="validationCustom03"name="date" value="<?php echo $row['dateNaissance']; ?>" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom04" class="form-label" >Filiere</label>
    <select class="form-select" id="validationCustom04" name="filiere" required value="<?php echo $row['filiere']; ?>">
      <option disabled value="">Choisir...</option>
      <option value="LSI">LSI</option>
      <option value="GM">GM</option>
      <option value="GE">GE</option>
    </select>
    <div class="invalid-feedback">
      Veuillez choisir une filiere.
    </div>
  </div>

  <div class="col-md-6">
    <label for="exampleFormControlInput1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="nom@domaine.com" value="<?php echo $row['email']; ?>">
  </div>

  <div class="col-md-6">
    <label for="formFile" class="form-label">Image</label>
    <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="previewImage(event)">
    <!-- <img id="imagePreview" src="#" alt="Aperçu de l'image" style="max-width: 100%; display: none;" /> -->
</div>

  <div class="col-md-12">
    <a class="btn btn-secondary" href="index.php">Retour</a>
    <button class="btn btn-primary" type="submit">Modifier</button>
  </div>
  <div class="col-md-12"> 
  </div>
  <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
</form>
</div>
</body>

</html>