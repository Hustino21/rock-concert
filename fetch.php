<?php
require 'dbconfig.php';

try {
    $sql = "SELECT b.band_name, v.venue_name, (a.tickets_sold * a.ticket_price) AS max_revenue
            FROM concert_attendances a
            JOIN rock_bands b ON a.band_id = b.band_id
            JOIN venues v ON a.venue_id = v.venue_id
            WHERE (a.tickets_sold * a.ticket_price) = (
                SELECT MAX(tickets_sold * ticket_price) FROM concert_attendances
            )";

    $stmt = $pdo->query($sql);
    $row = $stmt->fetch();

    echo "<pre><h3>Highest Grossing Concert:</h3>";
    print_r($row);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>