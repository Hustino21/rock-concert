<?php
require 'dbconfig.php';

try {
    $pdo->beginTransaction();

    // 1. Insert the Band
    $sqlBand = "INSERT INTO rock_bands (band_name, genre) VALUES (:name, :genre)";
    $stmtBand = $pdo->prepare($sqlBand);
    $stmtBand->execute([':name' => 'AC/DC', ':genre' => 'Hard Rock']);
    
    // Grab the ID of the band 
    $newBandId = $pdo->lastInsertId();

    // Insert the Concert using the new Band ID and Wembley Stadium's Venue ID (1)
    $sqlConcert = "INSERT INTO concert_attendances (band_id, venue_id, concert_date, tickets_sold, ticket_price) 
                   VALUES (:band_id, :venue_id, :date, :tickets, :price)";
    $stmtConcert = $pdo->prepare($sqlConcert);
    $stmtConcert->execute([
        ':band_id' => $newBandId, 
        ':venue_id' => 1,
        ':date' => '2024-08-01',
        ':tickets' => 85000,
        ':price' => 110.00
    ]);

    $pdo->commit();
    echo "Transaction successful: AC/DC and their concert were added!";

} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Transaction failed. Database rolled back. Error: " . $e->getMessage();
}
?>