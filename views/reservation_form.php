<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
</head>
<body>

<p>
    <a href="admin.php"><button type="button">Accès Administrateur</button></a>
</p>

<h1>Formulaire de Réservation</h1>
<form id="reservationForm" method="POST">
    <h2>Inscription</h2>
    <label>Nom :</label><br>
    <input type="text" name="family_name" required><br>
    <label>Prénom :</label><br>
    <input type="text" name="name" required><br>
    <label>Email :</label><br>
    <input type="email" name="email" required><br>

    <h2>Réservation</h2>
    <label>Date :</label><br>
    <input type="date" name="date" required><br>
    <label>Créneau horaire (10h à 18h):</label><br>
    <select name="time_slot" required>
        <?php
        for ($h = 10; $h <= 18; $h++) {
            echo "<option value='{$h}:00'>{$h}:00</option>";
        }
        ?>
    </select><br>
    <label>Nombre de places (1 à 10):</label><br>
    <input type="number" name="places" min="1" max="10" required><br><br>

    <!-- Bouton qui envoie le formulaire -->
    

<!-- Récapitulatif mis à jour en temps réel -->
<div id="summary">
    <h2>Récapitulatif de la réservation</h2>
    <p><strong>Nom :</strong> <span id="recap_family_name"></span> <span id="recap_name"></span></p>
    <p><strong>Email :</strong> <span id="recap_email"></span></p>
    <p><strong>Date :</strong> <span id="recap_date"></span></p>
    <p><strong>Créneau horaire :</strong> <span id="recap_time_slot"></span></p>
    <p><strong>Nombre de places :</strong> <span id="recap_places"></span></p>
</div>

<script href="controllers/script.js"></script>
<input type="submit" name="submit" value="Réserver">
</form>

<?php if (isset($message)) { echo "<p>{$message}</p>"; } ?>

</body>
</html>
