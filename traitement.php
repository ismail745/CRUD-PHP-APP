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
    // Données à insérer dans la table
    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $sexe=$_POST['sexe'];
    $cin=$_POST['cin'];
    $date=$_POST['date'];
    $filiere=$_POST['filiere'];
    $email=$_POST['email'];

    $image = $_FILES['image']['name'];
    if ($image != null) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_dir = "uploads/"; // Dossier où l'image sera stockée

        // Générer un nom unique pour l'image
        $image_extension = pathinfo($image, PATHINFO_EXTENSION); // Récupérer l'extension de l'image
        $unique_name = uniqid() . '.' . $image_extension; // Générer un nom unique
        $target_file = $target_dir . $unique_name;
    } else {
        $target_file = "uploads/avatar.webp"; // Utiliser une image par défaut si aucun fichier n'est uploadé
    }

    if (move_uploaded_file($image_tmp, $target_file)) {
        echo "L'image a été téléchargée avec succès.";
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }



    // Requête SQL pour insérer une ligne dans la table (exemple : table `utilisateurs`)
    //$sql = "INSERT INTO formulaire (prenom, sexe, age, message) VALUES ('$prenom', '$sexe', '$age','$message')";
    $sql = "INSERT INTO etudiants (prenom, nom, sexe, cin, dateNaissance, filiere, email, image) VALUES ('$prenom', '$nom', '$sexe', '$cin', '$date' ,'$filiere','$email','$target_file')";

    // Exécuter la requête
    if (mysqli_query($conn, $sql)) {
        // echo "Nouvelle ligne insérée avec succès <br>";
        // echo "Pour voire les lignes insérée ds le tableau <a href='extraction.php'>Cliquer ici</a>";
        header("Location: index.php");
    exit(); // Terminer le script
    } else {
        echo "Erreur lors de l'insertion : " . mysqli_error($conn);
    }
}
// Fermer la connexion après utilisation (optionnel)
mysqli_close($conn);
?>