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
    <title>Ajouter Etudiant</title>
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
<h5 class="mt-4 fs-1">Ajouter Etudiant</h5>

<form class="mt-4 row g-3 needs-validation" action="traitement.php" method="post" enctype="multipart/form-data">
  <div class="col-md-12">
  <img id="imagePreview" src="avatar.webp" class="img-thumbnail rounded mx-auto d-block" alt="..." style="height:150px; width:150px; max-height:150px ;max-width: 150px; display: none;">
  </div>
  <div class="col-md-6">
    <label for="validationCustom01" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="validationCustom01" name="prenom" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom02" class="form-label">Nom</label>
    <input type="text" class="form-control" id="validationCustom02" name="nom" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom04" class="form-label" >Sexe</label>
    <select class="form-select" id="validationCustom04" name="sexe" required>
      <option selected disabled value="">Choisir...</option>
      <option value="homme">Homme</option>
      <option value="femme">Femme</option>
    </select>
    <div class="invalid-feedback">
      Veuillez choisir un sexe.
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom02" class="form-label" >CIN</label>
    <input type="text" class="form-control" id="validationCustom02" name="cin" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom03" class="form-label" >Date de Naissance</label>
    <input class="form-control" type="date" id="validationCustom03"name="date" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>

  <div class="col-md-6">
    <label for="validationCustom04" class="form-label" >Filiere</label>
    <select class="form-select" id="validationCustom04" name="filiere" required>
      <option selected disabled value="">Choisir...</option>
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
    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="nom@domaine.com">
  </div>

  <div class="col-md-6">
    <label for="formFile" class="form-label">Image</label>
    <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="previewImage(event)">
    <!-- <img id="imagePreview" src="#" alt="Aperçu de l'image" style="max-width: 100%; display: none;" /> -->
</div>
  <div class="col-md-12">
    <a class="btn btn-secondary" href="index.php">Retour</a>
    <button class="btn btn-primary" type="submit">Ajouter</button>
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