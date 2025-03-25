<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion Administrateur</title>
    <link rel="stylesheet" href="assets/style/admin.css">
</head>
<body>
    
    <form method="post" action="admin.php">
        <h1>Connexion Administrateur</h1>
        <label>Email :</label><br>
        <input type="email" name="email" required><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="admin_login" value="Se connecter">
         <?php if(isset($error)) { echo "<p style='color:red;'>{$error}</p>"; } ?>
    <p><a href="reserv.php">Retour au site</a></p>
    </form>
   
</body>
</html>
