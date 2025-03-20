<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
    <style>
        .step { display: none; }
        .active { display: block; }
        #summary { display: block; }
        #breadcrumb { margin-bottom: 20px; font-size: 18px; }
        #breadcrumb span { margin: 0 5px; }
        #breadcrumb .current { font-weight: bold; color: #4CAF50; }
    </style>
</head>
<body>

<h1>Formulaire de Réservation</h1>
<div id="breadcrumb">
    <span class="current">1. Réservation</span> ➜
    <span>2. Inscription</span> ➜
    <span>3. Récapitulatif</span> ➜
    <span>4. Confirmation</span>
</div>

<form id="reservationForm" method="POST">
    <input type="hidden" name="step" value="1">

    <!-- Étape 1 -->
    <div class="step active" id="step1">
        <h2>Réservation</h2>
        <label>Date :</label><br>
        <input type="date" name="date" oninput="updateRecap()" required><br>
        <label>Créneau horaire (10h à 18h):</label><br>
        <?php for ($h = 10; $h <= 18; $h++) { echo "<input type='radio' name='time_slot' value='{$h}:00' oninput='updateRecap()' required> {$h}:00 &nbsp;"; } ?><br>

        <label>Nombre de places (1 à 10):</label><br>
        <input type="number" name="places" min="1" max="10" oninput="updateRecap()" required><br><br>
        <button type="button" onclick="nextStep(1)">Suivant</button>
    </div>

    <!-- Étape 2  -->
    <div class="step" id="step2">
        <h2>Inscription</h2>
        <label>Nom :</label><br>
        <input type="text" name="family_name" oninput="updateRecap()" required><br>
        <label>Prénom :</label><br>
        <input type="text" name="name" oninput="updateRecap()" required><br>
        <label>Email :</label><br>
        <input type="email" name="email" oninput="updateRecap()" required><br>
        <button type="button" onclick="nextStep(2)">Suivant</button>
        <button type="button" onclicprec(2)>Précédent</button>
    </div>

    <!-- Étape 3 -->
    <div class="step" id="step3">
        <h2>Confirmation</h2>
        <div id="summary">
            <h3>Récapitulatif de la réservation</h3>
            <p><strong>Nom :</strong> <span id="recap_family_name"></span> <span id="recap_name"></span></p>
            <p><strong>Email :</strong> <span id="recap_email"></span></p>
            <p><strong>Date :</strong> <span id="recap_date"></span></p>
            <p><strong>Créneau horaire :</strong> <span id="recap_time_slot"></span></p>
            <p><strong>Nombre de places :</strong> <span id="recap_places"></span></p>
        </div>
        <button type="button" onclick="nextStep(3)">Confirmer</button>
        <button type="button" onclicprec(3)>Précédent</button>
    </div>

    <!-- Étape 4 -->
    <div class="step" id="step4">
    <div > Félicitations, votre réservation a été prise en compte !</div>
    </div>
</form>


<script href="controllers/script.js"></script>

</body>
</html>
