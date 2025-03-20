<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Back Office - Administration</title>
</head>
<body>
<form method="post">
        <button type="submit" name="logout">Déconnexion</button>
    </form>
    <h1>Back Office - Administration</h1>

    <h2>Utilisateurs</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
        </tr>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['family_name']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Réservations</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Utilisateur</th>
            <th>Date</th>
            <th>Créneau</th>
            <th>Places</th>
        </tr>
        <?php foreach($reservations as $res): ?>
        <tr>
            <td><?= htmlspecialchars($res['family_name']) ?> <?= htmlspecialchars($res['name']) ?> (<?= htmlspecialchars($res['email']) ?>)</td>
            <td><?= htmlspecialchars($res['date']) ?></td>
            <td><?= htmlspecialchars($res['time_slot']) ?></td>
            <td><?= htmlspecialchars($res['places']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Statistiques par jour</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Date</th>
            <th>Nombre de réservations</th>
        </tr>
        <?php foreach($statsByDay as $stat): ?>
        <tr>
            <td><?= htmlspecialchars($stat['date']) ?></td>
            <td><?= htmlspecialchars($stat['total_reservations']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Statistiques par créneau</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Créneau</th>
            <th>Nombre de réservations</th>
        </tr>
        <?php foreach($statsByTimeSlot as $stat): ?>
        <tr>
            <td><?= htmlspecialchars($stat['time_slot']) ?></td>
            <td><?= htmlspecialchars($stat['total_reservations']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>