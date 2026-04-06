<?php
require 'dbconfig.php';

try {
    // Joining tables and formatting the output for the web page
    $sql = "SELECT b.band_name, v.venue_name, v.city,
                   DATE_FORMAT(a.concert_date, '%M %d, %Y') as formatted_date,
                   a.tickets_sold, a.ticket_price,
                   (a.tickets_sold * a.ticket_price) AS revenue
            FROM concert_attendances a
            JOIN rock_bands b ON a.band_id = b.band_id
            JOIN venues v ON a.venue_id = v.venue_id
            ORDER BY a.concert_date ASC";

    $stmt = $pdo->query($sql);
    $concerts = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rock Concert Database</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px;}
        table { border-collapse: collapse; width: 100%; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #222; color: #fff; text-transform: uppercase; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

    <h2>Rock Concert Attendances</h2>
    
    <table>
        <thead>
            <tr>
                <th>Band</th>
                <th>Venue</th>
                <th>City</th>
                <th>Date</th>
                <th>Tickets Sold</th>
                <th>Ticket Price</th>
                <th>Total Gross Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($concerts as $concert): ?>
            <tr>
                <td><strong><?= htmlspecialchars($concert['band_name']) ?></strong></td>
                <td><?= htmlspecialchars($concert['venue_name']) ?></td>
                <td><?= htmlspecialchars($concert['city']) ?></td>
                <td><?= htmlspecialchars($concert['formatted_date']) ?></td>
                <td><?= number_format($concert['tickets_sold']) ?></td>
                <td>$<?= number_format($concert['ticket_price'], 2) ?></td>
                <td style="color: darkgreen; font-weight: bold;">$<?= number_format($concert['revenue'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>