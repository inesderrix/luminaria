<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Back Office - Administration</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 600px;
            max-height: 400px;
        }
    </style>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
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
<table border="1" cellpadding="5" style="display: none;">
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
<canvas id="statsByDayChart"></canvas>

<h2>Statistiques par créneau</h2>
<table border="1" cellpadding="5" style="display: none;">
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
<canvas id="statsByTimeSlotChart"></canvas>

<script>
    // Data for Stats by Day Chart
    const statsByDayLabels = <?= json_encode(array_column($statsByDay, 'date')) ?>;
    const statsByDayData = <?= json_encode(array_column($statsByDay, 'total_reservations')) ?>;

    // Data for Stats by Time Slot Chart
    const statsByTimeSlotLabels = <?= json_encode(array_column($statsByTimeSlot, 'time_slot')) ?>;
    const statsByTimeSlotData = <?= json_encode(array_column($statsByTimeSlot, 'total_reservations')) ?>;

    // Stats by Day Chart
    const ctxDay = document.getElementById('statsByDayChart').getContext('2d');
    new Chart(ctxDay, {
        type: 'line',
        data: {
        labels: statsByDayLabels,
        datasets: [{
            label: 'Nombre de réservations',
            data: statsByDayData,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            fill: true,
            tension: 0.4
        }]
        },
        options: {
        responsive: true,
        plugins: {
            legend: {
            position: 'top',
            },
            title: {
            display: true,
            text: 'Nombre de réservations par jour'
            }
        },
        scales: {
            y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Nombre de réservations'
            }
            },
            x: {
            title: {
                display: true,
                text: 'Date'
            }
            }
        }
        }
    });

    // Stats by Time Slot Chart
    const ctxTimeSlot = document.getElementById('statsByTimeSlotChart').getContext('2d');
    new Chart(ctxTimeSlot, {
        type: 'pie',
        data: {
        labels: statsByTimeSlotLabels,
        datasets: [{
            label: 'Nombre de réservations',
            data: statsByTimeSlotData,
            backgroundColor: statsByTimeSlotLabels.map((_, i) => `hsl(${i * 360 / statsByTimeSlotLabels.length}, 70%, 50%)`),
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
</script>
</body>
</html>
