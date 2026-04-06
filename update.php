<?php
require 'dbconfig.php';

try {
    // Increase ticket prices by $15 for any concert happening at Madison Square Garden 
    $sql = "UPDATE concert_attendances 
            SET ticket_price = ticket_price + 15.00 
            WHERE venue_id = :vid";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':vid', 2, PDO::PARAM_INT);
    $stmt->execute();

    echo "Prices updated successfully for MSG concerts!";

} catch (PDOException $e) {
    echo "Update Error: " . $e->getMessage();
}
?>