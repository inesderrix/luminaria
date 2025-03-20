<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion Administrateur</title>
</head>
<body>
    <h1>Connexion Administrateur</h1>
    <form method="post" action="admin.php">
        <label>Email :</label><br>
        <input type="email" name="email" required><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="admin_login" value="Se connecter">
    </form>
    <?php if(isset($error)) { echo "<p style='color:red;'>{$error}</p>"; } ?>
    <p><a href="index.php">Retour au site</a></p>
</body>
</html>