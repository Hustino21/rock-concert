<?php
require 'dbconfig.php';

try {
    $sql = "SELECT b.band_name, v.venue_name, v.city, a.tickets_sold,
                   (a.tickets_sold * a.ticket_price) AS total_revenue,
                   CASE 
                       WHEN a.tickets_sold >= v.max_capacity THEN 'Sold Out!'
                       ELSE 'Tickets Remained'
                   END as attendance_status
            FROM concert_attendances a
            INNER JOIN rock_bands b ON a.band_id = b.band_id
            INNER JOIN venues v ON a.venue_id = v.venue_id
            ORDER BY total_revenue DESC";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();

    echo "<pre><h3>Complete Concert Report:</h3>";
    print_r($results);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>