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
        $prenom=$_POST['prenom'];
        $nom=$_POST['nom'];
        $sexe=$_POST['sexe'];
        $cin=$_POST['cin'];
        $date=$_POST['date'];
        $filiere=$_POST['filiere'];
        $email=$_POST['email'];
        $etudiantID=$_GET['id'];

        $imagePath = $_GET['image'];

        // Supprimer l'image du dossier si elle existe
        if ($imagePath!= 'uploads/avatar.webp' && !empty($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Informations sur l'image
        $image = $_FILES['image']['name'];
        if($image!=null){
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_dir = "uploads/"; // Dossier où l'image sera stockée
        $target_file = $target_dir . basename($image);
        }else 
        {
            $target_file=null;
        }

        if (move_uploaded_file($image_tmp, $target_file)) 
            echo "L'image a été téléchargée avec succès.";
        else
        echo "erreur";

        $sql = "UPDATE etudiants SET prenom = ?, nom = ?, sexe = ?, cin = ?, dateNaissance = ?, filiere = ?, email = ?, image = ? WHERE EtudiantID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi",$prenom, $nom, $sexe, $cin, $date, $filiere, $email,  $target_file, $etudiantID);

    if ($stmt->execute()) {
        //echo "Mise à jour réussie!";
        // Rediriger vers une autre page après la mise à jour (par exemple, liste des étudiants)
        header("Location: index.php");
    }
}
    // Fermer la connexion après utilisation (optionnel)
    mysqli_close($conn);
?>