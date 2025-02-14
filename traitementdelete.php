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
        $etudiantID=$_GET['id'];
        $imagePath = $_GET['image'];

        // Supprimer l'image du dossier si elle existe
        if ($imagePath!= 'uploads/avatar.webp' && !empty($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $sql = "DELETE FROM etudiants WHERE EtudiantID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$etudiantID);

    if ($stmt->execute()) {
        //echo "Mise à jour réussie!";
        // Rediriger vers une autre page après la mise à jour (par exemple, liste des étudiants)
        header("Location: index.php");
    }
}
    // Fermer la connexion après utilisation (optionnel)
    mysqli_close($conn);
?>