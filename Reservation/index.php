<?php
require_once 'config/config.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ReservationController.php';
require_once 'config/api.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $family_name = $_POST['family_name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time_slot = $_POST['time_slot'];
    $places = $_POST['places'];

    if (empty($name) || empty($family_name) || empty($email) || empty($date) || empty($time_slot) || empty($places)) {
        $message = "Veuillez remplir tous les champs.";
        include './views/reservation_form.php';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Email invalide.";
        include './views/reservation_form.php';
        exit();
    }

    if ($places < 1 || $places > 10) {
        $message = "Nombre de places invalide.";
        include './views/reservation_form.php';
        exit();
    }

    if (!preg_match("/^[a-zA-ZÀ-ÿ ]+$/", $name)) {
        $message = "Nom invalide.";
        include './views/reservation_form.php';
        exit();
    }

    if (!preg_match("/^[a-zA-ZÀ-ÿ ]+$/", $family_name)) {
        $message = "Nom de famille invalide.";
        include './views/reservation_form.php';
        exit();
    }

    $date_format = 'Y-m-d';
    $d = DateTime::createFromFormat($date_format, $date);
    if (!($d && $d->format($date_format) === $date)) {
        $message = "Date invalide.";
        include './views/reservation_form.php';
        exit();
    }

    if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time_slot)) {
        $message = "Créneau horaire invalide.";
        include './views/reservation_form.php';
        exit();
    }

    $userController = new UserController($pdo);
    $reservationController = new ReservationController($pdo);

    $existingUser = $userController->getUserByEmail($email);
    
    if ($existingUser) {
        $userController->updateUserInfo($existingUser['id'], $name, $family_name);
        $user_id = $existingUser['id'];
    } else {
        $user_id = $userController->register($name, $family_name, $email);
        if (!$user_id) {
            $message = "Erreur lors de l'inscription.";
            include './views/reservation_form.php';
            exit();
        }
    }

    if ($user_id) {
        $success = $reservationController->createReservation($user_id, $date, $time_slot, $places);
        if ($success) {
            // Envoi de l'email de confirmation
            $to = $email;
            $subject = "Confirmation de votre réservation";
            $headers = "From: noreply@luminaria.com\r\n";
            $headers .= "Reply-To: contact@luminaria.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $message_email = "
                <html>
                <head>
                    <title>Confirmation de réservation</title>
                </head>
                <body>
                    <h2>Bonjour $family_name $name,</h2>
                    <p>Votre réservation a bien été prise en compte.</p>
                    <p><strong>Date :</strong> $date</p>
                    <p><strong>Créneau horaire :</strong> $time_slot</p>
                    <p><strong>Nombre de places :</strong> $places</p>
                    <p>Merci pour votre confiance et à bientôt !</p>
                </body>
                </html>
            ";

            if (mail($to, $subject, $message_email, $headers)) {
                header("Location: index.php?success=1");
                exit();
            } else {
                $message = "Réservation effectuée, mais l'email de confirmation n'a pas pu être envoyé.";
            }
        } else {
            $message = "Erreur lors de la réservation.";
        }
    }
}

$message = isset($_GET['success']) ? "Réservation effectuée avec succès !" : "";

include 'views/reservation_form.php';
?>
