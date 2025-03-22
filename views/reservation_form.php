<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réservation</title>
    <link rel="stylesheet" href="assets/style/reserv.css">
</head>
<?php 
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';
$aproposPage = $lang == 'en' ? 'aproposen.html' : 'aproposfr.html';
$texts = include 'langue/langue.php';
$t = $texts[$lang] ?? $texts['fr'];
?>
<header>
    <nav>
        <a href="#">
            <img src="assets/img/logo/logo-b.svg" alt=" retour">
        </a>


        <div>
            <a href="#" class="tel-acceuil">
                <?php echo $t['navacceuil']; ?>
            </a>
            <a href="<?php echo $aproposPage; ?>" class="page-actuel">
                <?php echo $t['navapropos']; ?>
            </a>
            <div class="language-selector">
                <label for="language" class="sr-only">Langue :</label>
                <select id="language" name="language">
                    <option value="en" <?php echo ($lang == 'en') ? 'selected' : ''; ?> >English</option>
                    <option value="fr" <?php echo ($lang == 'fr') ? 'selected' : ''; ?>>Français</option>
                </select>
            </div>

            <a href="#" class="reserve"><?php echo $t['navreserv']; ?></a>
        </div>
    </nav>
</header>
<body>

<main>

    <div id="breadcrumb">
        <span class="current"><?php echo $t['reserv']; ?></span> >
        <span><?php echo $t['inscrip']; ?></span> >
        <span><?php echo $t['recap']; ?></span> >
        <span><?php echo $t['confirme']; ?></span>
    </div>
    


  
<form id="reservationForm" method="POST">
  

    <!-- Étape 1 -->
    <div class="step active step1" id="step1">
        <h1><?php echo $t['titrestep1']; ?></h1>
          <img src="./assets/img/reserv.svg" alt="">
        <div class="date">
            <div class="section">            
                <label><?php echo $t['date']; ?></label><br>
                <div class="calendar-container">
                    <div class="month-picker">
                        <button type="button" id="prevMonth">&lt;</button>
                        <span id="currentMonth">Mars 2025</span>
                        <button type="button" id="nextMonth">&gt;</button>
                    </div>
                    <div class="days-grid">
                        <div class="day-name"><?php echo $t['lundi']; ?></div>
                        <div class="day-name"><?php echo $t['mardi']; ?></div>
                        <div class="day-name"><?php echo $t['mercredi']; ?></div>
                        <div class="day-name"><?php echo $t['jeudi']; ?></div>
                        <div class="day-name"><?php echo $t['vendredi']; ?></div>
                        <div class="day-name"><?php echo $t['samedi']; ?></div>
                        <div class="day-name"><?php echo $t['dimanche']; ?></div>
                        
                    </div>
                
                
                </div>
                <img src="./assets/img/calendar.svg" class="deco-calendar" alt="">
                <input type="hidden" name="date" id="selectedDate" required>
            </div>
            <div>

                <div class="section">
                    <label><?php echo $t['heure']; ?></label><br>
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
                        
                        <label><?php echo $t['visiteurs']; ?></label><br>
                        <div class="counter">
                            <button type="button" class="btn1" onclick="changeValue(-1)">−</button>
                            <input type="number" name="places" id="visitorCount" min="1" max="10" value="1" oninput="updateRecap()" required>
                            <button type="button" class="btn2" onclick="changeValue(1)">+</button>
                        </div>
                    </div>
                </div>
                
                <br><br>
            </div>
            <button type="button" class="suivant" onclick="nextStep(1)"><?php echo $t['suivant']; ?></button>
        </div>
            
            <!-- Étape 2  -->
    <div class="step " id="step2">
        <h1><?php echo $t['identifie']; ?></h1>
          <img src="./assets/img/reserv.svg" alt="">

        <div class="inscription">


            <label><?php echo $t['nom']; ?></label><br>
            <input type="text" name="family_name" oninput="updateRecap()" placeholder="Saisissez votre nom" required><br>
            <label><?php echo $t['prenom']; ?></label><br>
            <input type="text" name="name" oninput="updateRecap()" placeholder="Saisissez votre prénom" required><br>
            <label><?php echo $t['mail']; ?></label><br>
            <input type="email" name="email" oninput="updateRecap()"placeholder="Saisissez votre mail"  required><br>
            <button type="button" class="suivant" onclick="nextStep(2)"><?php echo $t['suivant']; ?></button>
            
        </div>
    </div>

    <!-- Étape 3 -->
    <div class="step" id="step3">
        <h1><?php echo $t['titrerecap']; ?></h1>
          <img src="./assets/img/reserv.svg" alt="">
        <div id="summary">
            <p><strong><?php echo $t['nom']; ?></strong> <span id="recap_family_name"></span> <span id="recap_name"></span></p>
            <p><strong><?php echo $t['mail']; ?></strong> <span id="recap_email"></span></p>
            <p><strong><?php echo $t['daterecap']; ?></strong> <span id="recap_date"></span></p>
            <p><strong><?php echo $t['heurerecap']; ?></strong> <span id="recap_time_slot"></span></p>
            <p><strong><?php echo $t['visiteurs']; ?></strong> <span id="recap_places"></span></p>
        </div>
        <button type="button" class="suivant" onclick="nextStep(3)"><?php echo $t['confirmer']; ?></button>
    
    </div>
    
    <!-- Étape 4 -->
    <div class="step" id="step4">
        <img src="" alt="">
        <div>
            <img src="" alt="">
            <h1><?php echo $t['reservconf']; ?></h1>
            <img src="" alt="">
            <p><?php echo $t['textconf']; ?></p>
            <a href="./aproposen.html"><?php echo $t['retourac']; ?></a>
        </div>

        
    </div>
</form>


</main>
<script src="controllers/script.js"></script>
<script src="assets/js/calendar.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const languageSelector = document.getElementById('language');

    languageSelector.addEventListener('change', function() {
        const selectedLang = this.value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('lang', selectedLang);
        window.location.href = currentUrl.toString();
    });
});
</script>


</body>
</html>
