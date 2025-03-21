<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
    <link rel="stylesheet" href="assets/style/reserv.css">
</head>
<header>
    <nav>
        <a href="#">
            <img src="assets/img/logo/logo-b.svg" alt=" retour">
        </a>


        <div>
            <a href="#" class="tel-acceuil">
                Accueil
            </a>
            <a href="#" class="page-actuel">
                À propos
            </a>
            <div class="language-selector">
                <label for="language" class="sr-only">Langue :</label>
                <select id="language" name="language">
                    <option value="en">English</option>
                    <option value="fr">Français</option>
                </select>
            </div>

            <a href="#" class="reserve">Réserver</a>
        </div>
    </nav>
</header>
<body>

<main>

    <div id="breadcrumb">
        <span class="current">Réservation</span> >
        <span>Inscription</span> >
        <span>Récapitulatif</span> >
        <span>Confirmation</span>
    </div>
    
    <h1>Réserver votre billet</h1>

    <img src="./assets/img/reserv.svg" alt="">
<form id="reservationForm" method="POST">
  

    <!-- Étape 1 -->
    <div class="step active step1" id="step1">
        <div class="date">
            <div class="section">            
                <label>Sélectionner une date :</label><br>
                <div class="calendar-container">
                    <div class="month-picker">
                        <button type="button" id="prevMonth">&lt;</button>
                        <span id="currentMonth">Mars 2025</span>
                        <button type="button" id="nextMonth">&gt;</button>
                    </div>
                    <div class="days-grid">
                        <div class="day-name">L</div>
                        <div class="day-name">M</div>
                        <div class="day-name">M</div>
                        <div class="day-name">J</div>
                        <div class="day-name">V</div>
                        <div class="day-name">S</div>
                        <div class="day-name">D</div>
                        
                    </div>
                
                
                </div>
                <img src="./assets/img/calendar.svg" class="deco-calendar" alt="">
                <input type="hidden" name="date" id="selectedDate" required>
            </div>
            <div>

                <div class="section">
                    <label>Sélectionner une heure :</label><br>
                    <div class="horaire">
                        
                        <?php for ($h = 10; $h <= 18; $h++) { ?>
                            <div class="time-slot">
                                <input type="radio" name="time_slot" value="<?php echo $h; ?>:00" oninput="updateRecap()" required>
                                <span><?php echo $h; ?>h00</span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="visiteur">
                        
                        <label>Nombre de visiteurs :</label><br>
                        <div class="counter">
                            <button type="button" class="btn1" onclick="changeValue(-1)">−</button>
                            <input type="number" name="places" id="visitorCount" min="1" max="10" value="1" oninput="updateRecap()" required>
                            <button type="button" class="btn2" onclick="changeValue(1)">+</button>
                        </div>
                    </div>
                </div>
                
                <br><br>
            </div>
            <button type="button" class="suivant" onclick="nextStep(1)">Suivant</button>
        </div>
            
            <!-- Étape 2  -->
    <div class="step " id="step2">

        <div class="inscription">

            <label>Nom :</label><br>
            <input type="text" name="family_name" oninput="updateRecap()" placeholder="Saisissez votre nom" required><br>
            <label>Prénom :</label><br>
            <input type="text" name="name" oninput="updateRecap()" placeholder="Saisissez votre prénom" required><br>
            <label>Email :</label><br>
            <input type="email" name="email" oninput="updateRecap()"placeholder="Saisissez votre mail"  required><br>
            <button type="button" class="suivant" onclick="nextStep(2)">Suivant</button>
            
        </div>
    </div>

    <!-- Étape 3 -->
    <div class="step" id="step3">

        <div id="summary">
            <h3>Récapitulatif de la réservation</h3>
            <p><strong>Nom :</strong> <span id="recap_family_name"></span> <span id="recap_name"></span></p>
            <p><strong>Email :</strong> <span id="recap_email"></span></p>
            <p><strong>Date :</strong> <span id="recap_date"></span></p>
            <p><strong>Créneau horaire :</strong> <span id="recap_time_slot"></span></p>
            <p><strong>Nombre de places :</strong> <span id="recap_places"></span></p>
        </div>
        <button type="button" class="suivant" onclick="nextStep(3)">Confirmer</button>
    
    </div>
    
    <!-- Étape 4 -->
    <div class="step" id="step4">
        <div > Félicitations, votre réservation a été prise en compte !</div>
    </div>
</form>


</main>
<script src="controllers/script.js"></script>
<script src="assets/js/calendar.js"></script>
<script src="assets/js/language.js"></script>


</body>
</html>
